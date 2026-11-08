<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\SweetAlert;
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
        SweetAlert::sweetAlertMessage();

        $search = $request->input('search');
        $est_en_stock = $request->input('est_en_stock');
        $query = Produit::query();
        //dd($query);
        if ($request->filled('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('label', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->filled('est_en_stock')) {
            $query->where('est_en_stock', $est_en_stock);
        }

        $produits = $query->paginate(10)->withQueryString();
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
        $data = $request->validate([
            'label' => 'required|string|min:3',
            'prix_unitaire' => 'required|integer',
            'description' => 'nullable|string',
        ]);


       
            $produit = Produit::create([
                'label' => $data['label'],
                'prix_unitaire' => $data['prix_unitaire'],
                'decsription' => $data['description'],
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
        $data = $request->validate([
            'label' => 'required|string|min:3',
            'prix_unitaire' => 'required|integer',
            'description' => 'nullable|string',
        ]);


        
            $produit->update([
                'label' => $data['label'],
                'prix_unitaire' => $data['prix_unitaire'],
                'description' => $data['description'],
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
