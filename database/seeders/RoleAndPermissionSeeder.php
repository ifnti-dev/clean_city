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

        $roles_responssable = Role::where('name', 'responssable')->first();
        $roles_responssable->syncPermissions(
            Permission::all()
        );



        $agent_collecte_ordures = Role::where('name', 'agent_collecte_ordures')->first();
        $agent_collecte_ordures->syncPermissions(
            Permission::where('name', 'tournee.demarer')
                ->orWhere('name', 'tournee.voire')
                ->orWhere('name', 'tournee.terminer')
                ->orWhere('name', 'ligne_tournee.terminer',)
                ->get()
        );


        $roles_comptable = Role::where('name', 'comptable')->first();
        $roles_comptable->syncPermissions(
            Permission::where('name', 'like', '%abonnement%')->get()
        );


        $roles_secretaire = Role::where('name', 'comptable')->first();
        $roles_secretaire->syncPermissions(
            Permission::where('name', 'commande.confirmer')
                ->orWhere('name', 'commande.rejeter')
                ->get()

        );



        $roles_livreure = Role::where('name', 'livreure')->first();
        $roles_livreure->syncPermissions(
            Permission::where('name', 'livraison.confirmer')
                ->orWhere('name', 'livraison.demarer')
                ->get()
        );

        $roles_agent_collecte_fonds = Role::where('name', 'agent_collecte_fonds')->first();
        $roles_agent_collecte_fonds->syncPermissions(
            Permission::where('name', 'client.voire')
                ->orWhere('name', 'client.creer')
                ->orWhere('name', 'client.modifier')
                ->orWhere('name', 'client.supprimer')
                ->orWhere('name', 'paiement.voire')
                ->orWhere('name', 'paiement.creer')
                ->orWhere('name', 'paiement.modifier')
                ->get()
        );


        $roles_client = Role::where('name', 'client')->first();
        $roles_client->syncPermissions(
            Permission::where('name', 'paiement.voire')
                ->orWhere('name', 'abonnement.voire')
                ->get()
        );
    }
}
