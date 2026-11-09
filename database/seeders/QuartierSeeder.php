<?php

namespace Database\Seeders;

use App\Models\Quartier;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class QuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère les quatre zones numérotées créées par ZoneSeeder.
        $zones = [];
        foreach (range(1, 4) as $numero) {
            $zone = Zone::firstOrCreate(['designation' => 'Zone ' . $numero]);
            $zones[$numero] = $zone->id;
        }

        // Répartit provisoirement les quartiers entre les zones en attendant une carte précise.
        $quartiers = [
            'KOMAH' => 1,
            'TCHAWANDA' => 1,
            'SOLIDARITE' => 1,
            'AKAMADE' => 1,
            'BAMABODOLO' => 2,
            'KPANGALAM' => 2,
            'DIDAOURE' => 2,
            'ZONGO' => 2,
            'LOMNAVA' => 3,
            'SALIMDE' => 3,
            'TCHAKPALADE' => 3,
            'BARRIERE' => 4,
            'KUWAWU WORO' => 4,
            'ZAIRE' => 4,
        ];

        foreach ($quartiers as $designation => $numeroZone) {
            // Recherche sans tenir compte de la casse pour éviter les doublons historiques.
            $quartier = Quartier::query()
                ->whereRaw('LOWER(designation) = ?', [mb_strtolower($designation)])
                ->first();

            if ($quartier) {
                // Met à jour le nom et l'affectation pour appliquer la répartition provisoire.
                $quartier->update([
                    'designation' => $designation,
                    'zone_id' => $zones[$numeroZone],
                ]);
                continue;
            }

            Quartier::create([
                'designation' => $designation,
                'zone_id' => $zones[$numeroZone],
            ]);
        }
    }
}
