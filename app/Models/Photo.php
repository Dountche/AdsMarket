<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'ad_id',
        'path'
    ];

    // Relation : annonce
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
