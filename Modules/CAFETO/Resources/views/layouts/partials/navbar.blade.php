<nav id="primary-menu" class="navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
            <ul class="nav navbar-nav nav-pos-right navbar-left">

                @php
                    $isPublic = Route::is('cefa.cafeto.*');
                    $isAdminMode = Route::is('cafeto.admin.*');
                    $isCashierMode = Route::is('cafeto.cashier.*');
                    $isInstructorMode = Route::is('cafeto.instructor.*');

                    // Roles reales
                    $hasAdmin = Auth::check() && checkRol('cafeto.admin');
                    $hasCashier = Auth::check() && checkRol('cafeto.cashier');
                    $hasInstructor = Auth::check() && checkRol('cafeto.instructor');

                    if ($isAdminMode) {
                        $mode = 'admin';
                    } elseif ($isCashierMode) {
                        $mode = 'cashier';
                    } elseif ($isInstructorMode) {
                        $mode = 'instructor';
                    } elseif ($isPublic) {
                        $mode = 'public';
                    } else {
                        $mode = $hasAdmin ? 'admin' : ($hasCashier ? 'cashier' : ($hasInstructor ? 'instructor' : 'public'));
                    }

                    /*
                      ✅ YA EXISTEN:
                        - cafeto.admin.index
                        - cafeto.cashier.index
                        - cafeto.instructor.index
                    */
                    $homeRoute = match ($mode) {
                        'admin' => ($hasAdmin ? route('cafeto.admin.index') : route('cefa.cafeto.index')),
                        'cashier' => ($hasCashier ? route('cafeto.cashier.index') : route('cefa.cafeto.index')),
                        'instructor' => ($hasInstructor ? route('cafeto.instructor.index') : route('cefa.cafeto.index')),
                        default => route('cefa.cafeto.index'),
                    };

                    // HOME active según modo
                    $homeActive = match (true) {
                        $isAdminMode => Route::is('cafeto.admin.index'),
                        $isCashierMode => Route::is('cafeto.cashier.index'),
                        $isInstructorMode => Route::is('cafeto.instructor.index'),
                        default => Route::is('cefa.cafeto.index'),
                    };

                    $modeLabel = match ($mode) {
                        'admin' => trans('cafeto::general.ModeA'),
                        'cashier' => trans('cafeto::general.ModeC'),
                        'instructor' => trans('cafeto::general.ModeI'),
                        default => trans('cafeto::general.MainPage'),
                    };

                    // ✅ FIX: SIEMPRE ir a vistas reales (NO anclas)
                    $infoHref = route('cefa.cafeto.info');   // /cafeto/information
                    $devsHref = route('cefa.cafeto.devs');   // /cafeto/developers

                    $infoActive = Route::is('cefa.cafeto.info') || Route::is('cefa.cafeto.devs');
                @endphp

                {{-- HOME --}}
                <li class="has-dropdown mega-dropdown {{ $homeActive ? 'active' : '' }}">
                    <a href="{{ $homeRoute }}" class="dropdown-toggle menu-item">
                        <i class="fa-solid fa-house"></i> {{ trans('cafeto::general.MainPage') }}
                    </a>
                </li>

                {{-- ✅ Información (siempre visible y SIEMPRE a vistas reales) --}}
                <li class="has-dropdown {{ $infoActive ? 'active' : '' }}">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item" data-hover="shop">
                        {{ trans('cafeto::general.Information') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ $infoHref }}">
                                <i class="fa-solid fa-info"></i> - {{ trans('cafeto::general.AboutUs') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ $devsHref }}">
                                <i class="fa-solid fa-code"></i> - {{ trans('cafeto::general.Developers') }}
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENÚ ADMIN --}}
                @if ($mode === 'admin' && Auth::check() && checkRol('cafeto.admin'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            <i class="fa-solid fa-sitemap"></i> {{ trans('cafeto::general.Administration') }}
                        </a>

                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Inventory') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i> {{ trans('cafeto::general.Inventory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.element.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.element.index') }}">
                                                            <i class="fa-regular fa-image"></i> {{ trans('cafeto::general.Elements') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Sales') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.sale.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.sale.index') }}">
                                                            <i class="fa-solid fa-cart-shopping"></i> {{ trans('cafeto::general.Sales') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.cash.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.cash.index') }}">
                                                            <i class="fa-solid fa-cash-register"></i> {{ trans('cafeto::general.CashControl') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Control') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.reports.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.reports.index') }}">
                                                            <i class="fa-solid fa-chart-column"></i> {{ trans('cafeto::general.ReportsPanel') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.movements.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.movements.index') }}">
                                                            <i class="fa-solid fa-shuffle"></i> {{ trans('cafeto::general.MovementHistory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Configuration') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.configuration.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.configuration.index') }}">
                                                            <i class="fa-solid fa-print"></i> {{ trans('cafeto::general.PrintPOS') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.navbarForm') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.formulations.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.formulations.index') }}">
                                                            <i class="fa-solid fa-flask"></i> {{ trans('cafeto::general.Formulations') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.formulations.create'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.formulations.create') }}">
                                                            <i class="fa-solid fa-plus"></i> {{ trans('cafeto::general.Create Formulation') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- MENÚ CASHIER --}}
                @if ($mode === 'cashier' && Auth::check() && checkRol('cafeto.cashier'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            <i class="fa-solid fa-sitemap"></i> {{ trans('cafeto::general.Cashier') }}
                        </a>

                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Inventory') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i> {{ trans('cafeto::general.Inventory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Sales') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.sale.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.sale.index') }}">
                                                            <i class="fa-solid fa-cart-shopping"></i> {{ trans('cafeto::general.Sales') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.cash.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.cash.index') }}">
                                                            <i class="fa-solid fa-cash-register"></i> {{ trans('cafeto::general.CashControl') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Control') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.reports.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.reports.index') }}">
                                                            <i class="fa-solid fa-chart-column"></i> {{ trans('cafeto::general.ReportsPanel') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.movements.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.movements.index') }}">
                                                            <i class="fa-solid fa-shuffle"></i> {{ trans('cafeto::general.MovementHistory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Configuration') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.configuration.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.configuration.index') }}">
                                                            <i class="fa-solid fa-print"></i> {{ trans('cafeto::general.PrintPOS') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.navbarForm') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.formulations.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.formulations.index') }}">
                                                            <i class="fa-solid fa-flask"></i> {{ trans('cafeto::general.Formulations') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.formulations.create'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.formulations.create') }}">
                                                            <i class="fa-solid fa-plus"></i> {{ trans('cafeto::general.Create Formulation') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- MENÚ INSTRUCTOR (SOLO FORMULACIONES + INVENTARIO) --}}
                @if ($mode === 'instructor' && Auth::check() && checkRol('cafeto.instructor'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            <i class="fa-solid fa-sitemap"></i> {{ trans('cafeto::general.Instructor') }}
                        </a>

                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Inventory') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.instructor.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.instructor.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i> {{ trans('cafeto::general.Inventory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.navbarForm') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.instructor.formulations.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.instructor.formulations.index') }}">
                                                            <i class="fa-solid fa-flask"></i> {{ trans('cafeto::general.Formulations') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.instructor.formulations.create'))
                                                    <li>
                                                        <a href="{{ route('cafeto.instructor.formulations.create') }}">
                                                            <i class="fa-solid fa-plus"></i> {{ trans('cafeto::general.Create Formulation') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- SESSION MENU --}}
                <li class="has-dropdown">
                    @guest
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            {{ trans('cafeto::general.Log In') }}
                        </a>
                    @else
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            {{ Auth::user()->person->fullname }}
                            <span class="label label-default" style="margin-left:6px;">{{ $modeLabel }}</span>
                            <i class="fa-solid fa-angles-down"></i>
                        </a>
                    @endguest

                    <ul class="dropdown-menu">
                        @guest
                            <li>
                                <a class="menu-item" href="{{ route('login', ['redirect' => url()->current()]) }}">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{ trans('cafeto::general.Log In') }}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('cefa.welcome') }}">
                                    <i class="nav-icon fas fa-puzzle-piece"></i> {{ trans('cafeto::general.Back to SICEFA') }}
                                </a>
                            </li>
                        @else
                            @if (checkRol('cafeto.admin'))
                                <li>
                                    <a href="{{ route('cafeto.admin.index') }}" class="menu-item">
                                        <i class="fa-solid fa-user-tie"></i> {{ trans('cafeto::general.ModeA') }}
                                    </a>
                                </li>
                            @endif

                            @if (checkRol('cafeto.cashier'))
                                <li>
                                    <a href="{{ route('cafeto.cashier.index') }}" class="menu-item">
                                        <i class="fa-solid fa-user"></i> {{ trans('cafeto::general.ModeC') }}
                                    </a>
                                </li>
                            @endif

                            @if (checkRol('cafeto.instructor'))
                                <li>
                                    <a href="{{ route('cafeto.instructor.index') }}" class="menu-item">
                                        <i class="fa-solid fa-chalkboard-teacher"></i> {{ trans('cafeto::general.ModeI') }}
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a class="menu-item" href="{{ route('cefa.welcome') }}">
                                    <i class="nav-icon fas fa-puzzle-piece"></i> {{ trans('cafeto::general.Back to SICEFA') }}
                                </a>
                            </li>

                            <li>
                                <a class="menu-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{ trans('cafeto::general.Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </li>

                {{-- LANGUAGE MENU --}}
                <li class="has-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                        <i class="fas fa-globe-americas"></i> {{ session('lang') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('lang', ['en']) }}" class="menu-item">
                                <img src="{{ asset('modules/cafeto/images/flags/estados-unidos.webp') }}" alt="" width="20px">
                                {{ trans('cafeto::general.English') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('lang', ['es']) }}" class="menu-item">
                                <img src="{{ asset('modules/cafeto/images/flags/colombia.webp') }}" alt="" width="20px">
                                {{ trans('cafeto::general.Spanish') }}
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
