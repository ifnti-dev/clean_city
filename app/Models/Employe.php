<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employe extends Model
{
    //

    protected $table = 'employes';
    protected $fillable = ['user_id'];
    
    public function tournees():HasMany {
        return $this->hasMany(Tournee::class);
    }
}
