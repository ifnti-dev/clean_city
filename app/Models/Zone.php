<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    //
    //
    protected $table = 'zones';
    protected $fillable = ['designation'];

    public function tournees(): HasMany
    {
        return $this->hasMany(Tournee::class);
    }


    public function quartiers(): HasMany
    {
        return $this->hasMany(Quartier::class);
    }
}
