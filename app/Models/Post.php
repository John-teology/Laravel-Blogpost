<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
        // dito nag query na sa User model kung saan ang user_id ay equal sa id ng user
        //  rereturn niya yung buong user object
    }
}
