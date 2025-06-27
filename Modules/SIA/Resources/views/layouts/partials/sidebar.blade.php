<aside class="main-sidebar sidebar-dark-green elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.sia.index') }}" class="brand-link pb-1 text-decoration-none">
        <h4 class="text-light">
           <i class="nav-icon fas fa-users mr-1"></i>
            <span class="brand-text">SIA</span>
        </h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
                @if (isset(Auth::user()->person->avatar))
                    <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2"
                        alt="User Image">
                @else
                    <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            @guest
                <div class="col info info-user">
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block custom-color"
                        style="text-decoration: none;>{{ trans('sia::general.Session') }}</a>
                </div>
                <div class="col-auto info float-right ">
                    <a href="{{ route('login') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title={{ trans('sia::general.InSession') }}>
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </div>
            @else
                <div class="col info info-user">
                    <div data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                        <div style="color: #FFFFFF;">{{ Auth::user()->nickname }}</div>
                    </div>
                    <div class="small" style="color: #FFFFFF;">
                        <em>{{ Auth::user()->roles[0]->name }}</em>
                    </div>
                </div>
                <div class="col-auto info float-right mt-2">
                    <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title={{ trans('sia::general.ExitSession') }} style="color: #FFFFFF;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>

        <div class="user-panel d-flex">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('cefa.welcome') }}"
                        class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ trans('sia::general.Back to SICEFA') }}</p>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menú de opciones públicas -->
                @if (Route::is('cefa.sia.*'))
                    <li class="nav-item">
                        <a href="{{ route('cefa.sia.index') }}"
                            class="nav-link {{ !Route::is('cefa.sia.index*') ?: 'active' }} text-light">
                            <i class="nav-icon fas fa-home"></i>
                            <p>{{ trans('sia::general.Home') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.sia.devs') }}"
                            class="nav-link {{ !Route::is('cefa.sia.devs*') ?: 'active' }} text-light">
                            <i class="nav-icon fa-solid fa-code"></i>
                            <p>{{ trans('sia::general.Developers') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.sia.info') }}"
                            class="nav-link {{ !Route::is('cefa.sia.info*') ?: 'active' }} text-light">
                            <i class="nav-icon fa-solid fa-info"></i>
                            <p>{{ trans('sia::general.About us') }}</p>
                        </a>
                    </li>
                @endif

                <!-- Menú de opciones para administrador -->
                @if (Route::is('sia.admin.*'))
                    @if (Auth::user()->havePermission('sia.admin.index'))
                        <li class="nav-item">
                            <a href="{{ route('sia.admin.index') }}"
                                class="nav-link {{ !Route::is('sia.admin.index') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-house-chimney"></i>
                                <p>{{ trans('sia::general.dashboard') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('sia.admin.users.index'))
                        <li class="nav-item">
                            <a href="{{ route('sia.admin.users.index') }}"
                                class="nav-link {{ !Route::is('sia.admin.users.index*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>{{ trans('sia::general.Users') }}</p>
                            </a>
                        </li>
                    @endif
                @endif

                <!-- Menu de opciones para instructor investigador -->

                <!-- Menú de opciones para aprendiz investigador -->
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>