<x-profile :sharedData="$sharedData" title="{{auth()->user()->username}}'s Profile" >
  
  <div class="list-group">
      @forEach($posts as $post)
        <x-posts :post="$post" hideAutherName="{{true}}" />
      @endforEach
      {{$posts->links()}}
  </div>

</x-profile>