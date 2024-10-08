<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follows;
use Illuminate\Http\Request;
use App\Events\OurExampleEvent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{

    private function shareData($user){ // private means di pwede gamiting sa controller
        $current_follow = 0; // or false 
        $current_follow = Follows::where([['user_id', '=', auth()->user()->id],['followed_user_id', '=', $user->id]])->count();

        View::share("sharedData",['user' => $user, 'user_to_be_follow'=> $user,'current_follow' => $current_follow,'posts' => $user->posts()->latest()->get(),'followers_count' => $user->followers()->get()->count(),'followings_count' => $user->following()->latest()->get()->count()]);
    }

    public function showProfile(User $user)  // User $user is called type hinting
    {
        // $current_follow = 0; // or false 
        // $current_follow = Follows::where([['user_id', '=', auth()->user()->id],['followed_user_id', '=', $user->id]])->count();
        $this->shareData($user);
        // same dapat si $user varibalename sa route parameter'
        return view('user-profile',['posts' => $user->posts()->latest()->paginate(5)]);
    }
    
    public function showProfileFollwers(User $user)  // User $user is called type hinting
    {
        $this->shareData($user);
        return view('user-followers',['followers' => $user->followers()->get()]);
    }

    public function showProfileFollowing(User $user)  // User $user is called type hinting
    {
        $this->shareData($user);
        return view('user-following',['followings' => $user->following()->latest()->get()]);
    }

    // ===================================================================
    public function showProfileRaw(User $user)  
    {
        return response()->json(['theHTML' => view('profile-post-only',['posts' => $user->posts()->latest()->paginate(5)])->render() , 'docTitle' => $user->username . "'s Profile"]);
    }
    
    public function showProfileFollwersRaw(User $user) 
    {
        return response()->json(['theHTML' => view('profile-followers-only',['followers' => $user->followers()->get()])->render() , 'docTitle' => $user->username . "'s Followers"]);
    }


    public function showProfileFollowingRaw(User $user)  
    {
        return response()->json(['theHTML' => view('profile-following-only',['followings' => $user->following()->latest()->get()])->render() , 'docTitle' => $user->username . "'s Followings"]);
    }




    public function homepage()
    {
        if(auth()->user()){
            return view('homepage',['posts' => auth()->user()->feedPosts()->latest()->paginate(5)]);
        }
        // if(Cache::has('totalPost')){
        //     $totalPost = Cache::get('totalPost');
        // }else{
        //     $totalPost = Post::count();
        //     Cache::put('totalPost', $totalPost, 20);
        // }  

        // same as nung nasa tass
        $totalPost = Cache::remember('totalPost', 20, function () {
            // this will remember totalPost for 20 sec else create niya yun sa cache
            return Post::count();
        });

        return view('homepage', ['totalPost' => $totalPost]);
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
        event(new OurExampleEvent());
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


    public function editProfile(User $user)
    {
        if(auth()->user()->id == $user->id)
        {
            return view('edit-profile',['user' => $user]);
        }

        return back()->with('error','You are not authorized to edit this profile');
    }

    public function saveEditProfile(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000'
        ]);
        // avatar is name in html form
        // $request->file('avatar')->store('public/avatars');
        
        $user = auth()->user();

        $filename = $user->id . '-' . uniqid() . '.jpg';

        $imgData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('public/avatars/' . $filename, $imgData);

        $oldAvatar = $user->avatar;

        $user->avatar = $filename;
        $user->save();

        if ($oldAvatar != "/fallback-avatar.jpg") {
            Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
        }

        return redirect('/profile/' . $user->username)->with('success','Successfully change avatar');
        // return back()->with('success','Successfully change avatar');
        // back is parang balik sa previous page after the post request



    }
}

