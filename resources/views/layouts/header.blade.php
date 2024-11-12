<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href="/dashboard" class="nav-link">Home</a>
      </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <!-- Display user name -->    
      <li class="nav-item d-flex align-items-center">
        <a class="nav-link d-flex align-items-center" href="profile" role="button">
            @if(Auth::user()->image && file_exists(public_path('storage/photos/' . Auth::user()->avatar)))
                <img src="{{ asset('storage/photos/' . Auth::user()->avatar) }}" class="rounded-circle" style="width: 30px; height: 30px; margin-right: 5px;" alt="User Avatar">
            @else
                <img src="{{ asset('storage/element/default-profile.jpg') }}" class="rounded-circle" style="width: 30px; height: 30px; margin-right: 10px;" alt="Default User Avatar">
            @endif
            <span class="user-name" style="margin-right: 5px;">{{ Auth::user()->nama}}</span> | <span class="user-level" style="margin-left: 5px;">{{ Auth::user()->level->nama}}</span>
        </a>
     </li>

      <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
          </a>
      </li>
  </ul>
</nav>

<!-- Optional CSS (you can add this to your stylesheet) -->
{{-- <style>
  .navbar-nav .nav-item .user-name,
  .navbar-nav .nav-item .user-level {
      margin-right: 5px; /* Adjust spacing */
  }

  .navbar-nav .nav-item img {
      width: 30px; /* Profile picture size */
      height: 30px; /* Profile picture size */
      margin-right: 5px; /* Space between image and text */
  }
</style> --}}