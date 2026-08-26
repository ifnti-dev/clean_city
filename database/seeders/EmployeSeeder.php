<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                "password" => Hash::make("123456789"),
              

            ],
            [
                "nom" =>"kodjo",
                "prenom" =>"ali",
                "contacte" => "97896375" ,
                "email" => "kodjo@gmail.com",

                "password" => Hash::make("1234567890"),

              

            ],
            [
                "nom" =>"assia",
                "prenom" =>"alice",
                "contacte" => "90003000" ,
                "email" => "assia@gmail.com",

                "password" => Hash::make("12345678"),
              

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


        $employe = User::where('contacte', '90003000')->first();
        $employe->assignRole('agent_collecte_fonds');
    }
}
