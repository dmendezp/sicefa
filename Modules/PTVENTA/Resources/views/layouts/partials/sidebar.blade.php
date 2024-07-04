<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.ptventa.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/ptventa/images/logo-sidebar.webp') }}" class="brand-image"
                alt="PTVenta-Logo">{{-- Icono de punto de venta --}}
            <span class="brand-text font-weight-bold">{{ trans('ptventa::general.Sales Point') }}</span>
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
                        <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block custom-color" style="text-decoration: none">{{ trans('ptventa::general.Session') }}</a>
                    </div>
                    <div class="col-auto info float-right ">
                        <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ trans('ptventa::general.InSession') }}">
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
                        <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ trans('ptventa::general.ExitSession') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                            <p>{{ trans('ptventa::general.Back to SICEFA') }}</p>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    {{-- Menú de opciones públicas --}}
                    @if(Route::is('cefa.ptventa.*'))
                        <li class="nav-item">
                            <a href="{{ route('cefa.ptventa.index') }}"
                                class="nav-link {{ !Route::is('cefa.ptventa.index') ?: 'active' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>{{ trans('ptventa::general.Home') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cefa.ptventa.devs') }}"
                                class="nav-link {{ !Route::is('cefa.ptventa.devs') ?: 'active' }}">
                                <i class="nav-icon fas fa-code"></i>
                                <p>{{ trans('ptventa::general.Developers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cefa.ptventa.info') }}"
                                class="nav-link {{ !Route::is('cefa.ptventa.info') ?: 'active' }}">
                                <i class="nav-icon fas fa-info"></i>
                                <p>{{ trans('ptventa::general.About us') }}</p>
                            </a>
                        </li>
                    @endif

                    {{-- Menú de opciones para Administrador --}}
                    @if(Route::is('ptventa.admin.*'))
                        @if(Auth::user()->havePermission('ptventa.admin.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.index') ?: 'active' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>{{ trans('ptventa::general.dashboard') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.inventory.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.inventory.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.inventory.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>{{ trans('ptventa::general.Inventory') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.sale.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.sale.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.sale.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>{{ trans('ptventa::general.Sales') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.element.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.element.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.element.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-image"></i>
                                    <p>{{ trans('ptventa::general.Products') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.cash.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.cash.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.cash.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-cash-register"></i>
                                    <p>{{ trans('ptventa::general.Cash Control') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.reports.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.reports.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.reports.*') ?: 'active' }}">
                                    <i class="nav-icon far fa-chart-bar"></i>
                                    <p>{{ trans('ptventa::general.Reports Panel') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.movements.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.movements.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.movements.*') ?: 'active' }}">
                                    <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
                                    <p>{{ trans('ptventa::general.Movement History') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.admin.configuration.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.admin.configuration.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.admin.configuration.*') ?: 'active' }}">
                                    <i class="nav-icon fa-solid fa-gears"></i>
                                    <p>{{ trans('ptventa::general.Configuration') }}</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    {{-- Menú de opciones para Cajero --}}
                    @if(Route::is('ptventa.cashier.*'))
                        @if(Auth::user()->havePermission('ptventa.cashier.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.cashier.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.cashier.index') ?: 'active' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>{{ trans('ptventa::general.dashboard') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.cashier.inventory.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.cashier.inventory.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.cashier.inventory.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>{{ trans('ptventa::general.Inventory') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.cashier.sale.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.cashier.sale.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.cashier.sale.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>{{ trans('ptventa::general.Sales') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.cashier.cash.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.cashier.cash.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.cashier.cash.*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-cash-register"></i>
                                    <p>{{ trans('ptventa::general.Cash Control') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.cashier.reports.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.cashier.reports.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.cashier.reports.*') ?: 'active' }}">
                                    <i class="nav-icon far fa-chart-bar"></i>
                                    <p>{{ trans('ptventa::general.Reports Panel') }}</p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.cashier.movements.index'))
                        <li class="nav-item">
                            <a href="{{ route('ptventa.cashier.movements.index') }}"
                                class="nav-link {{ !Route::is('ptventa.cashier.movements.*') ?: 'active' }}">
                                <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
                                <p>{{ trans('ptventa::general.Movement History') }}</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.cashier.configuration.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.cashier.configuration.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.cashier.configuration.*') ?: 'active' }}">
                                    <i class="nav-icon fa-solid fa-gears"></i>
                                    <p>{{ trans('ptventa::general.Configuration') }}</p>
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
</div>
