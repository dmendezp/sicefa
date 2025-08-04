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
                        data-bs-title={{ trans('sia::general.ExitSession') }} 
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
               <!-- Menú de opciones para administrador -->
@if (Route::is('sia.admin.*'))
    @if (Auth::user()->havePermission('sia.admin.index'))
        <li class="nav-item">
            <a href="{{ route('sia.admin.index') }}" class="nav-link {{ Route::is('sia.admin.index') ? 'active' : '' }} text-light">
                <i class="nav-icon fa-solid fa-house-chimney"></i>
                <p>{{ trans('sia::general.dashboard') }}</p>
            </a>
        </li>
    @endif

    <!-- Columna 1: Usuarios -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link {{ (Route::is('sia.admin.administrators.index') || Route::is('sia.admin.administrators.*') || Route::is('sia.admin.apprentice-researchers.index')) ? 'active' : '' }} text-light">
            <i class="nav-icon fa-solid fa-users"></i>
            <p>
                {{ trans('sia::general.users') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (Auth::user()->havePermission('sia.users.manage'))
                <li class="nav-item">
                    <a href="{{ route('sia.admin.administrators.index') }}" class="nav-link {{ Route::is('sia.admin.administrators.*') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-user-tie"></i>
                        <p>{{ trans('sia::general.administrators') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sia.admin.instructor-researchers.index') }}" class="nav-link {{ Route::is('sia.admin.instructor-researchers.*') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-chalkboard-teacher"></i>
                        <p>{{ trans('sia::general.instructor_researchers') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sia.admin.apprentice-researchers.index') }}" class="nav-link {{ Route::is('sia.admin.apprentice-researchers.*') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-user-graduate"></i>
                        <p>{{ trans('sia::general.apprentice_researchers') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>

    <!-- Columna 2: Publicar -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link {{ (Route::is('sia.admin.publications.index') || Route::is('sia.admin.publications.pending')) ? 'active' : '' }} text-light">
            <i class="nav-icon fa-solid fa-book"></i>
            <p>
                {{ trans('sia::general.publish') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (Auth::user()->havePermission('sia.posts.manage'))
                <li class="nav-item">
                    <a href="{{ route('sia.admin.publications.index') }}" class="nav-link {{ Route::is('sia.admin.publications.index') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>{{ trans('sia::general.all_publications') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sia.admin.publications.pending') }}" class="nav-link {{ Route::is('sia.admin.publications.pending') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-clock"></i>
                        <p>{{ trans('sia::general.pending_publications') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>

    <!-- Columna 3: Proyectos y Eventos -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link {{ (Route::is('sia.admin.projects.index') || Route::is('sia.admin.events.index')) ? 'active' : '' }} text-light">
            <i class="nav-icon fa-solid fa-briefcase"></i>
            <p>
                {{ trans('sia::general.projects_events') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (Auth::user()->havePermission('sia.projects.manage_all'))
                <li class="nav-item">
                    <a href="{{ route('sia.admin.projects.index') }}" class="nav-link {{ Route::is('sia.admin.projects.index') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-diagram-project"></i>
                        <p>{{ trans('sia::general.projects') }}</p>
                    </a>
                </li>
            @endif
            @if (Auth::user()->havePermission('sia.events.crud'))
                <li class="nav-item">
                    <a href="{{ route('sia.admin.events.index') }}" class="nav-link {{ Route::is('sia.admin.events.index') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-calendar-days"></i>
                        <p>{{ trans('sia::general.events') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>

    <!-- Columna 4: Alianzas y Semilleros de Investigación -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link {{ (Route::is('sia.admin.alliances.index') || Route::is('sia.admin.groups.index')) ? 'active' : '' }} text-light">
            <i class="nav-icon fa-solid fa-handshake"></i>
            <p>
                {{ trans('sia::general.alliances_groups') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (Auth::user()->havePermission('sia.alliances.crud'))
                <li class="nav-item">
                    <a href="{{ route('sia.admin.alliances.index') }}" class="nav-link {{ Route::is('sia.admin.alliances.index') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-link"></i>
                        <p>{{ trans('sia::general.alliances') }}</p>
                    </a>
                </li>
            @endif
            @if (Auth::user()->havePermission('sia.groups.manage'))
                <li class="nav-item">
                    <a href="{{ route('sia.admin.groups.index') }}" class="nav-link {{ Route::is('sia.admin.groups.index') ? 'active' : '' }} text-light">
                        <i class="nav-icon fa-solid fa-users-class"></i>
                        <p>{{ trans('sia::general.research_seedbeds') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

                <!-- Menu de opciones para instructor investigador -->

                <!-- Menú de opciones para aprendiz investigador -->
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>