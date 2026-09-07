<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournee extends Model
{
    //
    protected $table = 'tournees';
    protected $fillable = ['employes_id', 'zone_id', 'status', 'date', 'itineraire'];

    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class);
    }


    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function ligne_tournees(): HasMany
    {
        return $this->hasMany(LigneTournee::class);
    }



    public function nbr_quartier()
    {
        return $this->quartiers->count();
    }


    public function nbr_menage()
    {
        return $this->ligne_tournees()->count();
    }

    public function nbr_employe()
    {
        return count(json_decode($this->employes_id));
    }


    public function employes_id():Attribute
    {
        
        return json_decode($this->employes_id);
    }
}
