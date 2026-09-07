<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ['employee_id', 'zone_id', 'status', 'date', 'itineraire'];

        // creation des tournee
        DB::table('tournees')->insert([
            [
                'employes_id' =>json_encode(['2', '1']),
                'zone_id' => 1,
                'status' => "EN_COUR",
                'date' => "12-8-2024",
                'itineraire' => 1000
            ],
            [
                'employes_id' =>json_encode(['1', '2']),
                'zone_id' => 1,
                'status' => "PREVU",
                'date' => "14-8-2024",
                'itineraire' => 1000
            ],

            [
                'employes_id' =>json_encode(['1']),
                'zone_id' => 2,
                'status' => "PREVU",
                'date' => "16-8-2024",
                'itineraire' => 1000
            ],
        ]);


        // ligne tournee
        DB::table('ligne_tournees')->insert([
            [
                'tournee_id' => 1,
                'menage_id' => 1,
                'status' => "NON_VIDER",
            ],
            [
                'tournee_id' => 1,
                'menage_id' => 2,
                'status' => "NON_VIDER",
            ],
            [
                'tournee_id' => 2,
                'menage_id' => 2,
                'status' => "NON_VIDER",
            ],
            [
                'tournee_id' => 3,
                'menage_id' => 1,
                'status' => "NON_VIDER",
            ],
            [
                'tournee_id' => 3,
                'menage_id' => 3,
                'status' => "NON_VIDER",
            ],
        ]);
    }
}
