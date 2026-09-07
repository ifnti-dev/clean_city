<?php

namespace App\Models;

use App\Models\Menage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonnement extends Model
{
    //

    use SoftDeletes;
    protected $table = 'abonnements';
    // ,'tarif_id'
    protected $fillable = ['date_debut', 'date_fin', 'etat', 'menage_id', 'status', 'employe_approuve_id'];

    public function menage(): BelongsTo
    {
        return $this->belongsTo(Menage::class);
    }

    public function employe_approuve(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_approuve_id');
    }

}



