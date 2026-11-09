<?php

namespace Database\Seeders;

use App\Models\TypeHabitat;
use Illuminate\Database\Seeder;

class TypeHabitatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Définit les types d'habitat utilisés pour la répartition des statistiques.
        $typesHabitat = [
            'Habitat collectif',
            'Ménage (habitat de 1 ou 2 pièces)',
            'Société/Entreprise',
            'Boutique/Atelier',
            'Ecole',
            'Autre (Hôtel, BAR, CMS)',
            'Ménage (habitat de + 2 pièces)',
            'Option 2',
        ];

        // Crée chaque type manquant sans dupliquer ceux déjà présents.
        foreach ($typesHabitat as $designation) {
            TypeHabitat::firstOrCreate(['designation' => $designation]);
        }
    }
}
