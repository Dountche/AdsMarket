<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id_cat',
        'title',
        'description',
        'price',
        'status',
        'city'
    ];

    // Relation : propriétaire
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : catégorie
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relation : photos
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Relation : utilisateurs l’ayant en favori
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorites')
                    ->withTimestamps();
    }
}
