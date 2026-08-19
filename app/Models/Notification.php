<?php

namespace App\Models;

use App\Menage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    //
    protected $table = 'notifications';
    protected $fillable = ['message', 'date'];
    
    public function menage():BelongsToMany {
        return $this->belongsToMany(Menage::class);
    }
}
