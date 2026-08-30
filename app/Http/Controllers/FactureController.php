<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Facture;
use App\Models\MethodePaiement;
use App\Models\Tarif;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $factures = Facture::all();
        return view('factures.index', compact('factures'));
    }

   
    public function create()
    {
        //

        $methode_paiements = MethodePaiement::all();
        $tarifs = Tarif::all();
        $abonnements = Abonnement::with('menage')->get();

        return view('factures.create', compact('methode_paiements', 'tarifs', 'abonnements'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesmois' => 'required|array',
            'tarif_id' => 'required|integer|exists:tarifs,id',
            'methode_paiement_id' => 'required',
            'abonnement_id' => 'required',
            
        ]);

         
        DB::transaction(function() use($validated){

            $date_debut = Carbon::parse($validated['date_debut']);

            $nb_mois = count($validated['lesmois']);
            $date_fin = $date_debut->add( $nb_mois, 'month');

             
            $tarifs = Tarif::find($validated['tarif_id']);
            $montant_tarif = $tarifs->montant;

            $montant = $nb_mois * $montant_tarif;

            $validated['montant'] = $montant ;

            $factures = Facture::create([
                'nb_mois' => $nb_mois,
                'date_fin' => $date_fin,
                'les_mois' => $validated['lesmois'],
                'abonnement_id' => $validated['abonnement_id'],
                'tarif_id' => $validated['tarif_id'],
                'methode_paiement_id' => $validated['methode_paiement_id'],
                'montant' => $validated['montant'],
                'id_transaction' => rand(1,20),
            ]);

        });

        return to_route('factures.index');
        

    }

   
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
