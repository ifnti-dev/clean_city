<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        //sweet alerte
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

        $tarifs = Tarif::paginate(10);
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
