<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $fillable = ['user_id', 'image', 'status', 'phone']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
