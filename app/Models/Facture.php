<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    //
     protected $table = 'factures';
    protected $fillable = [
        'nbMois',
        'mois',
        'date_debut',
        'date_fin',
        'date',
        'montant',
        'transaction_id'
    ];

    
    public function methodePaiement(): BelongsTo {
        return $this->belongsTo(MethodePaiement::class, 'methodePaiement_id'); //a demander 
    }

    public function abonnement(): BelongsTo {
        return $this->belongsTo(Abonnement::class);
    }

    public function tarif(): BelongsTo{
        return $this->belongsTo(Tarif::class);
    }
}
