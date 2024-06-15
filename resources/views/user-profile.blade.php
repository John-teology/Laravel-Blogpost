<x-profile :sharedData="$sharedData" title="{{auth()->user()->username}}'s Profile" >
    @include('profile-post-only')
    {{$posts->links()}}

</x-profile>