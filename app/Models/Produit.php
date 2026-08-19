<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    //
    protected $table = 'produits';
    protected $fillable = ['label', 'est_en_stock', 'prix_unitaire', 'description'];
    
    public function ligne_commandes():HasMany {
        return $this->hasMany(LigneCommande::class);
    }

}
