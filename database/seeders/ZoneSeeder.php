<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remplace les anciens noms par des numéros tout en conservant les identifiants des zones.
        $anciensNoms = [
            1 => 'sokode',
            2 => 'kdambara',
        ];

        foreach (range(1, 4) as $numero) {
            $designation = 'Zone ' . $numero;
            $zone = Zone::query()
                ->whereRaw('LOWER(designation) = ?', [mb_strtolower($designation)])
                ->first();

            if (!$zone && isset($anciensNoms[$numero])) {
                $zone = Zone::query()
                    ->whereRaw('LOWER(designation) = ?', [$anciensNoms[$numero]])
                    ->first();
            }

            if ($zone) {
                // Met à jour l'ancien libellé sans changer l'identifiant utilisé par les relations.
                if ($zone->designation !== $designation) {
                    $zone->update(['designation' => $designation]);
                }

                continue;
            }

            // Crée les zones manquantes, notamment les zones 3 et 4.
            Zone::create(['designation' => $designation]);
        }
    }
}
