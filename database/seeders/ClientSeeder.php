<?php

namespace Database\Seeders;

use App\Models\User;
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
                "nom" =>"koffi",
                "prenom" =>"koffi",
                "contacte" => "71852914" ,
                "email" => "koffi@gmail.com",
                "password" =>Hash::make("11111111"),

            ],
            [
                "nom" =>"kodjovi",
                "prenom" =>"alic",
                "contacte" => "97896545" ,
                "email" => "kodjovi@gmail.com",
                "password" => Hash::make("11111111"),
              

            ],
            [
                "nom" =>"assih",
                "prenom" =>"reine",
                "contacte" => "90000000" ,
                "email" => "assih@gmail.com",
                "password" => Hash::make("1111111"),
              

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


        $client = User::where('contacte', '97896545')->first();
        $client->assignRole('client');
        
    }
}


        
