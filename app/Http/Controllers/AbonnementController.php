<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Menage;
use App\Models\Quartier;
use App\Models\Tarif;
use App\Models\TypeHabitat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;


class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        //
        $abonnements = Abonnement::all();
        // dd($abonnements->menage());
        // dd(Menage::first()->abonnement());
        // dd(session("desabonnee"));

        if (session(('desabonnee'))) {
            // Toast with pause on hover
            Swal::success([
                'title' => 'Auto close alert',
                'position' => 'top-center',
                'icon' => 'succes',
                'Contribution'=>'email',
                'showConfirmButton' => true ,
                'timer' => 2000,
               
        
            ]);
            session('desabonnee');
        }


        return view('abonnees.index', compact('abonnements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clients = Client::get();
        $quartiers = Quartier::get();
        $tarifs = Tarif::get();
        $type_habitats = TypeHabitat::get();
        return view('abonnees.create', compact('tarifs', 'clients', 'type_habitats', 'quartiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            "date_debut" => "required|date:after_now ",
            "date_fin" => "date|nullable",
            "client_id" => "required|integer|exists:clients,id",
            "designation" => "required|string|min:3|unique:menages",
            "tarif_id" => "required|integer|exists:tarifs,id",
            "longitude" => "required|integer",
            "latitude" => "required|integer",
            'type_habitat_id' =>  "required|integer|exists:type_habitats,id",
            'quartier_id' =>  "required|integer|exists:quartiers,id",
        ]);

        // dd($validated);

        DB::transaction(function () use ($validated) {

            $code = "0000" . Menage::latest('id')->first()->id;
            $code = substr($code, -5);
            // dd($code);

            $menage = Menage::create([
                'code' => $code,
                'designation' => $validated['designation'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'est_abonnee' => true,
                'est_radier' => false,
                'est_en_regle' => true,
                'client_id' => $validated['client_id'],
                'type_habitat_id' => $validated['type_habitat_id'],
                'quartier_id' => $validated['quartier_id'],
            ]);


            Abonnement::create([
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'] ? $validated['date_debut'] : null,
                // 'etat' => "ACTIF",
                'tarif_id' => $validated['tarif_id'],
                'menage_id' => $menage->id,
            ]);
        });

        return to_route('abonnements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        dd("show");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonnement $abonnement)
    {
        //

        // dd($abonnement);
        $clients = Client::get();
        $quartiers = Quartier::get();
        $type_habitats = TypeHabitat::get();
        return view('abonnees.edit', compact('abonnement', 'clients', 'type_habitats', 'quartiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        dd("update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        dd("delete");
    }




    public function annulerUnAbonnement(Abonnement $abonnement)
    {
        //
        dd("annulerUnAbonnement");
    }


    public function validerUnAbonnement(Abonnement $abonnement)
    {
        //
        // dd("valider");
        $abonnement->update(
            ['etat' => 'ACTIF']
        );
        return to_route('abonnements.index');
    }

    public function desabonneeUnAbonnement(Abonnement $abonnement)
    {
        //
        // dd("desabonnee");
        $abonnement->update(
            ['etat' => 'INACTIF']
        );

        return to_route('abonnements.index')->with("desabonnee", "vouse avez Desabonnée " . $abonnement->menage->designation);
    }


    public function radierUnAbonnement(Abonnement $abonnement)
    {
        //
        dd("radier");
    }
}
