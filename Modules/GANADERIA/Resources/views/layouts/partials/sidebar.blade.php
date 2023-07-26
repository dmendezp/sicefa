<aside class="main-sidebar sidebar-dark-success elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('cefa.ganaderia.home.index') }}" class="brand-link">
    <img src="{{ asset('bovinos/images/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image elevation-3"  style="opacity: .8">
    <span class="brand-text h3">GANADERIA</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
      <div class="row col-md-12">
        <div class="image mt-2 mb-2">
          @if(isset(Auth::user()->person->avatar))
            <img src="{{ asset('storage/'.Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        @guest
          <div class="col info info-user">
            <div>{{ trans('menu.Welcome') }}</div>             
            <div><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
          </div>
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}">
            <a href="{{ route('login') }}" class="d-block" >
              <i class="fas fa-sign-in-alt"></i>
            </a>
          </div>  
        @else
          <div class="col info info-user">
            <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
            <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
          </div>
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}">
            <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        @endguest
      </div>
    </div>
    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
      <nav class="">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item">
            <a href="{{ route('cefa.welcome') }}" class="nav-link {{ ! Route::is('cefa.contact.maps') ?: 'active' }}">
              <i class="fas fa-puzzle-piece"></i>
              <p>
                {{ trans('sica::menu.Back to') }} {{ env('APP_NAME') }}
              </p>
            </a>
          </li>  
        </ul>
      </nav>      
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <!-- MENU PARA HOME (DE ACCESO GENERAL) -->
        <li class="nav-item">
          <a href="{{ route('cefa.ganaderia.home.index') }}" class="nav-link {{ ! Route::is('cefa.ganaderia.home.index') ?: 'active' }}" >
            <i class="fas fa-home"></i>
            <p>Inicio</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cefa.ganaderia.home.property') }}" class="nav-link {{ ! Route::is('cefa.ganaderia.home.property') ?: 'active' }}">
            <i class="fas fa-mountain"></i>
            <p>Predios</p>
          </a>
        </li>
        <!-- CIERRA MENU PARA HOME (DE ACCESO GENERAL) -->
        <!-- MENU PARA VETERINARIO -->
        @if (Route::is('*admin.*'))
          <li class="nav-item">
            <a href="{{ route('ganaderia.admin.dashboard') }}" class="nav-link {{ ! Route::is('ganaderia.admin.dashboard') ?: 'active' }}" >
              <i class="fas fa-tachometer-alt"></i>
              <p> Panel de Control</p>
            </a>
          </li>
          <!-- MENU PARA  REPRODUCTION -->
          <li class="nav-item {{ ! Route::is('ganaderia.admin.reproduction.*') ?: 'menu-is-opening menu-open' }}">
            <a href="#" class="nav-link {{ ! Route::is('ganaderia.admin.reproduction.*') ?: 'active' }}">
              <i class="fas fa-dna"></i>
              <p>
                Reproducciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ganaderia.admin.reproduction.animalrecord') }}" class="nav-link {{ ! Route::is('ganaderia.admin.reproduction.animalrecord*') ?: 'active' }}">
                  <i class="fas fa-paste"></i>
                  <p>Reproduccion</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- MENU PARA REGISTRO DE ACTIVIDAD -->
          <li class="nav-item {{ ! Route::is('ganaderia.admin.activity.*') ?: 'menu-is-opening menu-open' }}">
            <a href="#" class="nav-link {{ ! Route::is('ganaderia.admin.activity.*') ?: 'active' }}">
              <i class="fas fa-pen-square"></i>
              <p>
                Registro de Actividades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ganaderia.admin.activity.productive_unit') }}" class="nav-link {{ ! Route::is('ganaderia.admin.activity.productive_unit*') ?: 'active' }}">
                  <i class="fas fa-school"></i>
                  <p>Unidad Productiva</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ganaderia.admin.activity.movement') }}" class="nav-link {{ ! Route::is('ganaderia.admin.activity.movement*') ?: 'active' }}">
                  <i class="fas fa-paste"></i>
                  <p>Movimientos </p>
                </a>
              </li>
            </ul>
            <!-- MENU PARA REGISTROS -->
            <li class="nav-item {{ ! Route::is('ganaderia.admin.cattle.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('ganaderia.admin.cattle.*') ?: 'active' }}">
                <i class="fas fa-pencil-alt"></i>
                <p>
                  Registro 
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('ganaderia.admin.cattle.register_cattle') }}" class="nav-link {{ ! Route::is('ganaderia.admin.cattle.register_cattle*') ?: 'active' }}">
                    <p>Registrar Ganado</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('ganaderia.admin.activity.movement') }}" class="nav-link {{ ! Route::is('ganaderia.admin.activity.movement*') ?: 'active' }}">
                    <p>Registro Clinico </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('ganaderia.admin.cattle.reproduction') }}" class="nav-link {{ ! Route::is('ganaderia.admin.cattle.reproductiont*') ?: 'active' }}">
                    <p>Reproduccion </p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- CIERRA MENU PARA VETERINARIO -->
            <!-- Inicio del menu para los filtros -->
            <li class="nav-item {{ ! Route::is('ganaderia.admin.filter.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('ganaderia.admin.filter.*') ?: 'active' }}">
                <i class="fas fa-filter"></i>
                <p>
                  {{ trans('ganaderia::menu.Filter') }} 
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('ganaderia.admin.filter.animals') }}" class="nav-link {{ ! Route::is('ganaderia.admin.filter.animals') ?: 'active' }}">
                    <i class="fas fa-hat-cowboy"></i>
                    <p>{{ trans('ganaderia::menu.animals') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link {{ ! Route::is('*') ?: 'active' }}">
                    <p>{{ trans('ganaderia::menu.productive_proces') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Fin del menu para los filtros -->
          </li>
        @endif
        <!-- Inicio para el modo Aprendiz Lider -->
        @if (Route::is('*leader.*'))
        <li class="nav-item {{ ! Route::is('ganaderia.admin.leader.*') ?: 'menu-is-opening menu-open' }}">
          <a href="#" class="nav-link {{ ! Route::is('ganaderia.admin.leader.*') ?: 'active' }}">
            <i class="nav-icon fa-solid fa-cow"></i>
            <p>
              {{ trans('ganaderia::leader.Animal') }}
              <i class="right fa-solid fa-paw"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('ganaderia.admin.leader.register.index') }}" class="nav-link {{ ! Route::is('ganaderia.admin.leader.register.*') ?: 'active' }}">
                <i class="nav-icon fas fa-solid fa-clipboard-list"></i>
                <p>{{ trans('ganaderia::leader.Register') }}</p>
              </a>
            </li>
            <!-- inicio para consultar la vaca por codigo -->
            <li class="nav-item">
              <a href="{{ route('ganaderia.admin.leader.search') }}" class="nav-link {{ ! Route::is('ganaderia.admin.leader.search') ?: 'active' }}">
                <i class="nav-icon fas fa-solid fa-magnifying-glass"></i>
                <p>{{ trans('ganaderia::leader.Consultar') }}</p>
              </a>
            </li>
            <!-- fin para consultar la vaca por codigo -->
            <!-- inicio para consultar el historial clinico de la vaca por el codigo -->
            <li class="nav-item">
              <a href="#" class="nav-link {{ ! Route::is('#') ?: 'active' }}">
                <i class="nav-icon fas fa-solid fa-file-waveform"></i>
                <p>{{ trans('ganaderia::leader.Historial clinico') }}</p>
              </a>
            </li>
            <!-- fin para consultar el historial clinico de la vaca por el codigo -->
            <!-- inicio para poder registrar una nueva raza -->
            <li class="nav-item">
              <a href="{{ route('ganaderia.admin.leader.race.index') }}" class="nav-link {{ ! Route::is('ganaderia.admin.leader.race.*') ?: 'active' }}">
              <i class="nav-icon fas fa-solid fa-dna"></i>
              <p>{{ trans('ganaderia::leader.Race') }}</p>
              </a>
            </li>
            <!-- fin para poder registrar una nueva raza -->
          </ul>
        </li>
        @endif
        <!-- Fin para el modo Aprendiz Lider -->
        @if (Route::is('*vet.*'))
        <!-- Inicio para el modo del Veterinario -->
        <li class="nav-item {{ ! Route::is('ganaderia.admin.vet.*') ?: 'menu-is-opening menu-open' }}">
          <a href="#" class="nav-link {{ ! Route::is('ganaderia.admin.vet.*') ?: 'active' }}">
            <i class="nav-icon fa-solid fa-hospital"></i>
            <p>
              {{ trans('ganaderia::vet.Clinico') }}
              <i class="right fa-solid fa-heart"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('ganaderia.admin.vet.register') }}" class="nav-link {{ ! Route::is('ganaderia.admin.vet.register*') ?: 'active' }}">
                <i class="nav-icon fas fa-solid fa-clipboard-list"></i>
                <p>{{ trans('ganaderia::vet.Registro') }}</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Fin para el modo del Veterinario -->
        @endif
      </ul>
    </nav>
  </div>
</aside>