<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Models\Zone;
use Illuminate\Http\Request;

class QuartierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $quartiers = Quartier::paginate(10);
        return view('quartiers.index', compact('quartiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        // dd($request->all());
        $zone_id=$request->zone_id;
        // $query = Zone::query();
        // if ($zone_id) {
        //     $query->where('id',$zone_id);
        // }

        $zones= Zone::paginate(8)->withQueryString();
        return view('quartiers.create', compact('zones'))->with('zone_id',$zone_id);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validated = $request->validate([
            'designation' => 'required|string|max:255|unique:quartiers,designation',
            'zone_id' => 'required|exists:zones,id',
        ]);

        Quartier::create($validated);

        return redirect()->route('quartiers.index')->with('success', 'Quartier créé avec succès.');
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
    public function edit(Quartier $quartier)
    {
        //
        $zones = Zone::all();
        return view('quartiers.edit', compact('quartier', 'zones'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quartier $quartier)
    {
        //
        $validated = $request->validate([
            'designation' => 'required|string|max:255|unique:quartiers,designation,' . $quartier->id,
            'zone_id' => 'required|exists:zones,id',
        ]);

        $quartier->update($validated);
        return redirect()->route('quartiers.index')->with('success', 'Quartier modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quartier $quartier)
    {
        //
        $quartier->delete();
        return redirect()->route('quartiers.index')->with('success', 'Quartier supprimé avec succès.');
    }
}
