<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">

    <!-- Brand Logo -->
    <a href="{{route('index')}}" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        
        <span class="brand-text font-weight-light">Sena Empresa</span>
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
                    <i class="nav-icon fas fa-puzzle-piece"></i>
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
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
               <li class="nav-item menu-open">
                <a href="#" class="nav-link ">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>
                        Turnos
                        <i class="right fas fa-angle-left "></i>
                    </p>
                </a>

                @guest
                    <li class="nav-item">
                        <a href="{{ route('calendarTurno.home')}}" class="nav-link {{ ! Route::is('calendarTurno.home') ?: 'active' }}">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Turnos por Calendario</p>
                        </a>
                    </li>
                    @else
      

               
                <ul class="nav nav-treeview">
                @if(Auth::user()->havePermission('senaempresa.turnosRutinarios'))
                    <li class="nav-item">
                        <a href="{{ route('turnosRutinarios')}}" class="nav-link {{ ! Route::is('turnosRutinarios') ?: 'active' }}">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>Turnos Rutinarios</p>
                        </a>
                    </li>
                  @endif
                  <li class="nav-item">
                        <a href="{{ route('calendarTurno.home')}}" class="nav-link {{ ! Route::is('calendarTurno.home') ?: 'active' }}">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Turnos por Calendario</p>
                        </a>
                    </li>
                    @if(Auth::user()->havePermission('senaempresa.fingerPrint.home'))
                    <li class="nav-item">
                        <a href="{{route('fingerPrint.home')}}" class="nav-link {{ ! Route::is('fingerPrint.home') ?: 'active' }}">
                            <i class="nav-icon far fa-id-card"></i>
                            <p>Turnos Sena Empresa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ ! Route::is('verify-users') ?: 'active' }}" href="{{ route('verify-users') }}">
                      <i class="nav-icon fas fa-fingerprint"></i>
                        <p>{{ __('Check Users') }}</p>
                      </a>
                    </li>
                    
                    @endif
                </ul>
            </li>
            @if(Auth::user()->havePermission('senaempresa.work.index'))
            <li class="nav-item">
                <a href="{{route('work.index')}}" class="nav-link {{ ! Route::is('work.index') ?: 'active' }}">
                    <i class="nav-icon fas fa-hammer"></i>
                    <p>
                        Works
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
            @endif

            @endguest
        </ul>


       
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>