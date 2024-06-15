<x-profile :sharedData="$sharedData" title="{{auth()->user()->username}}'s Following" >

  @include('profile-following-only')
  
  </x-profile>