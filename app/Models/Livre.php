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
        'views',
        'sales_count',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function incrementViews()
    {
        $this->increment('views');
        $this->save();
    }
    
}
