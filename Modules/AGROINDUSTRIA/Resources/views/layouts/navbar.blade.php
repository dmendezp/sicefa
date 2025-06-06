<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block mx-1">
            <a href="{{ route('cefa.sigac.index') }}" class="nav-link @if(Route::is('cefa.sigac.index')) active @endif">{{ trans('sigac::general.Home') }}</a>
        </li>
        @auth
            @if (checkRol('sigac.academic_coordinator'))
                <li class="nav-item d-none d-sm-inline-block mx-1">
                    <a href="{{ route('sigac.academic_coordination.dashboard') }}" class="nav-link @if(Route::is('sigac.academic_coordination.*')) active @endif">{{ trans('sigac::general.AcademicCoordination') }}</a>
                </li>
            @endif
            @if (checkRol('sigac.instructor'))
                <li class="nav-item d-none d-sm-inline-block mx-1">
                    <a href="{{ route('sigac.instructor.dashboard') }}" class="nav-link @if(Route::is('sigac.instructor.*')) active @endif">{{ trans('sigac::general.Instructor') }}</a>
                </li>
            @endif
            @if (checkRol('sigac.wellness'))
                <li class="nav-item d-none d-sm-inline-block mx-1">
                    <a href="{{ route('sigac.wellness.dashboard') }}" class="nav-link @if(Route::is('sigac.wellness.*')) active @endif">{{ trans('sigac::general.Wellness') }}</a>
                </li>
            @endif
            @if (checkRol('sigac.apprentice'))
                <li class="nav-item d-none d-sm-inline-block mx-1">
                    <a href="{{ route('sigac.apprentice.dashboard') }}" class="nav-link @if(Route::is('sigac.apprentice.*')) active @endif">{{ trans('sigac::general.Apprentice') }}</a>
                </li>
            @endif
            @if (checkRol('sigac.support'))
                <li class="nav-item d-none d-sm-inline-block mx-1">
                    <a href="{{ route('sigac.support.dashboard') }}" class="nav-link @if(Route::is('sigac.support.*')) active @endif">{{ trans('sigac::general.Support') }}</a>
                </li>
            @endif
            @if (checkRol('sigac.securitystaff'))
                <li class="nav-item d-none d-sm-inline-block mx-1">
                    <a href="{{ route('sigac.securitystaff.dashboard') }}" class="nav-link @if(Route::is('sigac.securitystaff.*')) active @endif">{{ trans('sigac::general.Securitystaff') }}</a>
                </li>
            @endif
        @endauth
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <button role="button" class="button-name">
            @guest
                <a href="{{ route('login') }}" class="text-decoration-none text-black">
                    <span>{{ trans('sigac::general.Log In') }}</span>
                </a>
            @else
                <span>{{ Auth::user()->person->fullname }}</span>
            @endguest
        </button>

        <li class="nav-item dropdown mx-1">
            <a class="nav-link" data-toggle="dropdown" href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                data-bs-title="{{ trans('sigac::general.Internacionalization') }}">
                <i class="fas fa-globe-americas"></i> {{ session('lang') }}
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                    <img src="{{ asset('modules/sigac/images/flags/estados-unidos.webp') }}" alt="">
                    {{ trans('sigac::general.English') }}
                </a>
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                    <img src="{{ asset('modules/sigac/images/flags/colombia.webp') }}" alt="">
                    {{ trans('sigac::general.Spanish') }}
                </a>
            </div>
        </li>

        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ trans('sigac::general.Apps') }}">
                <i class="fas fa-shapes"></i>
            </a>
        </li>

        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip"
                data-bs-placement="bottom" data-bs-title="{{ trans('sigac::general.Full Screen Mode') }}">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
