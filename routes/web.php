<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ClientContoller;
use App\Http\Controllers\ProfileController;
use App\Models\Abonnement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//::middleware('auth')->
// Route::prefix('/responssable')->group(function () {
    Route::resource('abonnees', AbonnementController::class);
    Route::resource('clients', ClientContoller::class);
// })->name('responssable');


