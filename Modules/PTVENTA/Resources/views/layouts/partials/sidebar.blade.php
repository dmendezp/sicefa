<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.ptventa.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/ptventa/images/Logo-Sidebar.webp') }}" class="brand-image"
                alt="PTVenta-Logo">{{-- Icono de punto de venta --}}
            <span class="brand-text font-weight-bold">{{ trans('ptventa::general.Sales Point') }}</span>
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
                        <a href="{{ route('login') }}" class="d-block" style="text-decoration: none">{{ trans('ptventa::general.Session') }}</a>
                    </div>
                    <div class="col-auto info float-right ">
                        <a href="{{ route('login') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ trans('ptventa::general.InSession') }}">
                            <i class="fas fa-sign-in-alt"></i>
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
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.index') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>{{ trans('ptventa::general.Home') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ptventa.inventory.index') }}"
                            class="nav-link {{ !Route::is('ptventa.inventory.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>{{ trans('ptventa::general.Inventory') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ptventa.sale.index') }}"
                            class="nav-link {{ !Route::is('ptventa.sale.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>{{ trans('ptventa::general.Sales') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ptventa.element.image.index') }}"
                            class="nav-link {{ !Route::is('ptventa.element.image.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-image"></i>
                            <p>{{ trans('ptventa::general.Products') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ptventa.cash.index') }}"
                            class="nav-link {{ !Route::is('ptventa.cash.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>{{ trans('ptventa::general.Cash Control') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ptventa.reports.index') }}"
                            class="nav-link {{ !Route::is('ptventa.reports.index*') ?: 'active' }}">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>{{ trans('ptventa::general.Reports Panel') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.configuration') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.configuration*') ?: 'active' }}">
                            <i class="nav-icon fa-solid fa-gears"></i>
                            <p>{{ trans('ptventa::general.Configuration') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.devs') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.devs*') ?: 'active' }}">
                            <i class="nav-icon fas fa-code"></i>
                            <p>{{ trans('ptventa::general.Developers') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.ptventa.info') }}"
                            class="nav-link {{ !Route::is('cefa.ptventa.info*') ?: 'active' }}">
                            <i class="nav-icon fas fa-info"></i>
                            <p>{{ trans('ptventa::general.About us') }}</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
