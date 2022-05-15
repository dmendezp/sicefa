<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-cyan elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <i class="fas fa-shopping-cart"></i> &nbsp
        <span class="brand-text font-weight-light">Punto de venta</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
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
                @if (Route::is('*.ptoventa.*'))
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptoventa.index') }}"
                            class="nav-link {{ !Route::is('cefa.ptoventa.index') ?: 'active' }}">
                            <i class="fas fa-home"></i>
                            <p>
                                {{ trans('ptoventa::menu.Home') }}
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptoventa.developers') }}"
                            class="nav-link {{ !Route::is('cefa.ptoventa.developers') ?: 'active' }}">
                            <i class="fas fa-laptop-code"></i>
                            <p>
                                {{ trans('ptoventa::menu.Developers') }}
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('ptoventa.admin.dashboard') }}"
                            class="nav-link {{ !Route::is('ptoventa.admin.dashboard') ?: 'active' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                {{ trans('ptoventa::menu.Dashboard') }}
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ptoventa.admin.sales') }}"
                            class="nav-link {{ !Route::is('ptoventa.admin.sales') ?: 'active' }}">
                            <i class="fas fa-cash-register"></i>
                            <p>
                                {{ trans('ptoventa::menu.Sales') }}
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('ptoventa.admin.inventory') }}"
                            class="nav-link {{ !Route::is('ptoventa.admin.inventory') ?: 'active' }}">
                            <i class="fas fa-boxes"></i>
                            <p>
                                {{ trans('ptoventa::menu.Inventory') }}
                            </p>
                        </a>
                    </li> --}}
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
