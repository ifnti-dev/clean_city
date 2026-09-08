<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeHabitat extends Model
{
    //
    protected $table = 'type_habitats';
    protected $fillable = ['designation'];

    public function menages():HasMany {
        return $this->hasMany(Menage::class);
    }
}

