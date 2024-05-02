<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function createPost(Request $request){
        return view('create-post');
     
    }

    public function savePost(Request $request){
        $data = $request->validate([
            'title' => 'required',
            // 'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($data['title']); // striptags is used to remove html tags
        $incomingFields['content'] = strip_tags($data['body']);
        $incomingFields['user_id'] = auth()->user()->id;

        Post::create($incomingFields);
        return redirect('/createpost')->with('success','Post created successfully');
    }
}
