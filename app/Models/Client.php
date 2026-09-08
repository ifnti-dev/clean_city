<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'clients';
    protected $fillable = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function menages(): HasMany
    {
        return $this->hasMany(Menage::class);
    }


    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }

     public static function total_client()
    {
        return self::count();
    }
}
