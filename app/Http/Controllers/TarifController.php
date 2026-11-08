<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\SweetAlert;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'montant_min' => ['nullable', 'numeric', 'min:0'],
            'montant_max' => ['nullable', 'numeric', 'min:0'],
        ]);

        SweetAlert::sweetAlertMessage();

        $query = Tarif::query();

        if ($request->filled('search')) {
            $query->where('designation', 'like', '%' . $filters['search'] . '%');
        }

        if ($request->filled('montant_min')) {
            $query->where('montant', '>=', $filters['montant_min']);
        }

        if ($request->filled('montant_max')) {
            $query->where('montant', '<=', $filters['montant_max']);
        }

        $tarifs = $query->paginate(10)->withQueryString();
        return view('tarifs.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tarifs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // designation et montant
        $validated = $request->validate([
            'designation' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0|max:1000000',
        ]);

        Tarif::create($validated);

        return redirect()->route('tarifs.index')->with('success', 'Tarif créé avec succès.');
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
    public function edit(Tarif $tarif)
    {
        //
        return view('tarifs.edit', compact('tarif'));
    }
    
        //



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarif)
    {
        //
        $validated = $request->validate([
            'designation' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0|max:1000000',
        ]);

        $tarif->update($validated);

        return redirect()->route('tarifs.index')->with('success', 'Tarif mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();
    }
}
