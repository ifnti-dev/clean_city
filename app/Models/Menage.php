<?php

namespace App\Models;

use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Quartier;
use App\Models\TypeHabitat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menage extends Model
{
    //
    //
    protected $table = 'menages';
    protected $fillable = [
        'code',
        'designation',
        'client_id',
        'type_habitat_id',
        'quartier_id',
        'latitude',
        'longitude',
        'est_abonnee',
        'est_radier',
        'est_en_regle'

    ];


    public function abonnement(): HasOne
    {
        return $this->hasOne(Abonnement::class);
    }

    public function typeHabitat(): BelongsTo
    {
        return $this->belongsTo(TypeHabitat::class);
    }

    public function quartier(): BelongsTo
    {
        return $this->belongsTo(Quartier::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function notifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class);
    }
}
