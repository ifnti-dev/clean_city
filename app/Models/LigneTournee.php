<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LigneTournee extends Model
{
    //
    protected $table = 'ligne_tournees';
    protected $fillable = ['tournee_id', 'menage_id','status'];

    public function tournee(): BelongsTo
    {
        return $this->belongsTo(Tournee::class);
    }

    public function menage(): BelongsTo
    {
        return $this->belongsTo(Menage::class);
    }
}
