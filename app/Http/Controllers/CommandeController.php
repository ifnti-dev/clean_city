<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\SweetAlert;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function index(Request $request){

        SweetAlert::sweetAlertMessage();

        $search = $request->input('search');
        $query = Commande::query();

        if($search){
            $query->where('statut_livraison', 'like', "%$search%");
        }

        $commandes = $query->paginate(10)->withQueryString();
        return view('commandes.index', compact('commandes', 'search'));
    }

    function debuterLivrason(Commande $commande){
        $commande->update([
            'statut_livraison' => 'DEBUTER',
        ]);
        return to_route('commandes.index');
    }

    
    function livrerLaCommande(Commande $commande){
        $commande->update([
            'statut_livraison' => 'LIVRER'
        ]);

        return to_route('commandes.index');
    }

    function listeProduit(Request $request){

        $search = $request->input('search');
        $query = Produit::query();
        if ($request->filled('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('label', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });

        }
        
        $produits = $query->paginate(8)->withQueryString();
        return view('produits.liste_produits', compact('produits', 'search'));
    }
    

    function afficherPanier(){


    
        return view('produits.panier');
    }
    


}
