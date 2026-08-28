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
        //dd($abonnements);

        return view('factures.create', compact('methode_paiements', 'tarifs', 'abonnements'));
    }

    
    public function store(Request $request)
    {
        //
        $validated = $request->validate([

            'nb_mois' => 'required|integer',
            'montant' => 'required|integer',
            'date_debut' => 'required|date|after_or_equal:today ',
            'date_fin' => 'nullable',
            'mois' => 'nullable',
            'tarif_id' => 'required',
            'methode_paiement_id' => 'required',
            'abonnement_id' => 'required',
            

        ]);

         
        DB::transaction(function() use($validated){
            $date = $validated['date_debut'];
            $date_ = Carbon::parse($date);
            //dd(Carbon::parse($date));

            $date_fin = $date_->add( (int) $validated['nb_mois'], 'month');
            

            $factures = Facture::create([
                
                'nb_mois' => $validated['nb_mois'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $date_fin,
                'abonnement_id' => $validated['abonnement_id'],
                'tarif_id' => $validated['tarif_id'],
                'methode_paiement_id' => $validated['methode_paiement_id'],
                'date' => $date,
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
