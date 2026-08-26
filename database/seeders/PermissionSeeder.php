<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions_name = [
            'menage.voire',
            'menage.creer',
            'menage.modifier',
            'menage.supprimer',
            'menage.suspendre',
            'menage.desabonnee',

            'employe.voire',
            'employe.creer',
            'employe.modifier',
            'employe.supprimer',
            'employe.suspendre',

            'client.voire',
            'client.creer',
            'client.modifier',
            'client.supprimer',

            'tarif.voire',
            'tarif.creer',
            'tarif.modifier',
            'tarif.supprimer',
            'tarif.activer',
            'tarif.desactiver',

            'produit.voire',
            'produit.creer',
            'produit.modifier',
            'produit.supprimer',
            
            'abonnement.voire',
            'abonnement.creer',
            'abonnement.annuler',

            'commande.confirmer',
            'commande.rejeter',

            'livraison.confirmer',
            'livraison.demarer',
            
        ];

        foreach($permissions_name as $name){
            Permission::create(['name' => $name]);

        }
    }
}
