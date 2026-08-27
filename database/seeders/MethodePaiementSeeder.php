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
                'nom' => 'methode 1',
                'sold' => 12000, 
                'type' => 'MOBILE_MONEY'
            ],
            [
                'nom' => 'methode 2',
                'sold' => 12000, 
                'type' => 'ESPECE'
                
            ],
        ]);





       

    }
}
