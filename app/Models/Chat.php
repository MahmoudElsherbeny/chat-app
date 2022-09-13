<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    protected $fillable = ['sender_id', 'receiver_id']; 

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function scopeUserChats($query) {
        return $query->Where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id());
    }

    public function scopeChatWith($query,$user_id) {
        return $query->Where(['sender_id' => Auth::id(), 'receiver_id' => $user_id])
                     ->orWhere(function($query) use($user_id) {
                         return $query->Where(['receiver_id' => Auth::id(), 'sender_id' => $user_id]);
                     });
    }
}
