<?php

namespace Database\Seeders;

use App\Models\Commande;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Commande::create([
            [
                "montant" => 4000,
                "est_acceptee" => true,
            ],
            [
                "montant" => 6000,
                "est_acceptee" => true,
            ]
        ]);
    }
}
