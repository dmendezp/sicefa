<nav style="height: 60px" class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item mr-1">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- Mostrar elementos en el navbar en pantallas grandes -->
        <li class="nav-item d-lg-inline-block">
            <a href="{{ route('cefa.sica.home.index') }}" class="nav-link">{{ trans('sica::menu.Home') }}</a>
        </li>
        @auth
        @if (checkRol('superadmin'))
        @guest
        @else
            @if (checkRol('sica.admin'))
                <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.admin.*') ?: 'active' }}">
                    <a href="{{ route('sica.admin.dashboard') }}" class="nav-link">
                        {{ trans('sica::menu.Administrator') }}
                    </a>
                </li>
            @endif
            @if (checkRol('sica.attendance'))
                <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.attendance.*') ?: 'active' }}">
                    <a href="{{ route('sica.attendance.dashboard') }}" class="nav-link">
                        {{ trans('sica::menu.Attendance') }}
                    </a>
                </li>
            @endif
            @if (checkRol('sica.academic_coordinator'))
                <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.academic_coordinator.*') ?: 'active' }}">
                    <a href="{{ route('sica.academic_coordinator.dashboard') }}" class="nav-link">
                        {{ trans('sica::menu.academic_coordinator') }}
                    </a>
                </li>
            @endif
            @if (checkRol('sica.unitmanager'))
            <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.unitmanager.*') ?: 'active' }}">
                <a href="{{ route('sica.unitmanager.dashboard') }}" class="nav-link">
                    {{ trans('sica::menu.Unitmanager') }}
                </a>
            </li>
            @endif
        @endguest
        
        @guest
        @else
        <!-- Mostrar lista desplegable en pantallas pequeñas -->
        <li class="nav-item dropdown d-lg-none">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Roles
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                
                    @if (checkRol('sica.admin'))
                        <a class="dropdown-item" href="{{ route('sica.admin.dashboard') }}">{{ trans('sica::menu.Administrator') }}</a>
                    @endif
                    @if (checkRol('sica.attendance'))
                        <a class="dropdown-item" href="{{ route('sica.attendance.dashboard') }}">{{ trans('sica::menu.Attendance') }}</a>
                    @endif
                    @if (checkRol('sica.academic_coordinator'))
                        <a class="dropdown-item" href="{{ route('sica.academic_coordinator.dashboard') }}">{{ trans('sica::menu.academic_coordinator') }}</a>
                    @endif
                    @if (checkRol('sica.unitmanager'))
                        <a class="dropdown-item" href="{{ route('sica.unitmanager.dashboard') }}">{{ trans('sica::menu.Unitmanager') }}</a>
                    @endif
               
            </div>
        </li>
        @endguest
        @else
        @guest
        @else
            @if (checkRol('sica.admin'))
                <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.admin.*') ?: 'active' }}">
                    <a href="{{ route('sica.admin.dashboard') }}" class="nav-link">
                        {{ trans('sica::menu.Administrator') }}
                    </a>
                </li>
            @endif
            @if (checkRol('sica.attendance'))
                <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.attendance.*') ?: 'active' }}">
                    <a href="{{ route('sica.attendance.dashboard') }}" class="nav-link">
                        {{ trans('sica::menu.Attendance') }}
                    </a>
                </li>
            @endif
            @if (checkRol('sica.academic_coordinator'))
                <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.academic_coordinator.*') ?: 'active' }}">
                    <a href="{{ route('sica.academic_coordinator.dashboard') }}" class="nav-link">
                        {{ trans('sica::menu.academic_coordinator') }}
                    </a>
                </li>
            @endif
            @if (checkRol('sica.unitmanager'))
            <li class="nav-item d-none d-lg-inline-block mr-1 {{ !Route::is('*.unitmanager.*') ?: 'active' }}">
                <a href="{{ route('sica.unitmanager.dashboard') }}" class="nav-link">
                    {{ trans('sica::menu.Unitmanager') }}
                </a>
            </li>
            @endif
        @endguest
        
        @guest  
        @else
        <!-- Mostrar lista desplegable en pantallas pequeñas -->
        <li class="nav-item d-lg-none">
            @if (checkRol('sica.admin'))
            <a class="nav-link" href="{{ route('sica.admin.dashboard') }}">{{ trans('sica::menu.Administrator') }}</a>
            @endif
            @if (checkRol('sica.attendance'))
            <a class="nav-link" href="{{ route('sica.attendance.dashboard') }}">{{ trans('sica::menu.Attendance') }}</a>
            @endif
            @if (checkRol('sica.academic_coordinator'))
            <a class="nav-link" style="height: 60px;" href="{{ route('sica.academic_coordinator.dashboard') }}">{{ trans('sica::menu.academic_coordinator') }}</a>
            @endif
            @if (checkRol('sica.academic_coordinator'))
            <a class="nav-link" style="height: 60px;" href="{{ route('sica.unitmanager.dashboard') }}">{{ trans('sica::menu.Unitmanager') }}</a>
            @endif
        </li>
        @endguest
        @endif
        @endauth
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 {{ trans('modulo1::menu.Notifications') }}</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 {{ trans('modulo1::menu.new messages') }}
                    <span class="float-right text-muted text-sm">3 {{ trans('modulo1::menu.mins') }}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 {{ trans('modulo1::menu.new reports') }}
                    <span class="float-right text-muted text-sm">2 {{ trans('modulo1::menu.days') }}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">
                    {{ trans('modulo1::menu.See All Notifications') }}
                </a>
            </div>
        </li>
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
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                    Español
                </a>
                <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                    English
                </a>
            </div>
        </li>
    </ul>
</nav>
