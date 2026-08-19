<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LigneCommande extends Model
{
    //

    protected $table = 'ligne_commandes';
    protected $fillable = ['produit_id', 'commande_id', 'quantite', 'prix_courrant', 'montant'];
    
    public function commande():BelongsTo {
        return $this->belongsTo(Commande::class);
    }

    public function produit():BelongsTo {
        return $this->belongsTo(Produit::class);
    }
}
