<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Zone::query();

        if ($request->filled('search')) {

            $search = $request->search;
            $query->where('designation','like',"%$search%");
        }
        $zones = $query->latest('id')->paginate(10);
        return view('zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('zones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'designation' => 'required|string|max:255|unique:zones,designation',
        ]);

        Zone::create($validated);
        return redirect()->route('zones.index')->with('success', 'Zone créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone, Request $request)
    {
        // pour filtrer les quartier d'une zone donnee
        $search = $request->input('search');
        $query = $zone->quartiers();

        if ($search) {
            $query->where('designation', 'like', '%' . $search . '%');
        }

        // withQueryString : serve les paramètres de la requete dans la pagination
        // cet a dire que si on fait une recherche et qu'on change de page, la recherche sera conservee
        $quartiers = $query->paginate(10)->withQueryString();
        return view('zones.show', compact('zone', 'quartiers'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
        //
        return view('zones.edit', compact('zone'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
        //
        $validated = $request->validate([
            'designation' => 'required|string|max:255|unique:zones,designation,' . $zone->id,
        ]);

        $zone->update($validated);
        return redirect()->route('zones.index')->with('success', 'Zone modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        //
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone supprimée avec succès.');
    }
}
