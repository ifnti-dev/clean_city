<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ClientContoller;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\TourneeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TypeHabitatController;
use App\Http\Controllers\ZoneController;
use App\Models\Client;
use App\Models\Employe;
use App\Models\Menage;
use App\Models\Tournee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return to_route('login');
});


Route::get('/dashboard', function () {

    $total_client = Client::total_client();
    $total_employe = Employe::total_employe();
    $total_menage = Menage::total_menage();
    $total_tournee = Tournee::total_tournee();

    // dd($total_client);


    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::middleware('auth')->group(function () {
    Route::resource('abonnements', AbonnementController::class);
    Route::post('/abonnements/{abonnement}/piece_justificatif', [AbonnementController::class, 'piece_justificatif'])->name('abonnements.piece_justificatif');
    Route::post('/abonnements/{abonnement}/traitement', [AbonnementController::class, 'traiterUnAbonnement'])->name('abonnements.traitement');
    Route::post('/abonnements/{abonnement}/approuver', [AbonnementController::class, 'approuverUnAbonnement'])->name('abonnements.approuver');
    Route::post('/abonnements/{abonnement}/rejeter', [AbonnementController::class, 'rejeterUnAbonnement'])->name('abonnements.rejeter');
    Route::post('/abonnements/{abonnement}/desabonnee', [AbonnementController::class, 'desabonneeUnMenage'])->name('menages.desabonnee');
    Route::post('/abonnements/{abonnement}/radier', [AbonnementController::class, 'radierUnMenage'])->name('abonnements.radier');
    Route::resource('clients', ClientContoller::class);


    Route::resource('tournees', TourneeController::class);
    Route::post('/tournees/{tournee}/demarer', [TourneeController::class, 'demarerTournee'])->name('tournees.demarer');
    Route::post('/tournees/{tournee}/terminer', [TourneeController::class, 'terminerTournee'])->name('tournees.terminer');
    Route::post('/tournees/{tournee}/annuler', [TourneeController::class, 'annulerTournee'])->name('tournees.annuler');
    Route::post('/ligne_tourner/{lignetournee}/terminer', [TourneeController::class, 'terminerLigneTournee'])->name('ligne_tournee.terminer');




    //Route::post('/factures/checkout', [FactureController::class, 'checkout'])->name('factures.checkout');
    Route::get('/factures/callback', [FactureController::class, 'callback'])->name('factures.callback');

    Route::resource('factures', FactureController::class);

    Route::resource('/produits', ProduitController::class);
    Route::post('/factures/reglerFacture/{commande}', [FactureController::class, 'reglerFacture'])->name('factures.reglerFacture');
    Route::post('/factures/rejeterFacture/{commande}', [FactureController::class, 'rejeterFacture'])->name('factures.rejeterFacture');



    Route::resource('/employes', EmployeController::class);
    Route::resource('/roles', RoleController::class)->except(['show']);
    Route::resource('/tarifs', TarifController::class)->except(['show']);
    Route::resource('/zones', ZoneController::class);
    Route::resource('/quartiers', QuartierController::class)->except(['show']);

    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');

    Route::post('/commandes/debuterLivraison/{commande}', [CommandeController::class, 'debuterLivrason'])->name('commandes.debuterLivraison');
    Route::post('/commandes/livrerlaCommande/{commande}', [CommandeController::class, 'livrerLaCommande'])->name('commandes.livrerLaCommande');
    Route::get('/eCommerce', [CommandeController::class, 'listeProduit'])->name('listProduit');

    Route::resource('/roles', RoleController::class);
    Route::resource('/typeHabitats', TypeHabitatController::class);
});


Route::get('/listeArticle', [CommandeController::class, 'listeArticle'])->name('listeArticle');
