<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Employe;
use App\Models\Facture;
use App\Models\MethodePaiement;
use App\Models\Tarif;
use Carbon\Carbon;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;

class FactureController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:facture.voire', only: ['index', 'show']),
            new Middleware('permission:facture.creer', only: ['create', 'store']),

        ];
    }

    public function __construct()
    {
        FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_ENVIRONMENT'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $montant = $request->input('montant');
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        $query = Facture::query();
        if ($date_fin && $date_debut) {
            $query->whereBetween('date', [$date_debut, $date_fin]);
               
        }


        if($montant) {
            $query->where('montant', 'like', "%$montant%");
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

        $factures = $query->paginate(4);
        return view('factures.index', compact('factures', 'date_debut', 'date_fin','montant'));
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

        $date_debut = Carbon::now();
        $nb_mois = count($validated['lesmois']);
        $date_fin = $date_debut->add($nb_mois, 'month');

        $tarifs = Tarif::find($validated['tarif_id']);
        $montant_tarif = $tarifs->montant;
        $montant = $nb_mois * $montant_tarif;
        $validated['montant'] = $montant;

        $facture = ([
            'nb_mois' => $nb_mois,
            'date_fin' => $date_fin,
            'les_mois' => $validated['lesmois'],
            'abonnement_id' => $validated['abonnement_id'],
            'tarif_id' => $validated['tarif_id'],
            'methode_paiement_id' => $validated['methode_paiement_id'],
            'montant' => $validated['montant'],
        ]);

        session(['facture' => $facture]);
        session()->save();

        

    
        $methode_paiements = MethodePaiement::find($validated['methode_paiement_id']);
        
        if ($methode_paiements->type === 'MOBILE_MONEY') {
            $transaction = Transaction::create([
                'description' => 'Payment de la facture numero',
                'amount' => $montant,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => route('factures.callback'),
                'mode' => 'mtn_open',
                'customer' => [
                    'firstname' => 'ganietou',
                    'lastname' => 'kondi',
                ],
            ]);


            return redirect($transaction->payment_url);
        } 
        
        DB::transaction(function () use ($validated, $nb_mois, $date_fin) {
            $facture = Facture::create([
                'nb_mois' => $nb_mois,
                'date_fin' => $date_fin,
                'les_mois' => $validated['lesmois'],
                'abonnement_id' => $validated['abonnement_id'],
                'tarif_id' => $validated['tarif_id'],
                'methode_paiement_id' => $validated['methode_paiement_id'],
                'montant' => $validated['montant'],
                
            ]);

        });

        $abonnee = Abonnement::find($validated['abonnement_id']);

        return to_route('factures.index')->with('success', 'vous avez enregistrer un nouveau paiement pour '.strtoupper($abonnee->menage->designation) );
       
    }



    public function show(Facture $facture)
    {
        //
        return view('factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        //
        $methode_paiements = MethodePaiement::all();
        $tarifs = Tarif::all();
        $abonnements = Abonnement::with('menage')->get();

        return view('factures.edit', compact('facture', 'methode_paiements', 'tarifs', 'abonnements'));

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

        DB::transaction(function () use ($validated, $facture) {

            $date_debut = Carbon::now();

            $nb_mois = count($validated['lesmois']);
            $date_fin = $date_debut->add($nb_mois, 'month');

            $tarifs = Tarif::find($validated['tarif_id']);
            $montant_tarif = $tarifs->montant;

            $montant = $nb_mois * $montant_tarif;

            $validated['montant'] = $montant;

            $facture->update([
                'nb_mois' => $nb_mois,
                'date_fin' => $date_fin,
                'les_mois' => $validated['lesmois'],
                'abonnement_id' => $validated['abonnement_id'],
                'tarif_id' => $validated['tarif_id'],
                'methode_paiement_id' => $validated['methode_paiement_id'],
                'montant' => $validated['montant'],

            ]);

        });

        return to_route('factures.index')->with('success', 'Paiement modifie ');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

  
    public function callback(Request $request)
    {
        // verifier si le paiement a ete effectue
        // enregistrer le paiement si le payement est passe

        $transactionId = $request->input('id');
        $status = $request->input('status');
        $facture = session('facture');
        // $facture['nb_mois']


        if ($transactionId) {
            switch ($status) {
                case 'approved':
                    // confirmer le payement chez fedapay
                    // enregistrer le paiement puis on retourn sur la page d'acceuille
                  
                    Facture::create([
                        'nb_mois' => $facture['nb_mois'],
                        'date_fin' => $facture['date_fin'],
                        'les_mois' => $facture['lesmois'],
                        'abonnement_id' => $facture['abonnement_id'],
                        'tarif_id' => $facture['tarif_id'],
                        'methode_paiement_id' => $facture['methode_paiement_id'],
                        'montant' => $facture['montant'],
                        'id_transaction' => $transactionId,
                    ]);


                    return to_route('factures.index')->with('success', 'vous avez enregistrer un nouveau paiement ');

                default:
                    return to_route('factures.create');

            }
        }

    }

    public function reglerFacture(Facture $facture){
        $facture->update([
            'etat_paiement' => 'PAIYEE',
        ]);

        return to_route('factures.index');
    }

     public function rejeterFacture(Facture $facture){
        $facture->update([
            'etat_paiement' => 'ECHOUEE',
        ]);

        return to_route('factures.index');
    }





}
