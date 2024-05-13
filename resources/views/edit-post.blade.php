<x-layout>

    <div class="container py-md-5 container--narrow">
        <p><small><strong><a href="/post/{{$post->id}}">&laquo; back</a></strong></small></p>
      <form action="/edit/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input  name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" value="{{old('title',$post->title)}}" />
          @error('title') 
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
          <textarea  name="content" id="post-content" class="body-content tall-textarea form-control" type="text" >{{old('content',$post->content)}}</textarea>
          @error('content') 
          {{-- body is yung name ng textarea/ --}}
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <button class="btn btn-primary">Update Post</button>
      </form>
    </div>

</x-layout>
