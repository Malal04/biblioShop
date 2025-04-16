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

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';

        return $query->where(function ($q) use ($term) {
            $q->where('titre', 'LIKE', $term)
              ->orWhere('auteur', 'LIKE', $term);
        });
    }
    
}
