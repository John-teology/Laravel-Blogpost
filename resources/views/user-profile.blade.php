<x-layout>


    <div class="container py-md-5 container--narrow">
        <h2>
          <img class="avatar-small" src="{{$user->getavatar()}}" /> {{$user->username}}
          <form class="ml-2 d-inline" action="#" method="POST">
            <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
            @if(auth()->user()->username == $user->username)
                <a href="/profile/{{auth()->user()->username}}/edit" class="btn btn-primary btn-sm">Edit Profile <i class="fas fa-user-edit"></i></a>
            <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
            @endif
          </form>
        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
          <a href="#" class="profile-nav-link nav-item nav-link active">Posts: {{$posts->count()}}</a>
          <a href="#" class="profile-nav-link nav-item nav-link">Followers: 3</a>
          <a href="#" class="profile-nav-link nav-item nav-link">Following: 2</a>
        </div>
  
        <div class="list-group">
            @forEach($posts as $post)
                <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
                    <img class="avatar-tiny" src="{{$post->user->getavatar()}}" />
                    <strong>{{$post->title}}</strong> on {{$post->created_at->format('n/j/Y')}}
                </a>
            @endforEach
        </div>
      </div>
</x-layout>