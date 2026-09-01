<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    //
     protected $table = 'factures';
    protected $fillable = [
        'nb_mois',
        'les_mois',
        'date_debut',
        'date_fin',
        'date',
        'montant',
        'abonnement_id',
        'tarif_id',
        'methode_paiement_id',
        'id_transaction',
    ];
    protected $casts = [
    'les_mois' => 'array', // Convertit automatiquement le JSON en tableau PHP
];

    
    public function methodePaiement(): BelongsTo {
        return $this->belongsTo(MethodePaiement::class, 'methode_paiement_id'); //a demander 
    }

    public function abonnement(): BelongsTo {
        return $this->belongsTo(Abonnement::class);
    }

    public function tarif(): BelongsTo{
        return $this->belongsTo(Tarif::class);
    }
}
