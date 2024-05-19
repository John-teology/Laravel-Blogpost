<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

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


    public function editProfile()
    {
        return view('edit-profile');
    }

    public function saveEditProfile(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000'
        ]);
        // avatar is name in html form
        // $request->file('avatar')->store('public/avatars');
        $user = auth()->user();
        // rezise image| modify the image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));
        $imageData = $image->cover(100,100)->toJpeg();
        // rezise image| modify the image

        // saving the image to the storage
        $filename = $user->username.uniqid();
        Storage::put('public/avatars/'.$filename.'.jpg',$imageData);

        $old_avatar = $user->avatar;

        $user->avatar = $filename.'.jpg';
        $user->save();


        Storage::delete('public/avatars/'.$old_avatar);

        return redirect('/profile/' . $user->username)->with('success','Successfully change avatar');
        // return back()->with('success','Successfully change avatar');
        // back is parang balik sa previous page after the post request



    }
}

