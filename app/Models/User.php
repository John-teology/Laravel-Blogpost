<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feedPosts(){

        return $this->hasManyThrough(Post::class,Follows::class,"user_id","user_id","id","followed_user_id");
        // get post of following
        // 1st and 2nd args is yung 2 table
        // 3rd and 4th is yung dalawang ID na nag coconnect sa kanila
        // 5th and 6th is yung current user id at yung user id ng followed user
    }

    public function posts(){
        return $this->hasMany(Post::class,'user_id');
        // dito nag query na sa User model kung saan ang user_id ay equal sa id ng user
        //  rereturn niya yung buong user object
    }

    public function getavatar(){
        return $this->avatar ? '/storage/avatars/'.$this->avatar : '/fallback-avatar.jpg';
    }

    public function followers(){
        return $this->hasMany(Follows::class,'followed_user_id');
    }

    public function following(){
        return $this->hasMany(Follows::class,'user_id');
    }


    // belongsTo
    // hasMany
}
