<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'parent_id',
        'subject',
        'body',
        'file_path',
        'is_read',
    ];

    // Relatie: Wie heeft het gestuurd?
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relatie: Voor wie is het?
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Relatie: Alle antwoorden op dit specifieke bericht
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }
}