<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_sent_id',
        'user_received_id',
    ];

    public function userSent()
    {
        return $this->belongsTo(User::class, 'user_sent_id');
    }

    public function userReceived()
    {
        return $this->belongsTo(User::class, 'user_received_id');
    }
}
