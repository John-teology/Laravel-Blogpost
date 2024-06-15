<x-profile :sharedData="$sharedData" title="{{auth()->user()->username}}'s Followers" >

    @include('profile-followers-only')
    
  </x-profile>