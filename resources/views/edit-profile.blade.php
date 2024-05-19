<x-layout>
<div class="container container--narrow py-md-5">
    <h2 class="text-center mb-3">Upload new Avatar</h2>
    <form action="/profile/{{auth()->user()->username}}/edit" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar" >
            @error('avatar')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
</x-layout>