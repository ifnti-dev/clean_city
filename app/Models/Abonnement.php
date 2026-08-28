<?php

namespace App\Models;

use App\Models\Menage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Abonnement extends Model
{
    //
    protected $table = 'abonnements';
    // ,'tarif_id'
    protected $fillable = ['date_debut', 'date_fin', 'etat','menage_id'];
    
    public function menage():BelongsTo {
        return $this->belongsTo(Menage::class);
    }

    // public function tarif():BelongsTo {
    //     return $this->belongsTo(Tarif::class);
    // }
    
}










