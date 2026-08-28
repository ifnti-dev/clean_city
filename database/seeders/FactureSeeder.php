<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('factures')->insert([
            [
                'nb_mois' => 1,
                'date_debut' => now(),
                'date_fin' => '5-6-2026',
                'mois' => json_encode(['janvier', 'fevrier']),
                'abonnement_id' => 1,
                'tarif_id' => 1,
                'methode_paiement_id' =>1 ,
                'date' => now(),
                'montant' => 1000,
                'id_transaction' => 1,

            ]
        ]);
    }
}
