<?php

namespace App\Models;

use App\PaiementAbonnement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarif extends Model
{
    //
    //
    protected $table = 'tarifs';
    protected $fillable = ['designation', 'montant'];

    public function paiement_abonnements():HasMany {
        return $this->hasMany(PaiementAbonnement::class);
    }

   
}
