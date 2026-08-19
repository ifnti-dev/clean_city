<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tournee extends Model
{
    //
        protected $table = 'tournees';
    protected $fillable = ['status','date','itineraire'];
    
    public function employe():BelongsTo {
        return $this->belongsTo(Employe::class);
    }


     public function zone():BelongsTo {
        return $this->belongsTo(Zone::class);
    }
}
