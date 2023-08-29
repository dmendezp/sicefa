<aside class="main-sidebar sidebar-light-primary sidebar-background-cafeto elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.cafeto.index') }}" class="brand-link pb-1 text-decoration-none">
        <h3 class="text-light">
            <i class="nav-icon fas fa-mug-hot ml-3 mr-1"></i>
            <span class="brand-text">CAFETO</span>
        </h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
                @if (isset(Auth::user()->person->avatar))
                    <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"class="img-circle elevation-2"
                        alt="User Image">
                @else
                    <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            @guest
                <div class="col info info-user">
                    <a href="{{ route('login') }}" class="d-block" style="text-decoration: none; color:white">Iniciar Sesion</a>
                </div>
                <div class="col-auto info float-right ">
                    <a href="{{ route('login') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Ingresar">
                        <i class="fas fa-sign-in-alt"  style="color:white"></i>
                    </a>
                </div>
            @else
                <div class="col info info-user">
                    <div data-toggle="tooltip" data-placement="top"
                        title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                        {{ Auth::user()->nickname }}
                    </div>
                    <div class="small">
                        <em> {{ Auth::user()->roles[0]->name }}</em>
                    </div>
                </div>
                <div class="col-auto info float-right mt-2">
                    <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Cerrar Sesion" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <p>Volver a SICEFA</p>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('cefa.cafeto.index') }}" class="nav-link {{ !Route::is('cefa.cafeto.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.inventory.index') }}" class="nav-link {{ !Route::is('cafeto.inventory.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Inventario</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.sale.index') }}" class="nav-link {{ !Route::is('cafeto.sale.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Ventas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.element.index') }}" class="nav-link {{ !Route::is('cafeto.element.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Productos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-light">
                        <i class="nav-icon fa-solid fa-bars"></i>
                        <p>Control de Menú</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-light">
                        <i class="nav-icon fa-solid fa-cash-register"></i>
                        <p>Control de Caja</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.reports.index') }}"
                        class="nav-link {{ !Route::is('cafeto.reports.index.*') ?: 'active' }}">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p>Panel de Reportes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-light">
                        <i class="nav-icon fa-solid fa-ruler"></i>
                        <p>Unidades de Medida</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-light">
                        <i class="nav-icon fa-solid fa-gears"></i>
                        <p>Configuración</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cefa.cafeto.info') }}" class="nav-link {{ !Route::is('cefa.cafeto.info*') ?: 'active' }} text-light">
                        <i class="nav-icon fa-solid fa-info"></i>
                        <p>Acerca de</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cefa.cafeto.devs') }}" class="nav-link {{ !Route::is('cefa.cafeto.devs*') ?: 'active' }} text-light">
                        <i class="nav-icon fa-solid fa-code"></i>
                        <p>Desarrolladores</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
