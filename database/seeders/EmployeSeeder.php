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
                "nom" => "directeur",
                "prenom" => "respo",
                "contacte" => "90000001",
                "email" => "directeur@gmail.com",
                "password" => Hash::make("11111111"),


            ],
            [
                "nom" => "livreure",
                "prenom" => "livreure",
                "contacte" => "90000002",
                "email" => "livreure@gmail.com",
                "password" => Hash::make("11111111"),



            ],

            [
                "nom" => "agent_cf",
                "prenom" => "agent_cf",
                "contacte" => "90000003",
                "email" => "agent_cf@gmail.com",
                "password" => Hash::make("11111111"),
            ],
            [
                "nom" => "agent_co",
                "prenom" => "agent_co",
                "contacte" => "90000004",
                "email" => "agent_co@gmail.com",
                "password" => Hash::make("11111111"),
            ],

            [
                "nom" => "comptable",
                "prenom" => "comptable",
                "contacte" => "90000005",
                "email" => "comptable@gmail.com",
                "password" => Hash::make("11111111"),
            ],

            [
                "nom" => "agent_co2",
                "prenom" => "agent_co2",
                "contacte" => "90000006",
                "email" => "agent_co2@gmail.com",
                "password" => Hash::make("11111111"),
            ],
            [
                "nom" => "agent_co1",
                "prenom" => "agent_co1",
                "contacte" => "90000007",
                "email" => "agent_co1@gmail.com",
                "password" => Hash::make("11111111"),
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
            ],
            [
                "user_id" => 7
            ],
            [
                "user_id" => 8
            ],
            [
                "user_id" => 9
            ],
            [
                "user_id" => 10
            ],


        ]);

        /**
         *  
            'directeur',
            'comptable',
            'agent_collecte_ordures',
            'agent_collecte_fonds',
            'livreure',
         */
        //assigner les roles aux employes
        $respo = User::where('contacte', '90000001')->first();
        $respo->assignRole('directeur');

        $livreure = User::where('contacte', '90000002')->first();
        $livreure->assignRole('livreure');

        $agent_cf = User::where('contacte', '90000003')->first();
        $agent_cf->assignRole('agent_collecte_fonds');

        $agent_co = User::where('contacte', '90000004')->first();
        $agent_co->assignRole('agent_collecte_ordures');

        $agent_co1 = User::where('contacte', '90000007')->first();
        $agent_co1->assignRole('agent_collecte_ordures');

        $agent_co2 = User::where('contacte', '90000007')->first();
        $agent_co2->assignRole('agent_collecte_ordures');


        $comptable = User::where('contacte', '90000005')->first();
        $comptable->assignRole('comptable');
    }
}
