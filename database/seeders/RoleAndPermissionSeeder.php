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

        $roles_directeur = Role::where('name', 'directeur')->first();
        $roles_directeur->syncPermissions(
            Permission::all()
        );



        $roles_agent_collecte_fonds = Role::where('name', 'agent_collecte_fonds')->first();
        $roles_agent_collecte_fonds->syncPermissions(
            Permission::Where('name', 'client.creer')->first(),
            Permission::Where('name', 'client.modifier')->first(),
            Permission::Where('name', 'abonnement.voire')->first(),
            Permission::Where('name', 'abonnement.modifier')->first(),

            Permission::Where('name', 'menage.ajouter')->first(),
            Permission::Where('name', 'menage.modifier')->first(),

            Permission::Where('name', 'facture.voire')->first(),
            Permission::Where('name', 'facture.creer')->first(),
        );


        $agent_collecte_ordures = Role::where('name', 'agent_collecte_ordures')->first();
        $agent_collecte_ordures->syncPermissions(
            Permission::Where('name', 'tournee.voire')->first(),
            Permission::Where('name', 'tournee.demarer')->first(),
            Permission::Where('name', 'tournee.terminer')->first(),
            Permission::Where('name', 'ligne_tournee.terminer')->first()
        );


        $roles_comptable = Role::where('name', 'comptable')->first();
        $roles_comptable->syncPermissions(
            Permission::where('name', 'like', '%abonnement%')
                ->where('name', '!=', 'abonnement.approuver')
                ->where('name', '!=', 'abonnement.rejeter')->get(),
            Permission::where('name', 'like', '%facture%')->get()
        );




        $roles_livreure = Role::where('name', 'livreure')->first();
        $roles_livreure->syncPermissions(
            Permission::where('name', 'livraison.confirmer')
                ->orWhere('name', 'livraison.demarer')
                ->get()
        );



        $roles_client = Role::where('name', 'client')->first();
        $roles_client->syncPermissions(
            Permission::where('name', 'abonnement.voire')
                ->orWhere('name', 'produit.voire')
                ->orWhere('name', 'e_commerce.voire')
                ->get()
        );
    }
}
