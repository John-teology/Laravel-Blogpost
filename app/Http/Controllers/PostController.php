<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
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

        $newPost = Post::create($incomingFields);
        return redirect("/post/{$newPost->id}")->with('success','Post created successfully');
        // pag mag paparse ng string ng variable sa loob ng string use double quotes
    }

    public function getPost(Post $post){  // $post or any variable name should be an ID of that model in this case `Post`
        $post['content'] = strip_tags(Str::markdown($post['content']),'<p><h1><h2><h3><h4><h5><h6><ul><ol><li><strong><em><del><code><pre><img><blockquote><hr><br>');  // meaning yan lang yung mga allowed html tags na pwede sa content
        // $post['content'] = Str::markdown($post['content']);
        return view('single-post',['post' => $post]);
    }
}
