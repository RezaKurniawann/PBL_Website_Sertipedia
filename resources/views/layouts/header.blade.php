<nav class="main-header navbar navbar-expand navbar-white navbar-light custom-header">
  <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link text-white">Home</a>
        </li>
    </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <!-- Display user name -->    
      <li class="nav-item d-flex align-items-center">
        <a class="nav-link d-flex align-items-center text-white" href="profile" role="button">
            @if(Auth::user()->image && file_exists(public_path('storage/photos/' . Auth::user()->avatar)))
                <img src="{{ asset('storage/photos/' . Auth::user()->avatar) }}" class="rounded-circle" style="width: 30px; height: 30px; margin-right: 5px;" alt="User Avatar">
            @else
                <img src="{{ asset('storage/element/default-profile.jpg') }}" class="rounded-circle" style="width: 30px; height: 30px; margin-right: 10px;" alt="Default User Avatar">
            @endif
            <span class="user-name">{{ Auth::user()->nama }}</span> | <span class="user-level">{{ Auth::user()->level->nama }}</span>
        </a>
     </li>

     <li class="nav-item">
        <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
  </ul>
</nav>

<style>
    .custom-header {
        background-color: #0B2F9F !important; /* Header background color */
        color: #fff !important; /* Text color */
    }

    .custom-header .nav-link {
        color: #fff !important; /* Text color for nav links */
    }

    .custom-header .nav-link:hover {
        color: #fff !important; /* Keep the text white */
        background-color: #08297F !important; /* Darker blue for hover background */
        border-radius: 5px; /* Optional: rounded hover effect */
    }

    .custom-header .user-name,
    .custom-header .user-level {
        color: #fff !important; /* Text color for user name and level */
    }

    .custom-header img {
        border: 2px solid #fff; /* Optional: white border around profile picture */
    }
</style>