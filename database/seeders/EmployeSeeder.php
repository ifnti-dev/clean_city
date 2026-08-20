<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('users')->insert([
            [
                "nom" =>"liza",
                "prenom" =>"cendrine",
                "contacte" => "90298677" ,
                "email" => "liza@gmail.com",
                "password" => "123456789",
              

            ],
            [
                "nom" =>"kodjo",
                "prenom" =>"ali",
                "contacte" => "97896375" ,
                "email" => "kodjo@gmail.com",
                "password" => "1234567890",
              

            ],
            [
                "nom" =>"assia",
                "prenom" =>"alice",
                "contacte" => "90003000" ,
                "email" => "assia@gmail.com",
                "password" => "12345678901",
              

            ],
            
        ]);

        DB::table("employes")->insert([
            [
                "user_id" => 4
            ],
            [
                "user_id" => 5
            ],
            [
                "user_id" => 6
            ]
        ]);
    }
}
