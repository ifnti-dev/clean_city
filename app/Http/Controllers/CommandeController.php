<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function index(Request $request){

        $search = $request->input('search');

        $commandes = Commande::all();
        return view('commandes.index', compact('commandes', 'search'));
    }
}

