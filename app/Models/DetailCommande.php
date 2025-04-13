<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'commande_id',
        'livre_id',
        'quantite',
        'prix',
    ];

    /**
     * Get the commande that owns the detail.
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    /**
     * Get the livre that is part of the detail.
     */
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }


}
