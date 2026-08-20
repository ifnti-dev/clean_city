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

        //   $table->string('code');
        //     $table->string('designation')->nullable();
        //     $table->string('latitude')->nullable();
        //     $table->string('longtitude')->nullable();
        //     $table->boolean('est_abonnee');
        //     $table->boolean('est_radier');
        //     $table->boolean('est_valide');
        //     $table->timestamps();
        //     $table->unsignedInteger('user_id');
        //     $table->unsignedInteger('quartier_id')->nullable();
        //     $table->unsignedInteger('type_habitat_id')->nullable();

        DB::table('menages')->insert([
            [
                'code' => '10001',
                'designation' => 'hotele',
                'latitude' => 100,
                'longtitude' => 100,
                'est_abonnee' => true,
                'est_radier' => false,
                'est_valide' => true,
                'user_id' => 1,
                'quartier_id' => 1,
                'type_habitat_id' => 1
               
            ],  
              
        ]);
    }
}
