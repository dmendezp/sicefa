  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.tilabs.index') }}" class="brand-link ico-brand">
        <i class="fas fa-laptop-house"></i> &nbsp
        <span class="brand-text h4">TI-LABS</span>
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
          <li class="nav-item">
            <a href="{{ route('cefa.tilabs.index') }}" class="nav-link {{ ! Route::is('cefa.tilabs.index') ?: 'active' }}">
              <i class="fas fa-home"></i>
              <p>
                {{ __('Home') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.tilabs.labs') }}" class="nav-link {{ ! Route::is('cefa.tilabs.labs') ?: 'active' }}">
              <i class="fas fa-school"></i>
              <p>
                {{ __('Labs') }}
              </p>
            </a>
          </li>
          @if(Route::is('tilabs.admin.*'))
          <li class="nav-item">
            <a href="{{ route('tilabs.admin.dashboard') }}" class="nav-link {{ ! Route::is('tilabs.admin.dashboard') ?: 'active' }}">
              <i class="fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="{{ route('tilabs.admin.loan') }}" class="nav-link {{ ! Route::is('tilabs.admin.loan') ?: 'active' }}">
              <i class="fas fa-share"></i>
              <p>
                {{ __('Préstamo') }}
              </p>
            </a>
          </li>      
          <li class="nav-item">
            <a href="{{ route('tilabs.admin.return') }}" class="nav-link {{ ! Route::is('tilabs.admin.return') ?: 'active' }}">
              <i class="fas fa-reply"></i>
              <p>
                {{ __('Devolución') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('tilabs.admin.transactions') }}" class="nav-link {{ ! Route::is('tilabs.admin.transactions') ?: 'active' }}">
              <i class="fas fa-dolly-flatbed"></i>
              <p>
                {{ __('Movimientos') }}
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('cefa.tilabs.inventory') }}" class="nav-link {{ ! Route::is('cefa.tilabs.inventory') ?: 'active' }}">
              <i class="fas fa-clipboard-list"></i>
              <p>
                {{ __('Inventario') }}
              </p>
            </a>
          </li>       
          <li class="nav-item">
            <a href="{{ route('cefa.tilabs.developers') }}" class="nav-link {{ ! Route::is('cefa.tilabs.developers') ?: 'active' }}">
              <i class="fas fa-users"></i>
              <p>
                {{ __('Developers') }}
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>