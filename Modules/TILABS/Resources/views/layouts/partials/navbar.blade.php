  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*cefa.tilabs.*') ?: 'active' }}">
        <a href="{{ route('cefa.tilabs.index') }}" class="nav-link">{{ trans('tilabs::menu.Home') }}</a>
      </li>
@guest
@else
      <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*admin.*') ?: 'active' }}">
        <a href="{{ route('tilabs.admin.dashboard') }}" class="nav-link">{{ trans('tilabs::menu.Administrator') }}</a>
      </li>
@endguest

  </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 {{ trans('modulo1::menu.Notifications') }}</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 {{ trans('modulo1::menu.new messages') }}
            <span class="float-right text-muted text-sm">3 {{ trans('modulo1::menu.mins') }}</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 {{ trans('modulo1::menu.new reports') }}
            <span class="float-right text-muted text-sm">2 {{ trans('modulo1::menu.days') }}</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">{{ trans('modulo1::menu.See All Notifications') }}</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- languaje Dropdown Menu-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ session('lang') }} <i class="fas fa-globe"></i>
        </a>
        <div class="dropdown-menu p-0">
          <a href="{{ url('lang',['es']) }}" class="dropdown-item">Español</a>
          <a href="{{ url('lang',['en']) }}" class="dropdown-item">English</a>
        </div> 
      </li>
    </ul>
  </nav>