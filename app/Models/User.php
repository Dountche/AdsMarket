<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'fstname',
        'email',
        'passwd',
        'phone',
        'profil_path',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'passwd',
        'remember_token',
    ];

     // Relation : un utilisateur a plusieurs annonces
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    // Relation : favoris (N ↔︎ N avec Ads)
    public function favorites()
    {
        return $this->belongsToMany(Ad::class, 'user_favorites')
                    ->withTimestamps();
    }

    // Relation : messages envoyés
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Relation : messages reçus
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // Vérifie si l’annonce donnée est déjà en favori
    public function hasFavorited(Ad $ad): bool
    {
        return $this->favorites()->where('ad_id', $ad->id)->exists();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'passwd' => 'hashed',
        ];
    }
}
