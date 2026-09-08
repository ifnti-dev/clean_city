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
            'employe.voire',
            'employe.creer',
            'employe.modifier',
            'employe.supprimer',
            'employe.suspendre',

            'client.voire',
            'client.creer',
            'client.modifier',
            'client.supprimer',

            'menage.voire',
            'menage.creer',
            'menage.modifier',
            'menage.supprimer',
            'menage.radier',
            'menage.desabonnee',

            'abonnement.voire',
            'abonnement.creer',
            'abonnement.modifier',
            'abonnement.approuver',
            'abonnement.traitement',
            'abonnement.rejeter',

            'tarif.voire',
            'tarif.creer',
            'tarif.modifier',
            'tarif.supprimer',
            'tarif.activer',
            'tarif.desactiver',

            'quartier.voire',
            'quartier.creer',
            'quartier.modifier',
            'quartier.supprimer',

            'zone.voire',
            'zone.creer',
            'zone.modifier',
            'zone.supprimer',

            'role.voire',
            'role.creer',
            'role.modifier',
            'role.supprimer',

            'tournee.voire',
            'tournee.creer',
            'tournee.modifier',
            'tournee.supprimer',
            'tournee.demarer',
            'tournee.annuler',
            'tournee.terminer',
            'ligne_tournee.terminer',

            'produit.voire',
            'produit.creer',
            'produit.modifier',
            'produit.supprimer',

            'commande.voire',
            'commande.confirmer',
            'commande.rejeter',
            'commande.creer',

            'livraison.confirmer',
            'livraison.demarer',

            'facture.voire',
            'facture.creer',


            'typeHabitat.creer',
            'typeHabitat.voire',
            'typeHabitat.modifier',
            'typeHabitat.supprimer',

            'e_commerce.voire',
        ];

        foreach ($permissions_name as $name) {
            Permission::create(['name' => $name]);
        }
    }
}
