<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                "nom" =>"abdoulaye",
                "prenom" =>"abdoulaye",
                "contacte" => "71852914" ,
                "email" => "abdoulaye@gmail.com",
                "password" =>Hash::make("11111111"),
              

            ],
            [
                "nom" =>"kodjovi",
                "prenom" =>"alic",
                "contacte" => "97896545" ,
                "email" => "kodjovi@gmail.com",
                "password" => Hash::make("1234567890"),
              

            ],
            [
                "nom" =>"assih",
                "prenom" =>"reine",
                "contacte" => "90000000" ,
                "email" => "assih@gmail.com",
                "password" => Hash::make("12345678901"),
              

            ],
            
        ]);

        DB::table("clients")->insert([
            [
                "user_id" => 1
            ],
            [
                "user_id" => 2
            ],
            [
                "user_id" => 3
            ]
        ]);
        
    }
}
