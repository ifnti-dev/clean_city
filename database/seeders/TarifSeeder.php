<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tarifs')->insert([
            [
                'designation' => 'une fois par semaine',
                'montant' => 1000,
            ],
            [
                'designation' => 'deux fois par semaine',
                'montant' => 1000,
            ]
        ]);
    }
}
