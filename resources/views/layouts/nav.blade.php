<nav class="navbar navbar-expand navbar-dark bg-light static-top">
            
      <a class="navbar-brand mr-1 text-primary" href="{{route('home')}}">
        <marquee>
          <img src="{{ url('images/favicon-24.png') }}">
          A Tour
          </marquee>
      </a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0 text-primary" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
     
     <ul class="ml-auto"></ul>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle text-primary" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i> {{ Auth::user()->fullname }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('pengguna.setting') }}">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>
