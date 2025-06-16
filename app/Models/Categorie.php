<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Relation : annonces dans cette catégorie
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
