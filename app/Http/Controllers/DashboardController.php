<?php

namespace App\Http\Controllers;

use App\Models\Menage;
use App\Models\TypeHabitat;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        // Regroupe les ménages par type d'habitat et compte les abonnés dans chaque groupe.
        $repartition = TypeHabitat::query()
            ->leftJoin('menages', 'type_habitats.id', '=', 'menages.type_habitat_id')
            ->select(
                'type_habitats.id',
                'type_habitats.designation',
                DB::raw('COUNT(menages.id) as effectif'),
                DB::raw('SUM(CASE WHEN menages.est_abonnee AND NOT menages.est_radier THEN 1 ELSE 0 END) as abonnes')
            )
            ->groupBy('type_habitats.id', 'type_habitats.designation')
            ->orderByDesc('effectif')
            ->orderBy('type_habitats.designation')
            ->get();

        // Distingue les abonnés actifs, les désabonnés et les ménages radiés selon leurs indicateurs.
        $totalMenages = Menage::count();
        $totalAbonnesActifs = Menage::where('est_abonnee', true)
            ->where('est_radier', false)
            ->count();
        $totalDesabonnes = Menage::where('est_abonnee', false)
            ->where('est_radier', false)
            ->count();
        $totalAbonnesRadies = Menage::where('est_radier', true)->count();

        // Détermine une échelle lisible pour le graphique des abonnés actifs.
        $effectifMaximumAbonnes = (int) ($repartition->max('abonnes') ?? 0);
        $pasGraphique = max(1, (int) ceil($effectifMaximumAbonnes / 5));

        // Prépare pour chaque type le pourcentage du total et la largeur de sa barre.
        foreach ($repartition as $typeHabitat) {
            $typeHabitat->effectif = (int) $typeHabitat->effectif;
            $typeHabitat->abonnes = (int) $typeHabitat->abonnes;
            $typeHabitat->pourcentage = $totalMenages > 0
                ? ($typeHabitat->effectif / $totalMenages) * 100
                : 0;
            $typeHabitat->largeur_barre = ($typeHabitat->abonnes / ($pasGraphique * 5)) * 100;
        }

        // Rassemble les valeurs attendues par la vue du tableau de bord.
        $donnees = [
            'total_menages' => $totalMenages,
            'total_abonnes_actifs' => $totalAbonnesActifs,
            'total_desabonnes' => $totalDesabonnes,
            'total_abonnes_radies' => $totalAbonnesRadies,
            'pourcentage_total' => $totalMenages > 0 ? '100,0%' : '0,0%',
            'repartition' => $repartition,
            'graduations_graphique' => collect(range(0, 5))
                ->map(fn (int $index): int => $index * $pasGraphique),
        ];

        // Affiche le dashboard avec les statistiques calculées.
        return view('dashboard', $donnees);
    }
}
