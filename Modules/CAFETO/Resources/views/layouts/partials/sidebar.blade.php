<aside class="main-sidebar sidebar-dark-green sidebar-background-cafeto elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.cafeto.index') }}" class="brand-link pb-1 text-decoration-none">
        <h4 class="text-light">
            <i class="nav-icon fas fa-mug-hot ml-3 mr-1"></i>
            <span class="brand-text">CAFETO</span>
        </h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
                @if (isset(Auth::user()->person->avatar))
                    <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            @guest
                <div class="col info info-user">
                    <a href="{{ route('login') }}" class="d-block custom-color" style="text-decoration: none">{{ trans('cafeto::general.Log In') }}</a>
                </div>
                <div class="col-auto info float-right ">
                    <a href="{{ route('login') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title={{ trans('cafeto::general.InSession') }}>
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </div>
            @else
                <div class="col info info-user">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                        <div style="color:white">{{ Auth::user()->nickname }}</div>
                    </div>
                    <div class="small" style="color:white">
                        <em>{{ Auth::user()->roles[0]->name }}</em>
                    </div>
                </div>
                <div class="col-auto info float-right mt-2">
                    <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title={{ trans('cafeto::general.ExitSession') }} onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                <!-- Menú de opciones públicas -->
                @if(Route::is('cefa.cafeto.*'))
                    <li class="nav-item">
                        <a href="{{ route('cefa.cafeto.index') }}"
                            class="nav-link {{ !Route::is('cefa.cafeto.index*') ?: 'active' }} text-light">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.cafeto.devs') }}"
                            class="nav-link {{ !Route::is('cefa.cafeto.devs*') ?: 'active' }} text-light">
                            <i class="nav-icon fa-solid fa-code"></i>
                            <p>Desarrolladores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.cafeto.info') }}"
                            class="nav-link {{ !Route::is('cefa.cafeto.info*') ?: 'active' }} text-light">
                            <i class="nav-icon fa-solid fa-info"></i>
                            <p>Acerca de</p>
                        </a>
                    </li>
                @endif
                
                <!-- Menú de opciones para administrador -->
                @if(Route::is('cafeto.admin.*'))
                    @if(Auth::user()->havePermission('cafeto.admin.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.index') }}"
                                class="nav-link {{ !Route::is('cafeto.admin.index') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-house-chimney"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.inventory.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.inventory.index') }}"
                                class="nav-link {{ !Route::is('cafeto.admin.inventory.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.sale.index'))
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ !Route::is('cafeto.admin.sale.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.element.index'))
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ !Route::is('cafeto.element.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-image"></i>
                                <p>Adm. Elementos</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.cash.index'))
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>Control de Caja</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.reports.index'))
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ !Route::is('cafeto.reports.*') ?: 'active' }}">
                                <i class="nav-icon far fa-chart-bar"></i>
                                <p>Panel de Reportes</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.movements.index'))
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>Histórico de Movimientos</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.admin.configuration.index'))
                        <li class="nav-item">
                            <a href="#" 
                                class="nav-link {{ !Route::is('cefa.cafeto.configuration*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-gears"></i>
                                <p>Configuración</p>
                            </a>
                        </li>
                    @endif
                @endif

                <!-- Menú de opciones para cajero -->
                @if(Route::is('cafeto.cashier.*'))
                    @if(Auth::user()->havePermission('cafeto.cashier.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.index') }}"
                                class="nav-link {{ !Route::is('cafeto.cashier.index') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-house-chimney"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.cashier.inventory.index'))
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ !Route::is('cafeto.cashier.inventory.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.cashier.sale.index'))
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ !Route::is('cafeto.cashier.sale.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.cashier.cash.index'))
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>Control de Caja</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.cashier.reports.index'))
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ !Route::is('cafeto.reports.*') ?: 'active' }}">
                                <i class="nav-icon far fa-chart-bar"></i>
                                <p>Panel de Reportes</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.cashier.movements.index'))
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>Histórico de Movimientos</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.cashier.configuration.index'))
                        <li class="nav-item">
                            <a href="#" 
                                class="nav-link {{ !Route::is('cefa.cafeto.configuration*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-gears"></i>
                                <p>Configuración</p>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
