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

        DB::table('tournees')->insert([
            [
                'employe_id' => 1,
                'zone_id' => 1,
                'statut' => "EN_COUR",
                'date' => "12-8-2024",
                'itineraire' => 1000
            ],
            [
                'employe_id' => 1,
                'zone_id' => 1,
                'statut' => "PREVU",
                'date' => "14-8-2024",
                'itineraire' => 1000
            ],

            [
                'employe_id' => 2,
                'zone_id' => 2,
                'statut' => "TERMINEE",
                'date' => "16-8-2024",
                'itineraire' => 1000
            ],
        ]);
    }
}
