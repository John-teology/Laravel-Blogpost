<x-layout>


    <div class="container py-md-5 container--narrow">
        <h2>
          <img class="avatar-small" src="{{$sharedData['user']->getavatar()}}" /> {{$sharedData['user']->username}}
          @auth
         
              @if(!$sharedData['current_follow'] AND auth()->user()->id!=$sharedData['user']->id)
                <form class="ml-2 d-inline" action="/follow/{{$sharedData['user']->username}}" method="POST">
                  @csrf
                    <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                </form>
              @endif
              @if($sharedData['current_follow'] AND auth()->user()->id!=$sharedData['user']->id)
                <form class="ml-2 d-inline" action="/unfollow/{{$sharedData['user']->username}}" method="POST">
                  @csrf
                    <button class="btn btn-danger btn-sm">Unfollow <i class="fas fa-user-times"></i></button>
                </form>
              @endif
              @if(auth()->user()->username == $sharedData['user']->username)
                  <a href="/profile/{{auth()->user()->username}}/edit" class="btn btn-primary btn-sm">Edit Profile <i class="fas fa-user-edit"></i></a>
              <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
              @endif
          @endauth

        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
          <a href="/profile/{{$sharedData['user']->username}}" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == "" ? "active" : ""}}">Posts: {{$sharedData['posts']->count()}}</a>
          <a href="/profile/{{$sharedData['user']->username}}/followers" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == "followers" ? "active" : ""}}">Followers: 3</a>
          <a href="/profile/{{$sharedData['user']->username}}/following" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == "following" ? "active" : ""}}">Following: 2</a>
        </div>

        <div class="profile-slot-content">
            {{$slot}}
        </div>
  
      </div>
</x-layout>