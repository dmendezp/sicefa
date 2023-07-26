<nav class="main-header navbar navbar-expand navbar-dark navbar-success ">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*cefa.*') ?: 'active' }}">
      <a href="{{ route('cefa.ganaderia.home.index') }}" class="nav-link">Inicio</a>
      @guest
        @else
        @if(Auth::user()->roles[0]->slug=='ganaderia.admin.vet')
          <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*vet.*') ?: 'active'}}">
            <a href="{{ route('ganaderia.admin.vet.index') }}" class="nav-link">{{ trans('ganaderia::menu.Veterinario')}}</a>
          </li>
        @elseif(Auth::user()->roles[0]->slug=='ganaderia.admin.leader')
          <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*leader.*') ?: 'active'}}">
            <a href="{{ route ('ganaderia.admin.leader.index') }}" class="nav-link">{{ trans('ganaderia::menu.aprendiz_lider')}}</a>
          </li>
        @elseif(Auth::user()->roles[0]->slug=='ganaderia.admin.production')
          <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*veterinary.*') ?: 'active'}}">
            <a href="{{ route('ganaderia.admin.production.index') }}" class="nav-link">{{ trans('ganaderia::menu.produccion')}}</a>
          </li>
        @elseif(Auth::user()->roles[0]->slug=='ganaderia.admin.apprentice')
          <li class="nav-item d-none d-sm-inline-block {{ ! Route::is('*veterinary.*') ?: 'active'}}">
            <a href="{{ route('ganaderia.admin.apprentice.index') }}" class="nav-link">{{ trans('ganaderia::menu.aprendiz')}}</a>
          </li>
        @endif
      @endguest
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
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