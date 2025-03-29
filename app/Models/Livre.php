<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $fillable = [
        'titre',
        'auteur',
        'prix',
        'image',
        'description',
        'stock',
        'categorie_id',
    ];

    // Relation avec la table 'categories'
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    
}
