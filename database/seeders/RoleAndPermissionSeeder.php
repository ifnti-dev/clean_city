<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // $roles_client =  Role::where('name', 'client')->first();
        // $roles_client->syncPermissions(
        //    
        // );

        

        $roles_responssable = Role::where('name', 'responssable')->first();
        $roles_responssable->syncPermissions(
            Permission::all()
                
        );


        $roles_comptable = Role::where('name', 'comptable')->first();
        $roles_comptable->syncPermissions(
            Permission::where('name', 'abonnement.voire')
            ->orWhere('name', 'abonnement.annuler')
            ->orWhere('name', 'abonnement.creer')
                
        );

        $roles_secretaire = Role::where('name', 'comptable')->first();
        $roles_secretaire->syncPermissions(
            Permission::where('name', 'commande.confirmer')
            ->orWhere('name', 'commande.rejeter')
            ->get()
                
        );

        

        $roles_livreure = Role::where('name', 'livreure')->first();
        $roles_livreure->syncPermissions(
            Permission::where('name', 'livraison.confirmer' )
                ->orWhere('name', 'livraison.demarer')
                ->get()
        );

        $roles_agent_collecte_fonds = Role::where('name', 'agent_collecte_fonds')->first();
        $roles_agent_collecte_fonds->syncPermissions(
            Permission::where('name', 'client.voire')
                ->orWhere('name', 'client.creer')
                ->orWhere('name', 'client.modifier')
                ->orWhere('name', 'client.supprimer')
                ->get()
        );
    }
}
