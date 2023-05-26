  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.sica.home.index') }}" class="brand-link">
      <img src="{{ asset('sica/images/logo.png') }}" alt="SICA Logo" class="brand-image " style="opacity: .8">
      <span class="brand-text h3">SICA</span>
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
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block" ><i class="fas fa-sign-in-alt"></i></a>
          </div>
        @else
          <div class="col info info-user">
            <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
            <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
          </div>
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
          </form>
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
<!-- MENU PARA HOME (DE ACCESO GENERAL) -->
          @if (Route::is('*home.*'))
            <li class="nav-item">
              <a href="{{ route('cefa.sica.home.index') }}" class="nav-link {{ ! Route::is('cefa.sica.home.index') ?: 'active' }}" >
                <i class="fas fa-home"></i>
                <p> {{ trans('sica::menu.Home') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.sica.home.contact') }}" class="nav-link {{ ! Route::is('cefa.sica.home.contact') ?: 'active' }}">
                <i class="fas fa-envelope-open-text"></i>
                <p>
                  {{ trans('sica::menu.Contact') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.sica.home.developers') }}" class="nav-link {{ ! Route::is('cefa.sica.home.developers') ?: 'active' }}">
                <i class="fas fa-industry"></i>
                <p>
                  {{ trans('sica::menu.Developers') }}
                </p>
              </a>
            </li>
          @endif

<!-- CIERRA MENU PARA HOME (DE ACCESO GENERAL) -->
<!-- MENU PARA ADMINISTRADOR -->
          @if (Route::is('*admin.*'))
            <li class="nav-item">
              <a href="{{ route('sica.admin.dashboard') }}" class="nav-link {{ ! Route::is('sica.admin.dashboard') ?: 'active' }}" >
                <i class="fas fa-tachometer-alt"></i>
                <p> {{ trans('sica::menu.Dashboard') }}</p>
              </a>
            </li>
    <!-- MENU PARA PEOPLE -->
           <li class="nav-item {{ ! Route::is('sica.admin.people.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.admin.people.*') ?: 'active' }}">
                <i class="fas fa-users"></i>
                <p>
                  {{ trans('sica::menu.People') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.admin.people.config'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.config') }}" class="nav-link {{ ! Route::is('sica.admin.people.config*') ?: 'active' }}">
                    <i class="fas fa-cogs"></i>
                    <p>{{ trans('sica::menu.Config') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.people.personal_data'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.personal_data') }}" class="nav-link {{ ! Route::is('sica.admin.people.personal_data*') ?: 'active' }}">
                    <i class="fas fa-id-card"></i>
                    <p>{{ trans('sica::menu.Personal data') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.people.apprentices'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.apprentices') }}" class="nav-link {{ ! Route::is('sica.admin.people.apprentices*') ?: 'active' }}">
                    <i class="fas fa-user-graduate"></i>
                    <p>{{ trans('sica::menu.Apprentices') }}</p>
                  </a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.instructors') }}" class="nav-link {{ ! Route::is('sica.admin.people.instructors*') ?: 'active' }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>{{ trans('sica::menu.Instructors') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.officers') }}" class="nav-link {{ ! Route::is('sica.admin.people.officers*') ?: 'active' }}">
                    <i class="fas fa-id-card"></i>
                    <p>{{ trans('sica::menu.Officers') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.contractors') }}" class="nav-link {{ ! Route::is('sica.admin.people.contractors*') ?: 'active' }}">
                    <i class="fa-solid fa-id-card-clip"></i>
                    <p>{{ trans('sica::menu.Contractors') }}</p>
                  </a>
                </li>
                @if(Auth::user()->havePermission('sica.admin.people.events_attendance'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.people.events_attendance') }}" class="nav-link {{ ! Route::is('sica.admin.people.events_attendance*') ?: 'active' }}">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <p>{{ trans('sica::menu.Events attendance') }}</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
    <!-- CIERRA MENU PARA PEOPLE -->
    <!-- MENU PARA ACADEMY -->
            <li class="nav-item {{ ! Route::is('sica.admin.academy.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.admin.academy.*') ?: 'active' }}">
                <i class="fas fa-school"></i>
                <p>
                  {{ trans('sica::menu.Academy') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.admin.academy.quarters'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.academy.quarters') }}" class="nav-link {{ ! Route::is('sica.admin.academy.quarters*') ?: 'active' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <p>{{ trans('sica::menu.Quarters') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.academy.programs'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.academy.programs') }}" class="nav-link {{ ! Route::is('sica.admin.academy.programs*') ?: 'active' }}">
                    <i class="fas fa-book"></i>
                    <p>{{ trans('sica::menu.Programs') }}</p>
                  </a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="{{ route('sica.admin.academy.courses') }}" class="nav-link {{ ! Route::is('sica.admin.academy.courses*') ?: 'active' }}">
                    <i class="fas fa-graduation-cap"></i>
                    <p>{{ trans('sica::menu.Courses') }}</p>
                  </a>
                </li>

              </ul>
            </li>
    <!-- CIERRA MENU PARA ACADEMY -->
    <!-- MENU PARA LOCATION -->
            <li class="nav-item {{ ! Route::is('sica.admin.location.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.admin.location.*') ?: 'active' }}">
                <i class="fas fa-atlas"></i>
                <p>
                  {{ trans('sica::menu.Location') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.admin.location.countries'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.location.countries') }}" class="nav-link {{ ! Route::is('sica.admin.location.countries*') ?: 'active' }}">
                    <i class="fas fa-globe-americas"></i></i>
                    <p>{{ trans('sica::menu.Countries') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.location.farms'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.location.farms') }}" class="nav-link {{ ! Route::is('sica.admin.location.farms*') ?: 'active' }}">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>{{ trans('sica::menu.Farms') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.location.environments'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.location.environments') }}" class="nav-link {{ ! Route::is('sica.admin.location.environments*') ?: 'active' }}">
                    <i class="fa-solid fa-people-roof"></i>
                    <p>{{ trans('sica::menu.Environments') }}</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
    <!-- CIERRA MENU PARA LOCATION -->
    <!-- MENU PARA INVENTORY -->
            <li class="nav-item {{ ! Route::is('sica.admin.inventory.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.admin.inventory.*') ?: 'active' }}">
                <i class="fa-solid fa-boxes-stacked"></i>
                <p>
                  {{ trans('sica::menu.Inventory') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.admin.inventory.warehouses'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.inventory.warehouses') }}" class="nav-link {{ ! Route::is('sica.admin.inventory.warehouses*') ?: 'active' }}">
                    <i class="fas fa-warehouse"></i>
                    <p>{{ trans('sica::menu.Warehouses') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.inventory.parameters.index'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.inventory.parameters.index') }}" class="nav-link {{ ! Route::is('sica.admin.inventory.parameters.index*') ?: 'active' }}">
                    <i class="fas fa-stream"></i>
                    <p>{{ trans('sica::menu.Parameters') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.inventory.elements'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.inventory.elements') }}" class="nav-link {{ ! Route::is('sica.admin.inventory.elements*') ?: 'active' }}">
                    <i class="fas fa-shapes"></i>
                    <p>{{ trans('sica::menu.Elements') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.inventory.transactions'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.inventory.transactions') }}" class="nav-link {{ ! Route::is('sica.admin.inventory.transactions*') ?: 'active' }}">
                    <i class="fas fa-dolly-flatbed"></i>
                    <p>{{ trans('sica::menu.Transactions') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.inventory.inventory'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.inventory.inventory') }}" class="nav-link {{ ! Route::is('sica.admin.inventory.inventory*') ?: 'active' }}">
                    <i class="fas fa-clipboard-list"></i>
                    <p>{{ trans('sica::menu.Inventory') }}</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
    <!-- CIERRA MENU PARA INVENTORY -->
    <!-- MENU PARA UNITS -->
            <li class="nav-item {{ ! Route::is('sica.admin.units.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.admin.units.*') ?: 'active' }}">
                <i class="fas fa-network-wired"></i>
                <p>
                  {{ trans('sica::menu.Units') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.admin.units.areas'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.units.areas') }}" class="nav-link {{ ! Route::is('sica.admin.units.areas*') ?: 'active' }}">
                    <i class="fas fa-sign"></i>
                    <p>{{ trans('sica::menu.Areas') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.units.consumption'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.units.consumption') }}" class="nav-link {{ ! Route::is('sica.admin.units.consumption*') ?: 'active' }}">
                    <i class="fas fa-folder-minus"></i>
                    <p>{{ trans('sica::menu.Consumption') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.units.production'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.units.production') }}" class="nav-link {{ ! Route::is('sica.admin.units.production*') ?: 'active' }}">
                    <i class="fas fa-folder-plus"></i>
                    <p>{{ trans('sica::menu.Production') }}</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
    <!-- CIERRA MENU PARA UNITS -->
    <!-- MENU PARA SECURITY -->
            <li class="nav-item {{ ! Route::is('sica.admin.security.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.admin.security.*') ?: 'active' }}">
                <i class="fas fa-shield-alt"></i>
                <p>
                  {{ trans('sica::menu.Security') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.admin.security.apps'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.security.apps') }}" class="nav-link {{ ! Route::is('sica.admin.security.apps*') ?: 'active' }}">
                    <i class="fas fa-th"></i>
                    <p>{{ trans('sica::menu.Apps') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.security.roles'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.security.roles') }}" class="nav-link {{ ! Route::is('sica.admin.security.roles*') ?: 'active' }}">
                    <i class="fas fa-user-tag"></i>
                    <p>{{ trans('sica::menu.Roles') }}</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('sica.admin.security.users'))
                <li class="nav-item">
                  <a href="{{ route('sica.admin.security.users') }}" class="nav-link {{ ! Route::is('sica.admin.security.users*') ?: 'active' }}">
                    <i class="fas fa-user-shield"></i>
                    <p>{{ trans('sica::menu.Users') }}</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
    <!-- CIERRA MENU PARA SECURITY -->
          @endif
<!-- CIERRA MENU PARA ADMINISTRADOR -->
<!-- MENU PARA ATTENDANCE -->
          @if (Route::is('*attendance.*'))
            <li class="nav-item">
              <a href="{{ route('sica.attendance.dashboard') }}" class="nav-link {{ ! Route::is('sica.attendance.dashboard') ?: 'active' }}" >
                <i class="fas fa-tachometer-alt"></i>
                <p> {{ trans('sica::menu.Dashboard') }}</p>
              </a>
            </li>
    <!-- MENU PARA PEOPLE -->
           <li class="nav-item {{ ! Route::is('sica.attendance.people.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('sica.attendance.people.*') ?: 'active' }}">
                <i class="fas fa-users"></i>
                <p>
                  {{ trans('sica::menu.People') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('sica.attendance.people.events_attendance'))
                <li class="nav-item">
                  <a href="{{ route('sica.attendance.people.events_attendance') }}" class="nav-link {{ ! Route::is('sica.attendance.people.events_attendance*') ?: 'active' }}">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <p>{{ trans('sica::menu.Events attendance') }}</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
    <!-- CIERRA MENU PARA PEOPLE -->
          @endif
<!-- CIERRA MENU PARA ATTENDANCE -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
