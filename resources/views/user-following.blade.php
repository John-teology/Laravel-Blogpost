<x-profile :sharedData="$sharedData">

  
    <div class="list-group">
        @forEach($posts as $post)
            <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{$post->user->getavatar()}}" />
                <strong>{{$post->title}}</strong> on {{$post->created_at->format('n/j/Y')}}
            </a>
        @endforEach
    </div>
  
  </x-profile>