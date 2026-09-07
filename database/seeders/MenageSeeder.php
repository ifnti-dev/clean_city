<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('menages')->insert([
            [
                'code' => '00001',
                'designation' => 'ifnti',
                'est_abonnee' => false,
                'est_radier' => false,
                'employe_id' => 1,
                'client_id' => 1,
                'quartier_id' => 1,
                'type_habitat_id' => 1,
                'latitude' => 100,
                'longitude' => 100,

            ],
            [
                'code' => '00002',
                'designation' => 'Hotel nassam',
                'est_abonnee' => true,
                'est_radier' => false,
                'employe_id' => 1,
            
                'client_id' => 2,
                'quartier_id' => 1,
                'type_habitat_id' => 1,
                'latitude' => 100,
                'longitude' => 100,

            ],
            [
                'code' => '00003',
                'designation' => 'Hotel 5 etoile',
                'est_abonnee' => true,
                'est_radier' => false,
                'employe_id' => 1,
                'client_id' => 2,
                'quartier_id' => 1,
                'type_habitat_id' => 1,
                'latitude' => 100,
                'longitude' => 100,

            ]

        ]);
    }
}
