<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaiementCommande extends Model
{
    //
    protected $table = 'paiement_commandes' ;
    protected $fillable = ['methode_paiement_id'];

    public function methode_paiement(): BelongsTo{
        return $this->belongsTo(MethodePaiement::class, 'methodePaiement_id'); 

    }


}
