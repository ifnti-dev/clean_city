<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('abonnements')->insert([
            [
                'date_debut' => now(),
                'menage_id' => 1,
            ],
            [
                'date_debut' => now(),
                'menage_id' => 2,
                
            ]
        ]);
    }
}
