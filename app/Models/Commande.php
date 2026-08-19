<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commande extends Model
{
    //
    protected $table = 'commandes';
    protected $fillable = ['montant', 'est_accepte', 'raison'];
    
    public function client():HasOne {
        return $this->hasOne(Client::class);
    }

    public function paiementCommande():HasOne {
        return  $this->hasOne(PaiementCommande::class);
    }

    public function ligneCommandes():HasMany {
        return $this->hasMany(LigneCommande::class);
    }
    
    

}
