<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'followed_user_id',
    ];


    public function getfolloweruser(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getfollowinguser(){
        return $this->belongsTo(User::class,'followed_user_id');
    }
}
