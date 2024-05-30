<x-profile :sharedData="$sharedData">

  
    <div class="list-group">
        @forEach($followers as $follower)
            <a href="/profile/{{$follower->getfolloweruser->username}}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{$follower->getfolloweruser->getavatar()}}" />
                {{$follower->getfolloweruser->username}}
            </a>
        @endforEach
    </div>
  
  </x-profile>