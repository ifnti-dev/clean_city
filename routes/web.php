<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ClientContoller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RamassageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    
    return to_route('login');
});






Route::get('/dashboard', function () {
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
    Route::post('/abonnements/{abonnement}/radier', [AbonnementController::class, 'radierUnMenage'])->name('abonnements.radier');
    Route::post('/abonnements/{abonnement}/annuler', [AbonnementController::class, 'annulerUnAbonnement'])->name('abonnements.annuler');
    Route::post('/abonnements/{abonnement}/valider', [AbonnementController::class, 'validerUnAbonnement'])->name('abonnements.valider');
    Route::post('/abonnements/{abonnement}/desabonnee', [AbonnementController::class, 'desabonneeUnAbonnement'])->name('abonnements.desabonnee');
    Route::resource('clients', ClientContoller::class);



    Route::resource('ramassages', RamassageController::class);
    Route::post('/ramassages/{tournee}/demarer', [RamassageController::class, 'demarerRamassage'])->name('ramassages.demarer');
    Route::post('/ramassages/{tournee}/terminer', [RamassageController::class, 'terminerRamassage'])->name('ramassages.terminer');
    Route::post('/ramassages/{tournee}/annuler', [RamassageController::class, 'annulerRamassage'])->name('ramassages.annuler');
});
