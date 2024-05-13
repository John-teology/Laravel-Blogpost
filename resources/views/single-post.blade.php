<x-layout>
    <div class="container py-md-5 container--narrow">
      <div class="d-flex justify-content-between">
        <h2>{{$post->title}}</h2>
          <span class="pt-2">
            <a href="/edit/{{$post->id}}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
            <form class="delete-post-form d-inline" action="/post/{{$post->id}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
            </form>
          </span>
      </div>

      <p class="text-muted small mb-4">
        <a href="/profile/{{$post->user->username}}"><img class="avatar-tiny" src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
        Posted by <a href="#">{{$post->user->username}}</a> on {{$post->created_at->format('n/j/Y')}}
      {{-- remember `user` is from the Post.php under model directory --}}
      </p>

      <div class="body-content">
        
        {{-- <p>{{$post->content}}</p> --}}
        <p>{!! $post->content !!}</p>  
          {{-- !! means telling laravel that we dont need proctection and let it use html tag to render values --}}
      </div>
    </div>

  </x-layout>
