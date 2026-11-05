<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Importe menages_clean.csv : pour chaque ligne, crée user -> client -> ménage
 * (+ abonnement pour les abonnés actifs). Tout se fait dans UNE transaction.
 *
 * Prérequis : avoir exécuté 01_reference.sql (zone, types d'habitat, quartiers).
 */
class ImportEspoirPlus extends Command
{
    protected $signature = 'espoir:import
        {fichier? : Chemin du CSV (défaut : storage/app/menages_clean.csv)}
        {--etat= : Valeur de abonnements.etat pour les abonnés actifs}
        {--status= : Valeur de abonnements.status pour les abonnés actifs}
        {--sans-abonnements : Ne crée aucun abonnement}
        {--dry-run : Simule tout, puis annule la transaction}';

    protected $description = 'Importe les abonnés Espoir Plus (Sokodé) depuis le CSV nettoyé';

    public function handle(): int
    {
        $fichier = $this->argument('fichier') ?: storage_path('app/menages_clean.csv');
        if (!is_file($fichier)) {
            $this->error("Fichier introuvable : $fichier");
            return self::FAILURE;
        }

        $sansAbo = (bool) $this->option('sans-abonnements');
        $etat = $this->option('etat');
        $status = $this->option('status');
        if (!$sansAbo && (!$etat || !$status)) {
            $this->error('Précise --etat=... et --status=... (valeurs utilisées dans abonnements), ou --sans-abonnements.');
            return self::FAILURE;
        }

        // --- tables de référence (créées par 01_reference.sql) ---
        $types = [];
        foreach (DB::table('type_habitats')->get(['id', 'designation']) as $t) {
            $types[mb_strtoupper($t->designation)] = $t->id;
        }
        $quartiers = [];
        foreach (DB::table('quartiers')->get(['id', 'designation']) as $q) {
            $quartiers[mb_strtoupper($q->designation)] = $q->id;
        }

        // --- lecture du CSV ---
        $h = fopen($fichier, 'r');
        if (fread($h, 3) !== "\xEF\xBB\xBF") {
            rewind($h); // pas de BOM
        }
        $entete = fgetcsv($h);
        $lignes = [];
        while (($r = fgetcsv($h)) !== false) {
            if (count($r) === count($entete)) {
                $lignes[] = array_combine($entete, $r);
            }
        }
        fclose($h);

        // --- vérifications avant d'écrire quoi que ce soit ---
        $manquants = [];
        foreach ($lignes as $l) {
            if (!isset($types[mb_strtoupper($l['type_habitat'])])) {
                $manquants['type : ' . $l['type_habitat']] = true;
            }
            if (!isset($quartiers[mb_strtoupper($l['quartier'])])) {
                $manquants['quartier : ' . $l['quartier']] = true;
            }
        }
        if ($manquants) {
            $this->error('Références absentes de la base (exécute 01_reference.sql) :');
            foreach (array_keys($manquants) as $m) {
                $this->line("  - $m");
            }
            return self::FAILURE;
        }

        $this->info(count($lignes) . ' lignes lues.' . ($this->option('dry-run') ? ' (SIMULATION)' : ''));

        $mdp = Hash::make(Str::random(32)); // mot de passe aléatoire : ces comptes ne se connectent pas
        $now = now();
        $stats = ['crees' => 0, 'ignores' => 0, 'abonnements' => 0];
        $courant = null;

        DB::beginTransaction();
        try {
            $this->output->progressStart(count($lignes));
            foreach ($lignes as $l) {
                $courant = $l['code'];
                $this->output->progressAdvance();

                // relançable : un ménage déjà présent est ignoré
                if (DB::table('menages')->where('code', $l['code'])->exists()) {
                    $stats['ignores']++;
                    continue;
                }

                [$nom, $prenom] = $this->separerNom($l['designation'], $l['code']);
                $contact = str_replace(';', ' / ', $l['telephones']);

                $userId = DB::table('users')->insertGetId([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'contacte' => $contact,
                    'email' => Str::slug($l['code']) . '@espoirplus.local',
                    'password' => $mdp,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $clientId = DB::table('clients')->insertGetId([
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $menageId = DB::table('menages')->insertGetId([
                    'code' => $l['code'],
                    'designation' => $l['designation'] !== '' ? $l['designation'] : null,
                    'est_abonnee' => $l['statut'] === 'actif',
                    'est_radier' => $l['statut'] === 'radie',
                    'est_en_regle' => false,
                    'client_id' => $clientId,
                    'quartier_id' => $quartiers[mb_strtoupper($l['quartier'])],
                    'type_habitat_id' => $types[mb_strtoupper($l['type_habitat'])],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                if (!$sansAbo && $l['statut'] === 'actif') {
                    DB::table('abonnements')->insert([
                        'menage_id' => $menageId,
                        'etat' => $etat,
                        'status' => $status,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                    $stats['abonnements']++;
                }
                $stats['crees']++;
            }
            $this->output->progressFinish();

            if ($this->option('dry-run')) {
                DB::rollBack();
                $this->warn('SIMULATION : transaction annulée, rien n\'a été écrit.');
            } else {
                DB::commit();
                $this->info('Import validé.');
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error("Échec à la ligne « $courant » : " . $e->getMessage());
            $this->warn('Transaction annulée, rien n\'a été écrit.');
            return self::FAILURE;
        }

        $this->table(['Ménages créés', 'Déjà présents (ignorés)', 'Abonnements créés'],
            [[$stats['crees'], $stats['ignores'], $stats['abonnements']]]);
        return self::SUCCESS;
    }

    /**
     * « GNONFAM Expedi » -> nom GNONFAM / prénom Expedi ; « OURO YERIMA Asetou » -> nom « OURO YERIMA ».
     * Si le libellé n'est pas de la forme NOM Prénom (« HOTEL LE KING », « Mme PAKOU »),
     * tout va dans nom et prénom vaut « - » (colonne obligatoire).
     */
    private function separerNom(string $designation, string $code): array
    {
        $designation = trim($designation);
        if ($designation === '') {
            return ["SANS NOM $code", '-'];
        }
        $mots = preg_split('/\s+/', $designation);
        $i = 0;
        while ($i < count($mots) && $mots[$i] === mb_strtoupper($mots[$i])) {
            $i++;
        }
        if ($i === 0 || $i === count($mots)) {
            return [$designation, '-'];
        }
        return [implode(' ', array_slice($mots, 0, $i)), implode(' ', array_slice($mots, $i))];
    }
}
