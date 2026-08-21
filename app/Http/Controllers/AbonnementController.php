<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Menage;
use App\Models\Quartier;
use App\Models\TypeHabitat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $type_habitats = TypeHabitat::get();
        return view('abonnees.create', compact('clients', 'type_habitats', 'quartiers'));
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
            "longitude" => "required|integer",
            "latitude" => "required|integer",
            'type_habitat_id' =>  "required|integer|exists:type_habitats,id",
            'quartier_id' =>  "required|integer|exists:quartiers,id",
        ]);

        // dd($validated);

        DB::transaction(function () use ($validated) {

            $code = 12453 + $validated['latitude'];
            $menage = Menage::create([
                'code' => $code,
                'designation' => $validated['designation'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'est_abonnee' => true,
                'est_radier' => false,
                'est_valide' => true,
                'client_id' => $validated['client_id'],
                'type_habitat_id' => $validated['type_habitat_id'],
                'quartier_id' => $validated['quartier_id'],
            ]);


            Abonnement::create([
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'] ? $validated['date_debut'] : null,
                'etat' => "INACTIF",
                'menage_id' => $menage->id,
            ]);
        });

        return to_route('abonnees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        return view('abonnees.edit', compact('abonnement','clients', 'type_habitats', 'quartiers'));
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
