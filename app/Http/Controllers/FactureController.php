<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\MethodePaiement;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('factures.create', compact('methode_paiements', 'tarifs'));
    }

    
    public function store(Request $request)
    {
        //
        $validated = $request->validate([

            'nb_mois' => 'required|integer',
            'montant' => 'required|integer',
            'date_debut' => 'required|date|after_or_equal:today ',
            'date_fin' => 'required|date',
            'mois' => 'nullable',
            'tarif_id' => 'required',
            'methode_paiement_id' => 'required',
            

        ]);

        DB::transaction(function() use($validated){

            $factures = Facture::create([
                'nb_mois' => $validated['nb_mois'],
                'montant' => $validated['montant'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
                'date_mois' => $validated['mois'],
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
