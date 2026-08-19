<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $roles_name = [
            'responssable',
            'secretaire',
            'comptable',
            'livreure',
            'client',
            'agent_collecte_ordures',
            'agent_collecte_fonds',
            
        ];

        
 
        foreach($roles_name as $name){
            Role::create(['name' => $name]);

        }
    }
}
