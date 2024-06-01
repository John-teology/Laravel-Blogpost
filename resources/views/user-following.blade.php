<x-profile :sharedData="$sharedData">

  
    <div class="list-group">
        @forEach($followings as $following)
        <a href="/profile/{{$following->getfollowinguser->username}}" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{$following->getfollowinguser->getavatar()}}" />
            {{$following->getfollowinguser->username}}
        </a>
        @endforEach
    </div>
  
  </x-profile>