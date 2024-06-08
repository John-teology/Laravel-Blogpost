<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function search($term){
        $searchResults = Post::search($term)->get();
        // $searchResults->load('user:id,username,avatar');  so pwede to if gusto mo lang specify 
        $searchResults->load('user'); // so pag nag search ka ng post may kasama na yung user na nag post
        // so si "user" is yung dinefine sa model ng post na may relation sa user
        
        return $searchResults;
    }

    public function createPost(Request $request){
        return view('create-post');
     
    }

    
    public function updateForm(Post $post){
        return view('edit-post',['post' => $post]);
    }

    public function getPost(Post $post){  // $post or any variable name should be an ID of that model in this case `Post`
        $post['content'] = strip_tags(Str::markdown($post['content']),'<p><h1><h2><h3><h4><h5><h6><ul><ol><li><strong><em><del><code><pre><img><blockquote><hr><br>');  // meaning yan lang yung mga allowed html tags na pwede sa content
        // $post['content'] = Str::markdown($post['content']);
        return view('single-post',['post' => $post]);
    }



    // below are the request methods not is the get request ===================================================================================================================


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

    public function delete(Post $post){
        // if(auth()->user()->cannot('delete',$post)){
        //     return redirect("/post/$post->id")->with('error','You dont have permission to delete this post');
        // }

        // so pwede rin yang sa taas pero pwede rin naman gamitin sa policy sa route as middleware  
        $post->delete(); 
        return redirect('/profile/' . auth()->user()->username)->with('success','Post deleted successfully');

    }


    public function update(Request $request,Post $post){
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($data['title']); // striptags is used to remove html tags
        $incomingFields['content'] = strip_tags($data['content']);
        $post->update($incomingFields);
        return redirect("/post/{$post->id}")->with('success','Post updated successfully');
    }
}
