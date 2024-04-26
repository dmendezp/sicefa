<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('cefa.senaempresa.index') }}"
                class="nav-link @if (Route::is('cefa.senaempresa.*')) active @endif">{{ trans('senaempresa::menu.Home') }}</a>
        </li>
        @auth
            @if (checkRol('senaempresa.admin'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('senaempresa.admin.index') }}"
                        class="nav-link @if (Route::is('senaempresa.admin.*')) active @endif">{{ trans('senaempresa::menu.Administrator') }}
                    </a>
                </li>
            @endif
            @if (checkRol('senaempresa.human_talent_leader'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('senaempresa.human_talent_leader.index') }}"
                        class="nav-link @if (Route::is('senaempresa.human_talent_leader.*')) active @endif">{{ trans('senaempresa::menu.Human talent leader') }}
                    </a>
                </li>
            @endif
            @if (checkRol('senaempresa.psychologo'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('senaempresa.psychologo.index') }}"
                        class="nav-link @if (Route::is('senaempresa.psychologo.*')) active @endif">{{ trans('senaempresa::menu.Psychologo') }}
                    </a>
                </li>
            @endif
            @if (checkRol('senaempresa.apprentice'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('senaempresa.apprentice.index') }}"
                        class="nav-link @if (Route::is('senaempresa.apprentice.*')) active @endif">{{ trans('senaempresa::menu.Apprentice') }}
                    </a>
                </li>
            @endif

        @endauth
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @guest
        <li>
            <div type="button" class="button-login">
                <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="text-decoration-none" style="color: black; cursor: pointer;">
                    <span>{{ trans('senaempresa::menu.Login') }}</span>
                </a>
            </div>
        </li>
        @endguest

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ session('lang') }} <i class="fas fa-globe"></i>
            </a>
            <div class="dropdown-menu p-0">
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">{{ trans('senaempresa::menu.Spanish') }}</a>
                <a href="{{ url('lang', ['en']) }}" class="dropdown-item">{{ trans('senaempresa::menu.English') }}</a>
            </div>

        </li>
        @if (Route::is('senaempresa.admin.*') && (checkRol('senaempresa.admin')))
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('senaempresa.admin.manual_admin') }}" class="nav-link @if (Route::is('senaempresa.admin.manual_admin')) active @endif">
                    <i class="fas fa-book"></i>
                </a>
            </li>
        @endif
        @if (Route::is('senaempresa.human_talent_leader.*') && (checkRol('senaempresa.human_talent_leader')))
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('senaempresa.human_talent_leader.manual_human_talent_leader') }}" class="nav-link @if (Route::is('senaempresa.human_talent_leader.manual_human_talent_leader')) active @endif">
                    <i class="fas fa-book"></i>
                </a>
            </li>
        @endif
        @if (Route::is('senaempresa.psychologo.*') && (checkRol('senaempresa.psychologo')))
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('senaempresa.psychologo.manual_psychologo') }}" class="nav-link @if (Route::is('senaempresa.psychologo.manual_psychologo')) active @endif">
                    <i class="fas fa-book"></i>
                </a>
            </li>
        @endif
        @if (Route::is('senaempresa.apprentice.*') && (checkRol('senaempresa.apprentice')))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('senaempresa.apprentice.manual_apprentice') }}" class="nav-link @if (Route::is('senaempresa.apprentice.manual_apprentice')) active @endif">
                <i class="fas fa-book"></i>
            </a>
        </li>
    @endif
        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip"
                data-bs-placement="bottom" data-bs-title="{{ trans('senaempresa::menu.Full Screen Mode') }}">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- Ítem de ayuda con enlace al manual de usuario -->






    </ul>
</nav>
