<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follows;


class FollowController extends Controller
{
    

    public function followUser(User $user){
        // cannot follow yourself
        // cannot follow the same user twice
        if(auth()->user()->id == $user->id){
            return back()->with('error','You cannot follow yourself');
        }
        $isExistingFollow = Follows::where([['user_id', '=', auth()->user()->id],['followed_user_id', '=', $user->id]])->count();

        if($isExistingFollow > 0){
            return back()->with('error','You are already following ' . $user->username);
        }

        $newFollow = Follows::create([
            'user_id' => auth()->user()->id,
            'followed_user_id' => $user->id
        ]);
        return back()->with('success','You are now following ' . $user->username);
    }

    public function unFollowUser(User $user){
        Follows::where([['user_id', '=', auth()->user()->id],['followed_user_id', '=', $user->id]])->delete();
        return back()->with('success','Successfully unfollow ' . $user->username);

    }


}
