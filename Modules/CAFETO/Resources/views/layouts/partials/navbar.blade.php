<nav id="primary-menu" class="navbar navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
            <ul class="nav navbar-nav nav-pos-right navbar-left">
                <!-- Home público -->
                @if (Route::is('cefa.cafeto.*'))
                    <li class="has-dropdown mega-dropdown {{ Route::is('cefa.cafeto.index') ? 'active' : '' }}">
                        <a href="{{ route('cefa.cafeto.index') }}" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-house"></i> {{ trans('cafeto::general.MainPage') }}</a>
                    </li>
                @endif
                <!-- Home Administrador -->
                @if (Route::is('cafeto.admin.*') || Route::is('cafeto.view.*'))
                    @if (Auth::user()->havePermission('cafeto.admin.index'))
                        <li class="has-dropdown mega-dropdown {{ Route::is('cafeto.admin.index') ? 'active' : '' }}">
                            <a href="{{ route('cafeto.admin.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> {{ trans('cafeto::general.MainPage') }}</a>
                        </li>
                    @endif
                @endif
                <!-- Home Cashier -->
                @if (Route::is('cafeto.cashier.*'))
                    @if (Auth::user()->havePermission('cafeto.cashier.index'))
                        <li class="has-dropdown mega-dropdown {{ Route::is('cafeto.cashier.index') ? 'active' : '' }}">
                            <a href="{{ route('cafeto.cashier.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> {{ trans('cafeto::general.MainPage') }}</a>
                        </li>
                    @endif
                @endif
                <!-- Home Instructor -->
                @if (Route::is('cafeto.instructor.*'))
                    @if (Auth::user()->havePermission('cafeto.instructor.index'))
                        <li class="has-dropdown mega-dropdown {{ Route::is('cafeto.instructor.index') ? 'active' : '' }}">
                            <a href="{{ route('cafeto.instructor.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> {{ trans('cafeto::general.MainPage') }}</a>
                        </li>
                    @endif
                @endif

                <!-- Menú de opciones públicas -->
                @if (Route::is('cefa.cafeto.*'))
                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"
                            data-hover="shop">{{ trans('cafeto::general.Information') }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('cefa.cafeto.info') }}">
                                    <i class="fa-solid fa-info"></i> - {{ trans('cafeto::general.AboutUs') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cefa.cafeto.devs') }}">
                                    <i class="fa-solid fa-code"></i> - {{ trans('cafeto::general.Developers') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <!-- Menú de opciones para administrador -->
                @if (Route::is('cafeto.admin.*') || Route::is('cafeto.view.*'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-sitemap"></i> {{ trans('cafeto::general.Administration') }}</a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <!-- Column #1 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Inventory') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i>{{ trans('cafeto::general.Inventory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.element.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.element.index') }}">
                                                            <i class="fa-regular fa-image"></i>{{ trans('cafeto::general.Elements') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Column #2 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Sales') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.sale.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.sale.index') }}">
                                                            <i class="fa-solid fa-cart-shopping"></i>{{ trans('cafeto::general.Sales') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.cash.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.cash.index') }}">
                                                            <i class="fa-solid fa-cash-register"></i>{{ trans('cafeto::general.CashControl') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Column #3 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Control') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.reports.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.reports.index') }}">
                                                            <i class="fa-solid fa-chart-column"></i>{{ trans('cafeto::general.ReportsPanel') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.movements.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.movements.index') }}">
                                                            <i class="fa-solid fa-shuffle"></i>{{ trans('cafeto::general.MovementHistory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- {{-- Column #4 - Comentado para eliminar la sección de "Recipes Control" --}}
                                        {{--
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Recipes') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.recipes.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.recipes.index') }}">
                                                            <i class="fa-solid fa-kitchen-set"></i>{{ trans('cafeto::general.Recipes Control') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        --}} -->
                                        <!-- Column #5 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Configuration') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.configuration.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.configuration.index') }}">
                                                            <i class="fa-solid fa-print"></i>{{ trans('cafeto::general.PrintPOS') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Column #6 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.navbarForm') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.formulations.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.formulations.index') }}">
                                                            <i class="fa-solid fa-flask"></i>{{ trans('cafeto::general.Formulations') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.formulations.create') }}">
                                                            <i class="fa-solid fa-plus"></i>{{ trans('cafeto::general.Create Formulation') }}
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
                <!-- Menú de opciones para cajero -->
                @if (Route::is('cafeto.cashier.*'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-sitemap"></i> {{ trans('cafeto::general.Cashier') }}</a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <!-- Column #1 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Inventory') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i>{{ trans('cafeto::general.Inventory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.element.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.element.index') }}">
                                                            <i class="fa-regular fa-image"></i>{{ trans('cafeto::general.Elements') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Column #2 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Sales') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.sale.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.sale.index') }}">
                                                            <i class="fa-solid fa-cart-shopping"></i>{{ trans('cafeto::general.Sales') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.cash.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.cash.index') }}">
                                                            <i class="fa-solid fa-cash-register"></i>{{ trans('cafeto::general.CashControl') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Column #3 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Control') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.reports.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.reports.index') }}">
                                                            <i class="fa-solid fa-chart-column"></i>{{ trans('cafeto::general.ReportsPanel') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.movements.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.movements.index') }}">
                                                            <i class="fa-solid fa-shuffle"></i>{{ trans('cafeto::general.MovementHistory') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        {{-- Column #4 - Comentado para eliminar la sección de "Recipes Control" --}}
                                        {{--
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Recipes') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.recipes.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.recipes.index') }}">
                                                            <i class="fa-solid fa-kitchen-set"></i>{{ trans('cafeto::general.Recipes Control') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        --}}
                                        <!-- Column #5 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Configuration') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.configuration.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.configuration.index') }}">
                                                            <i class="fa-solid fa-print"></i>{{ trans('cafeto::general.PrintPOS') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Column #6 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.navbarForm') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.formulations'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.formulations.index') }}">
                                                            <i class="fa-solid fa-flask"></i>{{ trans('cafeto::general.Formulations') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.formulations.create') }}">
                                                            <i class="fa-solid fa-plus"></i>{{ trans('cafeto::general.Create Formulation') }}
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
                <!-- Menú de opciones para instructor -->
                @if (Route::is('cafeto.instructor.*'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-sitemap"></i> {{ trans('cafeto::general.Instructor') }}</a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <!-- Column #1 -->
                                        <div class="col-md-3">
                                            <a href="#">{{ trans('cafeto::general.Formulations') }}</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.instructor.formulations'))
                                                    <li>
                                                        <a href="{{ route('cafeto.instructor.formulations.index') }}">
                                                            <i class="fa-solid fa-flask"></i>{{ trans('cafeto::general.Formulations') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('cafeto.instructor.formulations.create') }}">
                                                            <i class="fa-solid fa-plus"></i>{{ trans('cafeto::general.Create Formulation') }}
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

                <!-- Mode User -->
                @guest
                @else
                    @auth
                        @if (checkRol('cafeto.admin'))
                            <div class="module module-reservation pull-left">
                                <a href="{{ route('cafeto.admin.index') }}" class="btn-popup btn-popup-theme">
                                    {{ trans('cafeto::general.ModeA') }}</a>
                            </div>
                        @endif
                        @if (checkRol('cafeto.cashier'))
                            <div class="module module-reservation pull-left">
                                <a href="{{ route('cafeto.cashier.index') }}" class="btn-popup btn-popup-theme">
                                    {{ trans('cafeto::general.ModeC') }}</a>
                            </div>
                        @endif
                        @if (checkRol('cafeto.instructor'))
                            <div class="module module-reservation pull-left">
                                <a href="{{ route('cafeto.instructor.index') }}" class="btn-popup btn-popup-theme">
                                    {{ trans('cafeto::general.ModeI') }}</a>
                            </div>
                        @endif
                    @endauth
                @endguest

                <!-- Menu Session-->
                <li class="has-dropdown">
                    @guest
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">{{ trans('cafeto::general.Log In') }}</a>
                    @else
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            {{ Auth::user()->person->fullname }} <i class="fa-solid fa-angles-down"></i>
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
                            @auth
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
                            @endauth
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
                <!-- Menu Lang-->
                <li class="has-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                            class="fas fa-globe-americas"></i> {{ session('lang') }}</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('lang', ['en']) }}" class="menu-item">
                                <img src="{{ asset('modules/cafeto/images/flags/estados-unidos.webp') }}"
                                    alt="" width="20px">
                                    {{ trans('cafeto::general.English') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('lang', ['es']) }}" class="menu-item">
                                <img src="{{ asset('modules/cafeto/images/flags/colombia.webp') }}" alt=""
                                    width="20px">
                                    {{ trans('cafeto::general.Spanish') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>