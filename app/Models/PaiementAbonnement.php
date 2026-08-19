<?php

namespace App;

use App\Models\Abonnement;
use App\Models\MethodePaiement;
use App\Models\Tarif;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaiementAbonnement extends Model
{
    //
    protected $table = 'paiement_abonnements';
    protected $fillable = [
        'nbMois',
        'mois',
        'date_debut',
        'date_fin'
    ];

    
    public function methodePaiement(): BelongsTo{
        return $this->belongsTo(MethodePaiement::class, 'methodePaiement_id'); //a demander 
    }

    public function abonnement(): BelongsTo {
        return $this->belongsTo(Abonnement::class);
    }

    public function tarif(): BelongsTo{
        return $this->belongsTo(Tarif::class);
    }
        
}