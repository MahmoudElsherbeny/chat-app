<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class User_friend extends Model
{
    protected $fillable = ['user_id', 'friend_id', 'status']; 

    public function scopeFriends($query) {
        return $query->where('status', 2)
                    ->Where(function($query) {
                        $query->where('user_id', Auth::id())
                              ->OrWhere('friend_id', Auth::id());
                    });
    }

    public function scopeUserFriendRelation($query,$user1,$user2,$status) {
        return $query->Where(['user_id' => $user1, 'friend_id' => $user2, 'status' => $status])
                     ->orWhere(function($query) use ($user1,$user2,$status) {
                        return $query->Where(['user_id' => $user2, 'friend_id' => $user1, 'status' => $status]);
                     });
    }

    public function scopeIsFriend($query,$id) {
        return $query->Where(['user_id' => Auth::id(), 'friend_id' => $id])
                     ->orWhere(function($query) use ($id) {
                        return $query->Where(['user_id' => $id, 'friend_id' => Auth::id()]);
                     });
    }

    public function scopeIsBlocked($query,$id) {
        return $query->Where(['user_id' => Auth::id(), 'friend_id' => $id, 'status' => 0]);
    }
}
