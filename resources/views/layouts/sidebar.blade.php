<ul class="sidebar navbar-nav bg-light">
  
        <li class="nav-item">
          <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt text-primary"></i>
            <span class="text-dark">Dashboard</span>
          </a>
        </li>
        
        @if(Auth::user()-> level == 'Admin')

        <li class="nav-item">
          <a class="nav-link" href="{{route('pengguna.data')}}">
            <i class="fas fa-fw fa-user text-primary"></i>
            <span class="text-dark">Pengguna</span>
          </a>
        </li>

         <li class="nav-item ">
          <a class="nav-link" href="{{route('transportation-type.data')}}">
            <i class="fas fa-fw fa-tags text-primary"></i>
            <span class="text-dark">Tipe Transportasi</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('transportation.data')}}">
            <i class="fas fa-fw fa-plane text-primary"></i>
            <span class="text-dark">Transportasi</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="{{route('rute.data')}}">
            <i class="fas fa-fw fa-road text-primary"></i>
            <span class="text-dark">Rute</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="{{route('report')}}">
            <i class="fas fa-fw fa-print text-primary"></i>
            <span class="text-dark">Laporan</span>
          </a>
        </li>

        @endif

        <li class="nav-item">
          <a class="nav-link" href="{{route('customer.data')}}">
            <i class="fas fa-fw fa-users text-primary"></i>
            <span class="text-dark">Pelanggan</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="{{route('reservation.data')}}">
            <i class="fas fa-fw fa-calendar-alt text-primary"></i>
            <span class="text-dark">Reservasi</span>
          </a>
        </li>
</ul>