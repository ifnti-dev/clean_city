<?php

namespace App\Models;

use App\Models\Menage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Abonnement extends Model
{
    //
    protected $table = 'abonnements';
    protected $fillable = ['date_debut', 'date_fin', 'etat'];
    
    public function menage():BelongsTo {
        return $this->belongsTo(Menage::class);
    }
    
    
}










