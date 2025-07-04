<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'read_at'
    ];

    // Relation : expéditeur
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relation : destinataire
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
