<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <!-- <a href="index.html">PANCA KARYA MANUNGGAL</a> -->
         <img class="mb-2" src="{{asset('images/logo-panca.jpeg')}}" alt="Responsive image" width="160" height="160" style="object-fit: contain;">
         <p class="text-center mb-0">Hi, {{Auth::user()->name}}</p>
         <p class="text-center mb-0">Login sebagai <b> {{ucfirst(getRoleName())}} </b></p>
        </div>
        <hr>
     
      <ul class="sidebar-menu mt-3">
          <li class="{{Request::is('*dashboard*') ? 'active' : ''}}"> <a href="{{route('dashboard.index')}}" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
          
          @if (getRoleName() == 'pimpinan')
            <li class="{{Request::is('*staff*') ? 'active' : ''}}"><a class="nav-link" href="{{route('staff.index')}}"><i class="fas fa-user"></i> <span>Staff</span></a></li>
          @endif
          
          <li class="{{Request::is('*customer*') ? 'active' : ''}}"><a class="nav-link" href="{{route('customer.index')}}"><i class="fas fa-portrait"></i> <span>Pelanggan</span></a></li>
          <li class="{{Request::is('*income*') && !Request::is('*income-type*') && !Request::is('*report*') && !Request::is('*receivable*') ? 'active' : ''}}"><a href="{{route('income.index')}}"><i class="fas fa-wallet"></i> <span> Pendapatan </span> </a></li>
          <li class="{{Request::is('*receivable*') ? 'active' : ''}}"><a href="{{route('receivable.index')}}"><i class="fas fa-receipt"></i> <span> Piutang </span> </a></li>

          <li class="{{Request::is('*expenditure*') && !Request::is('*expenditure-type*') && !Request::is('*report*') ? 'active' : ''}}"><a href="{{route('expenditure.index')}}"><i class="fas fa-file-alt"></i> <span> Pengeluaran </span> </a></li>
          
          <li class="menu-header">Data Master</li>
          <li class="{{Request::is('*income-type*') ? 'active' : ''}}"><a href="{{route('income_type.index')}}"><i class="fas fa-dot-circle"></i> <span> Jenis Pendapatan </span> </a></li>
          <li class="{{Request::is('*expenditure-type*') ? 'active' : ''}}"><a href="{{route('expenditure_type.index')}}"><i class="fas fa-dot-circle"></i> <span> Jenis Pengeluaran </span> </a></li>

          {{-- <li class="nav-item dropdown {{Request::is('*expenditure*') && !Request::is('*report*') ? 'active' : ''}}">
            <a  class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-sign-out-alt"></i></i><span>Pengeluaran</span></a>
            <ul class="dropdown-menu">
              <li class="nav-item {{Request::is('*expenditure-type*') ? 'active' : ''}}"><a href="{{route('expenditure_type.index')}}">Jenis Pengeluaran</a></li>
              <li class="nav-item {{Request::is('*expenditure*') && !Request::is('*expenditure-type*') && !Request::is('*report*') ? 'active' : ''}}"><a href="{{route('expenditure.index')}}">Data Pengeluaran</a></li>
            </ul>
          </li> --}}

          {{-- <li class="nav-item dropdown {{Request::is('*income*') && !Request::is('*report*') && !Request::is('*income-type*') ? 'active' : ''}}"> --}}
            {{-- <a  class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-sign-in-alt"></i><span>Pendapatan</span></a>
            <ul class="dropdown-menu"> --}}
              {{-- <li class="nav-item {{Request::is('*income*') && !Request::is('*income-type*') && !Request::is('*report*') ? 'active' : ''}}"><a href="{{route('income.index')}}">Data Pendapatan</a></li> --}}
              {{-- </ul> --}}
            {{-- </li> --}}

           {{-- <li class="nav-item dropdown {{Request::is('*report*') ? 'active' : ''}}">
            <a  class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-folder-open"></i><span>Laporan</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-item {{Request::is('*income-report*') ? 'active' : ''}}" href="{{route('income_report.index')}}">Pendapatan</a></li>
              <li><a class="nav-item {{Request::is('*expenditure-report*') ? 'active' : ''}}" href="{{route('expenditure_report.index')}}">Pengeluaran</a></li>
            </ul>
          </li> --}}
        </ul>
    </aside>
  </div>
