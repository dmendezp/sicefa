<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.ptventa.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/ptventa/images/Logo-Sidebar.png') }}" class="brand-image"
                alt="PTVenta-Logo">{{-- Icono de punto de venta --}}
            <span class="brand-text font-weight-bold">{{ trans('ptventa::general.Sales Point')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                <div class="row col-md-12">
                    <div class="col-auto image mt-2 mb-2">
                        @if (isset(Auth::user()->person->avatar))
                            <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                        @endif
                    </div>
                    @guest
                        <div class="col info info-user">
                            <div>{{ trans('menu.Welcome') }}</div>
                            <div>
                                <a href="{{ route('login') }}" class="d-block">Iniciar sesión</a>
                            </div>
                        </div>
                        <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}">
                            <a href="{{ route('login') }}" class="d-block">
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                        </div>
                    @else
                        <div class="col info info-user">
                            <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                                {{ Auth::user()->nickname }}
                            </div>
                            <div class="small">
                                <em> {{ Auth::user()->roles[0]->name }}</em>
                            </div>
                        </div>
                        <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}">
                            <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>

            <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                <nav class="">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{ route('cefa.welcome') }}"
                                class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                                <i class="fas fa-puzzle-piece"></i>
                                <p>
                                    {{ trans('ptventa::general.Back to SICEFA')}}
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.index') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>{{ trans('ptventa::general.Home')}}</p>
                        </a>
                    </li>
                    @auth {{-- Muestra lo siguiente para los USUARIOS AUTENTICADOS --}}
                        @if (Auth::user()->havePermission('ptventa.inventory.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.inventory.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.inventory.index*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>{{ trans('ptventa::general.Inventory')}}</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('ptventa.sale.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.sale.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.sale.index*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>{{ trans('ptventa::general.Sales')}}</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('ptventa.element.image.index'))
                            <li class="nav-item">
                                <a href="{{ route('ptventa.element.image.index') }}"
                                    class="nav-link {{ !Route::is('ptventa.element.image.index*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-image"></i>
                                    <p>{{ trans('ptventa::general.Products')}}</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('ptventa.cash.index'))
                            <li class="nav-item menu-closed">
                                <a href="#" class="nav-link {{ !Route::is('ptventa.cash.index*') ?: 'active' }}">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    {{ trans('ptventa::general.Cash control')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('ptventa.cash.index') }}" class="nav-link active">
                                        <i class="fas fa-store nav-icon"></i>
                                        <p>{{ trans('ptventa::general.Cash Opening')}}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('ptventa.cashCount.close') }}" class="nav-link">
                                        <i class="fas fa-store-slash nav-icon"></i>
                                        <p>{{ trans('ptventa::general.Cash Closing')}}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('ptventa.report.form'))
                        <li class="nav-item">
                            <a href="{{ route('ptventa.report.form') }}"
                                class="nav-link {{ !Route::is('ptventa.report.form*') ?: 'active' }}">
                                <i class="nav-icon fas fa-poll"></i>
                                <p>{{ trans('ptventa::general.Reports')}}</p>
                            </a>
                        </li>
                    @endif
                    @endauth
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.devs') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.devs*') ?: 'active' }}">
                            <i class="nav-icon fas fa-code"></i>
                            <p>{{ trans('ptventa::general.Developers')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.info') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.info*') ?: 'active' }}">
                            <i class="nav-icon fas fa-info"></i>
                            <p>{{ trans('ptventa::general.About us')}}</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
