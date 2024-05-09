<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function showProfile(User $user)  // User $user is called type hinting
    {
        // same dapat si $user varibalename sa route parameter'
        return view('user-profile',['user' => $user, 'posts' => $user->posts()->latest()->get()]);
    }
    



    public function homepage()
    {
        return view('homepage');
    }

    public function singePost()
    {
        return view('single-post');
    }

    
    public function register(Request $request)
    {
        $data = $request->validate([
            // 'username' => ['required','max:255','min:4',Rule::unique('users','username')],
            'username' => 'required|max:255|min:4|unique:users',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        // Auth::login($user);
        auth()->login($user);
        return redirect('/')->with('success','You are successfully registered and logged in');

    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);
        $user = ['username' => $data['loginusername'],'password' => $data['loginpassword']];
        if(auth()->attempt($user)){
            $request->session()->regenerate();
            return redirect('/')->with('success','You are successfully logged in');

        }
        return redirect('/')->with('error','Invalid login credentials');
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success','You are successfully logged out');
    }
}

