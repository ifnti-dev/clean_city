<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use App\Models\Client;
use Illuminate\Http\Request;

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
        $clients = Client::with('user')->get();
        return view('abonnees.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validated = $request->validate([
            "date_debut" => "required|date:after_now ",
            "date_fin" => "date",
            "client_id" => "required|integer|exists:clients,id",
            "designation" => "required|string|min:3|unique:menages",
            "longitude" => "required|integer",
            "latitude" => "required|integer",
        ]);

        dd($validated);
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
