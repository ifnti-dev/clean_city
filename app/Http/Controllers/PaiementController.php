<?php

namespace App\Http\Controllers;

use App\PaiementAbonnement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    //
    public function liste_paiement(){
        $paiement_abonnee = PaiementAbonnement::all();
        
    }
}
