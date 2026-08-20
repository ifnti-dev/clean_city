<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LigneCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('ligne_commandes')->insert([
            [
                'produit_id' => 1,
                'commande_id' => 1,
                'quantite' => 20,
                'prix_courant' => 2000,
                'montant' => 40000,

            ],
            [
                'produit_id' => 1,
                'commande_id' => 2,
                'quantite' => 10,
                'prix_courant' => 2000,
                'montant' => 20000,
                
            ]
        ]);
        
    }
}
