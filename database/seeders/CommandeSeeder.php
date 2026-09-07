<?php

namespace Database\Seeders;

use App\Models\Commande;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('commandes')->insert([
            [
                "montant" => 4000,
                "est_acceptee" => true,
                "client_id" => 1,
            ],
            [
                "montant" => 6000,
                "est_acceptee" => true,
                "client_id" => 2,
            ]
        ]);
    }
}
