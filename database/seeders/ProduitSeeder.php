<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('produits')->insert([
            [
                'label' => 'charbon',
                'est_en_stock' => false,
                'prix_unitaire' => 12000,
                'description' => 'un charbon',
            ]
        ]);
    }
}
