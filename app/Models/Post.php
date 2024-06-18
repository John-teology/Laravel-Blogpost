<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function toSearchableArray(){
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }

    public function user(){
        // parang eto yung nag ccreate ng object na user per post   
        return $this->belongsTo(User::class,'user_id');
        // dito nag query na sa User model kung saan ang user_id ay equal sa id ng user
        //  rereturn niya yung buong user object
    }
}
