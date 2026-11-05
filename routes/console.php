<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');




// route personnaliser
Artisan::command('espoir:simuler', function () {
    return $this->call('espoir:import', [
        '--sans-abonnements' => true,
        '--dry-run' => true,
    ]);
})->purpose('Simule l\'import des abonnés (rien n\'est écrit)');

Artisan::command('espoir:peupler', function () {
    if (! $this->confirm('Écrire les abonnés dans la base espoire_plus ? (sauvegarde faite ?)')) {
        $this->warn('Annulé, rien n\'a été écrit.');
        return 0;
    }

    return $this->call('espoir:import', [
        '--sans-abonnements' => true,
    ]);
})->purpose('Importe pour de vrai les abonnés Espoir Plus');