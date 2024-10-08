<x-layout title="Your Feed">
    <div class="container py-md-5">
      <div class="row align-items-center">
        @auth
          @if($posts->isEmpty())  
              <div class="container py-md-5 container--narrow">
                <div class="text-center">
                  <h2>Hello <strong>{{auth()->user()->username}}</strong>, your feed is empty.</h2>
                  <p class="lead text-muted">Your feed displays the latest posts from the people you follow. If you don&rsquo;t have any friends to follow that&rsquo;s okay; you can use the &ldquo;Search&rdquo; feature in the top menu bar to find content written by people with similar interests and then follow them.</p>
                </div>
              </div> 
          @else
              <div class="container py-md-5 container--narrow">
                <h2 class="text-center mb-4">The Latest From Those You Follow</h2>
                <div class="list-group">
                  @foreach($posts as $post)
                    <x-posts :post="$post" />
                  @endforEach
                </div>
                  <div class="mt-4" style="float: right;">
                  {{$posts->links()}}
                  </div>
              </div>

          @endif

        @else
          <div class="col-lg-7 py-3 py-md-5">
            <h1 class="display-3">Remember Writing?</h1>
            <p class="lead text-muted">Are you sick of short tweets and impersonal &ldquo;shared&rdquo; posts that are reminiscent of the late 90&rsquo;s email forwards? We believe getting back to actually writing is the key to enjoying the internet again. Total Post: {{$totalPost}}</p>
          </div>
          <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            <form action="/register" method="POST" id="registration-form">
              @csrf
              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>Username</small></label>
                <input name="username" value="{{old('username')}}" id="username-register" class="form-control" type="text" placeholder="Pick a username" autocomplete="off" />
                @error('username') {{-- error message for username validation| username is yung asa validate --}}
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                <input name="email"  id="email-register" value="{{old('email')}}" class="form-control" type="text" placeholder="you@example.com" autocomplete="off" />
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>Password</small></label>
                <input name="password" id="password-register" class="form-control" type="password" placeholder="Create a password" />
                @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="password-register-confirm" class="text-muted mb-1"><small>Confirm Password</small></label>
                <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Confirm password" />
              {{-- required yung _confirmation for password--}}
              @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>

              <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Sign up for OurApp</button>
            </form>
          </div>
        @endauth
        
      </div>
    </div>


</x-layout>
