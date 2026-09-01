<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quartier extends Model
{
    //
     protected $table = 'quartiers';
    protected $fillable = ['designation','zone_id'];
    
    public function menages():HasMany {
        return $this->hasMany(Menage::class);
    }

     public function zone():BelongsTo {
        return $this->belongsTo(Quartier::class);
    }
}
