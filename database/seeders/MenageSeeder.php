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
        //
        DB::table('menages')->insert([
            [
                'code' => '10001',
                'designation' => 'hotele',
                'est_abonnee' => true,
                'est_radier' => false,
                'est_valide' => true,
                'user_id' => 1,
               
                

            ],    
        ]);
    }
}
