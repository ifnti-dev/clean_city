<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tournee extends Model
{
    //
    protected $table = 'tournees';
    protected $fillable = ['employe_id', 'zone_id', 'statut', 'date', 'itineraire'];

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class);
    }


    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
}
