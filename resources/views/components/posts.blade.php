<a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
    <img class="avatar-tiny" src="{{$post->user->getavatar()}}" />
    <strong>{{$post->title}}</strong>
    <span class="text-muted small">
        @if(!isset($hideAutherName))
        by {{$post->user->username }} 
        @endif
        on {{$post->created_at->format('n/j/Y')}}
    </span>
</a>