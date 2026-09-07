<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employe extends Model
{
    //

    protected $table = 'employes';
    protected $fillable = ['user_id'];
    
    public function tournees():HasMany {
        return $this->hasMany(Tournee::class);
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function abonnementsApprouve():Hasone {
        return $this->hasOne(Abonnement::class, 'employe_id');
    }

    public function MenageSave():HasOne {
        return $this->hasOne(Menage::class, 'employe_id');
    }

}
