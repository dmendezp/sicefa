  <nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*cefa.*') ?: 'active' }}">
        <a href="{{ route('cefa.cefamaps.index')}}" class="nav-link">{{ trans('cefamaps::menu.Home') }}</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*sst.*') ?: 'active'}}">
        <a href="{{ route('cefamaps.sst.index')}}" class="nav-link">{{ trans('cefamaps::SST.Home') }}</a>
      </li>
      @guest
      @else
        <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*admin.*') ?: 'active' }}">
          <a href="{{ route('cefamaps.admin.dashboard') }}" class="nav-link">{{ trans('cefamaps::menu.Administrator') }}</a>
        </li>
      @endguest
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          @if(session('lang')!='en')
            <img src="{{ asset('general/images/colombia_r.svg') }}" class="icon-bar" alt="User Image" style="width: 20px; height: 20px;">
          @else
            <img src="{{ asset('general/images/estados-unidos-de-america_r.svg') }}" class="icon-bar" alt="User Image" style="width: 20px; height: 20px;">
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
            <img src="{{ asset('general/images/estados-unidos-de-america_r.svg') }}" class="icon-bar" alt="User Image" style="width: 20px; height: 20px;"> English
          </a>
          <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
            <img src="{{ asset('general/images/colombia_r.svg') }}" class="icon-bar" alt="User Image" style="width: 20px; height: 20px;"> Español
          </a>
        </div>
      </li>
    </ul>
  </nav>