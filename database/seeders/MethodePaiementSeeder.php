<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MethodePaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('methode_paiements')->insert([
            [
                'nom' => 'ESPECE',
                'sold' => 12000, 
                
            ]
        ]);





       

    }
}
