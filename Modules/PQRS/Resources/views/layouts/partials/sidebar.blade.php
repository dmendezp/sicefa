<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('modules/pqrs/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8; color: white">
      <span class="brand-text h3">PQRS</span>
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                    @endif        
                </div>
                @guest
                    <div class="col info info-user">
                        <div>{{ trans('menu.Welcome') }}</div>
                        <div>
                            <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">{{ trans('Auth.Login') }}</a>
                        </div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}">
                        <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </div>
                    @else
                    <div class="col info info-user">
                        <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                            {{ Auth::user()->nickname }}
                        </div>
                        <div class="small">
                            <em> {{ Auth::user()->roles->count() > 0 ? Auth::user()->roles[0]->name : 'Sin rol asignado' }} </em>
                        </div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}">
                        <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
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
                        <a href="{{ route('cefa.welcome') }}" class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                            <i class="fas fa-puzzle-piece"></i>
                            <p>
                                {{ trans('sica::menu.Back to') }} SICEFA
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- MENU PARA HOME (DE ACCESO GENERAL) -->
                @if (Route::is('*pqrs.home.*'))
                    <li class="nav-item">
                        <a href="{{ route('cefa.pqrs.home.index') }}"
                            class="nav-link {{ !Route::is('cefa.pqrs.home.index') ?: 'active' }}">
                            <i class="fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                @endif    

                <li class="nav-item">
                    <a href="{{ route('pqrs.tracking.index') }}" class="nav-link {{ !Route::is('pqrs.tracking.index') ?: 'active' }}">
                        <i class="fas fa-comments"></i>
                        <p>Seguimiento</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>