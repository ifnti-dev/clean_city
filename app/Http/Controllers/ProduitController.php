<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
        $est_en_stock = $request->input('est_en_stock');
        $query = Produit::query();
        //dd($query);
        if($search && $est_en_stock){
            $query->where('label', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('est_en_stock', $est_en_stock);

        }
        

        $produits = $query->paginate(4);
        return view('produits.index', compact('produits', 'search', 'est_en_stock'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'label' => 'required|string|min:3',
            'prix_unitaire' => 'required|integer',
            'description' => 'nullable|string',
        ]);


       
            $produit = Produit::create([
                'label' => $validated['label'],
                'prix_unitaire' => $validated['prix_unitaire'],
                'decsription' => $validated['description'],
                'est_en_stock' => 1,
            ]);
    
        
        return to_route('produits.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
        return view('produits.edit', compact('produit'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        //
        $validated = $request->validate([
            'label' => 'required|string|min:3',
            'prix_unitaire' => 'required|integer',
            'description' => 'nullable|string',
        ]);


        
            $produit->update([
                'label' => $validated['label'],
                'prix_unitaire' => $validated['prix_unitaire'],
                'description' => $validated['description'],
                'est_en_stock' => 1,
            ]);
     
            return to_route('produits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
