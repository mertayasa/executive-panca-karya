<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <!-- <a href="index.html">PANCA KARYA MANUNGGAL</a> -->
         <img class="img-fluid" src="{{asset('images/logo-panca.jpeg')}}" alt="Responsive image" width="200" height="200">
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">PKM</a>
      </div>
      <ul class="sidebar-menu">
          <li class="{{Request::is('*dashboard*') ? 'active' : ''}}"> <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
          
          @if (getRoleName() == 'pimpinan')
            <li class="{{Request::is('*staff*') ? 'active' : ''}}"><a class="nav-link" href="{{route('staff.index')}}"><i class="fas fa-user"></i> <span>Staff</span></a></li>
          @endif
          
          <li class="{{Request::is('*customer*') ? 'active' : ''}}"><a class="nav-link" href="{{route('customer.index')}}"><i class="fas fa-portrait"></i> <span>Pelanggan</span></a></li>
          
          <li class="nav-item dropdown {{Request::is('*income*') && !Request::is('*report*') ? 'active' : ''}}">
            <a  class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-sign-in-alt"></i><span>Pendapatan</span></a>
            <ul class="dropdown-menu">
              <li class="nav-item {{Request::is('*income-type*') ? 'active' : ''}}"><a href="{{route('income_type.index')}}">Jenis Pendapatan</a></li>
              <li class="nav-item {{Request::is('*income*') && !Request::is('*income-type*') && !Request::is('*report*') ? 'active' : ''}}"><a href="{{route('income.index')}}">Data Pendapatan</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown {{Request::is('*expenditure*') && !Request::is('*report*') ? 'active' : ''}}">
            <a  class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-sign-out-alt"></i></i><span>Pengeluaran</span></a>
            <ul class="dropdown-menu">
              <li class="nav-item {{Request::is('*expenditure-type*') ? 'active' : ''}}"><a href="{{route('expenditure_type.index')}}">Jenis Pengeluaran</a></li>
              <li class="nav-item {{Request::is('*expenditure*') && !Request::is('*expenditure-type*') && !Request::is('*report*') ? 'active' : ''}}"><a href="{{route('expenditure.index')}}">Data Pengeluaran</a></li>
            </ul>
          </li>

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
