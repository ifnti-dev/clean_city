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
use SweetAlert2\Laravel\Swal;

class FactureController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        //
        $search = $request->input('search');
        $request = Facture::query();
        if($search){
            $request->where('date_debut', 'like', "%$search%")
                ->orWhere('date_fin', 'like', "%$search%");
        }

      


         if (session(('success'))) {
            // Toast with pause on hover
            if (session('text')) {
                Swal::success([
                    'title' => session('success'),
                    'text' => session('text'),
                    'showConfirmButton' => true,
                ]);
            } else {
                Swal::success([
                    'title' => session('success'),
                    'text' => session('text'),
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ]);
            }
        }


        $factures = $request->get();

        return view('factures.index', compact('factures', 'search'));
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
            'methode_paiement_id' => 'required|integer|exists:methode_paiements,id',
            'abonnement_id' => 'required',
            
        ]);

         
        DB::transaction(function() use($validated){

            $date_debut = Carbon::now();

            $nb_mois = count($validated['lesmois']);
            $date_fin = $date_debut->add( $nb_mois, 'month');


            $tarifs = Tarif::find($validated['tarif_id']);
            $montant_tarif = $tarifs->montant;

            $montant = $nb_mois * $montant_tarif;

            $validated['montant'] = $montant ;

            if($validated['methode_paiement_id'] == 1){
               dd('redirection vers fedapaye');
            }


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

        return to_route('factures.index')->with("success", "vous avez enregistrer un nouveau paiement ");
        

    }

   
    public function show(Facture $facture)
    {
        //
        return view('factures.show', compact( 'facture'));
    }

   
    public function edit(Facture $facture)
    {
        //
        $methode_paiements = MethodePaiement::all();
        $tarifs = Tarif::all();
        $abonnements = Abonnement::with('menage')->get();
        
        return view('factures.edit', compact('facture' ,'methode_paiements', 'tarifs', 'abonnements'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facture $facture)
    {
        //

        $validated = $request->validate([
            'lesmois' => 'required|array',
            'tarif_id' => 'required|integer|exists:tarifs,id',
            'methode_paiement_id' => 'required',
            'abonnement_id' => 'required',
            
        ]);

         
        DB::transaction(function() use($validated, $facture){

            $date_debut = Carbon::now();

            $nb_mois = count($validated['lesmois']);
            $date_fin = $date_debut->add( $nb_mois, 'month');

             
            $tarifs = Tarif::find($validated['tarif_id']);
            $montant_tarif = $tarifs->montant;

            $montant = $nb_mois * $montant_tarif;

            $validated['montant'] = $montant ;

            $facture->update([
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





        return to_route('factures.index')->with("success", "Paiement modifie ");;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
