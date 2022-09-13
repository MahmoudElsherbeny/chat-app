<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function user_info()
    {
        return $this->hasOne(User_info::class);
    }

    public function friends() //friends where they sent a request to user
    {
        return $this->belongsToMany(User::class, 'user_friends', 'friend_id', 'user_id')->withPivot('id', 'status');
    }

    public function friending() //friends where user sent them a request
    {
        return $this->belongsToMany(User::class, 'user_friends', 'user_id', 'friend_id')->withPivot('id', 'status');
    }

    public function chat_sender()
    {
        return $this->belongsToMany(User::class, 'chats', 'sender_id', 'receiver_id');
    }

    public function chat_receiver()
    {
        return $this->belongsToMany(User::class, 'chats', 'receiver_id', 'sender_id');
    }

    public function conversation_sender()
    {
        return $this->belongsToMany(User::class, 'conversations', 'sender_id', 'receiver_id')->withPivot('message', 'is_read');
    }

    public function conversation_receiver()
    {
        return $this->belongsToMany(User::class, 'conversations', 'receiver_id', 'sender_id')->withPivot('message', 'is_read');
    }

    public function scopeWithotCurrentUser($query) {
        return $query->where('id','!=',Auth::id());
    }

    public function scopeWithoutFriendsBlocks($query) {
        return $query->Where(function($query) { //without user friend or blocks or on friend request (not shown his relations)
                        foreach(Auth::user()->friending as $user_fr) {
                            $query->where('id', '!=', $user_fr->id);
                        }
                    })
                    ->Where(function($query) {  //for another user (not shown him to anoter users depend on his relation with them)
                        foreach(Auth::user()->friends as $user_fr) {
                            $query->where('id', '!=', $user_fr->id);
                        }
                    });
    }
}
