<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
     <h1 class=" justify-content-center text-white mb-0">CV Panca Karya Manunggal</h1>
  </form>
  <ul class="navbar-nav navbar-right">
   
    {{-- <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> --}}
      {{-- <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
      {{-- <div class="d-sm-none d-lg-inline-block text-yellow">{{Auth::user()->name}}</div></a> --}}
      {{-- <div class="dropdown-menu dropdown-menu-right"> --}}
        {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
        {{-- <a href="{{route('profile.edit')}}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <a href="features-activities.html" class="dropdown-item has-icon">
          <i class="fas fa-bolt"></i> Activities
        </a>
        <a href="features-settings.html" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> Settings
        </a> --}}
        {{-- <div class="dropdown-divider"></div> --}}
        {{-- <a href="{{route('profile.edit')}}" class="dropdown-item has-icon text-white">
          Profile
        </a> --}}
        <a class="dropdown-item has-icon text-white" href="{{ route('profile.edit', Auth::id()) }}">Profil</a>
        <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             Keluar
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      {{-- </div> --}}
    </li>
  </ul>
</nav>
