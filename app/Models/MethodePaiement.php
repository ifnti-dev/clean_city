<?php

namespace App\Models;

use App\PaiementAbonnement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MethodePaiement extends Model
{
    //
    protected $table = 'methode_paiements';
    protected $fillable = ['nom', 'sold', 'type'];
    
    //relation
    public function paiement_abonnements(): HasMany{
        return $this->hasMany(PaiementAbonnement::class);
    }

    public function paiement_commandes(): HasMany{
        return $this->hasMany(PaiementCommande::class);
    }
    
}
