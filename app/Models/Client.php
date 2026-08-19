<?php

namespace App\Models;

use App\Menage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    //
    protected $table = 'clients';
    protected $fillable = ['user_id'];
    
    public function menages():HasMany {
        return $this->hasMany(Menage::class);
    }

     public function commandes():HasMany {
        return $this->hasMany(Zone::class);
    }
    
}
