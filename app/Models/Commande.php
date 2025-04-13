<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statut',
        'prix_total',
        'date_paiement',
    ];

    /**
     * Get the user that owns the commande.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the details for the commande.
     */
    public function details()
    {
        return $this->hasMany(DetailCommande::class);
    }

    /**
     * Get the paiement associated with the commande.
     */
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

}
