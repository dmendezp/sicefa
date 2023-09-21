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
                    <li class="has-dropdown mega-dropdown active">
                        <a href="{{ route('cefa.cafeto.index') }}" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-house"></i> Inicio</a>
                    </li>
                @endif
                <!-- Home Administrador -->
                @if (Route::is('cafeto.admin.*'))
                    @if (Auth::user()->havePermission('cafeto.admin.index'))
                        <li class="has-dropdown mega-dropdown active">
                            <a href="{{ route('cafeto.admin.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> Inicio</a>
                        </li>
                    @endif
                @endif
                <!-- Home Cashier -->
                @if (Route::is('cafeto.cashier.*'))
                    @if (Auth::user()->havePermission('cafeto.cashier.index'))
                        <li class="has-dropdown mega-dropdown active">
                            <a href="{{ route('cafeto.cashier.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> Inicio</a>
                        </li>
                    @endif
                @endif

                <!-- Menú de opciones públicas -->
                @if (Route::is('cefa.cafeto.*'))
                    <!-- Info and credits -->
                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"
                            data-hover="shop">Información</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('cefa.cafeto.devs') }}">
                                    Acerca de
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cefa.cafeto.devs') }}">
                                    Desarrolladores
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <!-- Menú de opciones para administrador -->
                @if (Route::is('cafeto.admin.*'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-sitemap"></i> Administración</a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <!-- Column #1 -->
                                        <div class="col-md-3">
                                            <a href="#">Inventario</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i>Inventario
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.element.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.element.index') }}">
                                                            <i class="fa-regular fa-image"></i>Adm. Elementos
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.reports.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.reports.index') }}">
                                                            <i class="fa-solid fa-chart-column"></i>Panel del reportes
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.movements.index'))
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa-solid fa-shuffle"></i>Histórico de Movimientos
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- .col-md-3 end -->

                                        <!-- Column #2 -->
                                        <div class="col-md-3">
                                            <a href="#">Ventas</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.sale.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.sale.index') }}">
                                                            <i class="fa-solid fa-cart-shopping"></i>Ventas
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.admin.cash.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.admin.cash.index') }}">
                                                            <i class="fa-solid fa-cash-register"></i>Control de caja
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- .col-md-3 end -->

                                        <!-- Column #3 -->
                                        <div class="col-md-3">
                                            <a href="#">Configuración</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.admin.configuration.index'))
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa-solid fa-print"></i>Impresora POS
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- .col-md-3 end -->
                                    </div>
                                    <!-- .row end -->
                                </div>
                                <!-- container end -->
                            </li>
                        </ul>
                        <!-- .mega-dropdown-menu end -->
                    </li>
                @endif

                <!-- Menú de opciones para cajero -->
                @if (Route::is('cafeto.cashier.*'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-sitemap"></i> Administración</a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <!-- Column #1 -->
                                        <div class="col-md-3">
                                            <a href="#">Inventario</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.inventory.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.inventory.index') }}">
                                                            <i class="fa-solid fa-boxes-stacked"></i>Inventario
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.reports.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.reports.index') }}">
                                                            <i class="fa-solid fa-chart-column"></i>Panel del reportes
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.movements.index'))
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa-solid fa-shuffle"></i>Histórico de Movimientos
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- .col-md-3 end -->

                                        <!-- Column #2 -->
                                        <div class="col-md-3">
                                            <a href="#">Ventas</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.sale.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.sale.index') }}">
                                                            <i class="fa-solid fa-cart-shopping"></i>Ventas
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->havePermission('cafeto.cashier.cash.index'))
                                                    <li>
                                                        <a href="{{ route('cafeto.cashier.cash.index') }}">
                                                            <i class="fa-solid fa-cash-register"></i>Control de Caja
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- .col-md-3 end -->

                                        <!-- Column #3 -->
                                        <div class="col-md-3">
                                            <a href="#">Configuración</a>
                                            <ul>
                                                @if (Auth::user()->havePermission('cafeto.cashier.configuration.index'))
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa-solid fa-print"></i>Impresora POS
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- .col-md-3 end -->
                                    </div>
                                    <!-- .row end -->
                                </div>
                                <!-- container end -->
                            </li>
                        </ul>
                        <!-- .mega-dropdown-menu end -->
                    </li>
                @endif

                <!-- Mode User -->
                @guest
                @else
                    @auth
                        @if (checkRol('cafeto.admin'))
                        <div class="module module-reservation pull-left">
                            <a class="btn-popup btn-popup-theme">Modo: Administrador</a>
                        </div>
                        @endif
                        @if (checkRol('cafeto.cashier'))
                        <div class="module module-reservation pull-left">
                            <a class="btn-popup btn-popup-theme">Modo: Cajero</a>
                        </div>
                        @endif
                    @endauth
                @endguest

                <!-- Menu Session-->
                <li class="has-dropdown">
                    @guest
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">Iniciar Sesion</a>
                    @else
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            {{ Auth::user()->person->fullname }} <i class="fa-solid fa-angles-down"></i>
                        </a>
                    @endguest
                    <ul class="dropdown-menu">
                        @guest
                            <li>
                                <a class="menu-item" href="{{ route('login') }}">
                                    Iniciar Sesion <i class="fa-solid fa-right-to-bracket"></i>
                                </a>
                            </li>
                        @else
                            @auth
                                @if (checkRol('cafeto.admin'))
                                    <li>
                                        <a href="{{ route('cafeto.admin.index') }}" class="menu-item">Modo Administrador</a>
                                    </li>
                                @endif
                                @if (checkRol('cafeto.cashier'))
                                    <li>
                                        <a href="{{ route('cafeto.cashier.index') }}" class="menu-item">Modo Cajero</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('cefa.cafeto.index') }}" class="menu-item">Modo Usuario</a>
                                </li>
                            @endauth
                            <li>
                                <a class="menu-item" href="{{ route('cefa.welcome') }}">
                                    Volver a SICEFA <i class="nav-icon fas fa-puzzle-piece"></i>
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesion <i class="fa-solid fa-right-to-bracket"></i>
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
                                Ingles
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('lang', ['es']) }}" class="menu-item">
                                <img src="{{ asset('modules/cafeto/images/flags/colombia.webp') }}" alt=""
                                    width="20px">
                                Español
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
