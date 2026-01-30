{{-- ✅ CAMBIO 2: SIDEBAR corregido
   - Cajero: agrega Dashboard (home) para que NO “caiga” directo a ventas
   - Instructor: DEJA solo Formulaciones e Inventario y comenta el resto
   - NO se toca el resto del sidebar (público/admin quedan igual)
--}}

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
                @if (optional(Auth::user())->person && Auth::user()->person->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>

            @guest
                <div class="col info info-user">
                    <a href="{{ route('login') }}" class="d-block custom-color" style="text-decoration: none">
                        {{ trans('cafeto::general.Session') }}
                    </a>
                </div>
                <div class="col-auto info float-right ">
                    <a href="{{ route('login') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right"
                       data-bs-title="{{ trans('cafeto::general.InSession') }}">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </div>
            @else
                <div class="col info info-user">
                    <div data-bs-toggle="tooltip" data-bs-placement="right"
                         data-bs-title="{{ optional(Auth::user()->person)->first_name }} {{ optional(Auth::user()->person)->first_last_name }} {{ optional(Auth::user()->person)->second_last_name }}">
                        <div style="color:white">{{ Auth::user()->nickname }}</div>
                    </div>
                    <div class="small" style="color:white">
                        <em>{{ optional(Auth::user()->roles->first())->name }}</em>
                    </div>
                </div>

                <div class="col-auto info float-right mt-2">
                    <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right"
                       data-bs-title="{{ trans('cafeto::general.ExitSession') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    <a href="{{ route('cefa.welcome') }}" class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ trans('cafeto::general.Back to SICEFA') }}</p>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Menú público -->
                @if (Route::is('cefa.cafeto.*'))
                    <li class="nav-item">
                        <a href="{{ route('cefa.cafeto.index') }}"
                           class="nav-link {{ !Route::is('cefa.cafeto.index*') ?: 'active' }} text-light">
                            <i class="nav-icon fas fa-home"></i>
                            <p>{{ trans('cafeto::general.Home') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.cafeto.devs') }}"
                           class="nav-link {{ !Route::is('cefa.cafeto.devs*') ?: 'active' }} text-light">
                            <i class="nav-icon fa-solid fa-code"></i>
                            <p>{{ trans('cafeto::general.Developers') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.cafeto.info') }}"
                           class="nav-link {{ !Route::is('cefa.cafeto.info*') ?: 'active' }} text-light">
                            <i class="nav-icon fa-solid fa-info"></i>
                            <p>{{ trans('cafeto::general.About us') }}</p>
                        </a>
                    </li>
                @endif

                {{-- ======================= ADMIN (DASHBOARD ÚNICO) ======================= --}}
                @if (Route::is('cafeto.admin.*') || Route::is('cafeto.view.*'))
                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.index') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-house-chimney"></i>
                                <p>{{ trans('cafeto::general.dashboard') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.inventory.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.inventory.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.inventory.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>{{ trans('cafeto::general.Inventory') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.sale.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.sale.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.sale.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>{{ trans('cafeto::general.Sales') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.cash.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.cash.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.cash.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>{{ trans('cafeto::general.Cash Control') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.element.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.element.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.element.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-image"></i>
                                <p>{{ trans('cafeto::general.Products') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.reports.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.reports.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.reports.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-chart-column"></i>
                                <p>{{ trans('cafeto::general.Reports Panel') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.movements.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.movements.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.movements.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-shuffle"></i>
                                <p>{{ trans('cafeto::general.Movement History') }}</p>
                            </a>
                        </li>
                    @endif

                    {{-- Formulaciones (ADMIN) --}}
                    @if (Auth::check() && (Auth::user()->havePermission('cafeto.admin.formulations.index') || Auth::user()->havePermission('cafeto.admin.formulations.create')))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.formulations.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.formulations.*') ?: 'active' }} text-orange">
                                <i class="nav-icon fa-solid fa-flask"></i>
                                <p>{{ trans('cafeto::formulations.Title') ?: 'Formulations' }}</p>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.formulations.create'))
                            <li class="nav-item">
                                <a href="{{ route('cafeto.admin.formulations.create') }}"
                                   class="nav-link {{ !Route::is('cafeto.admin.formulations.create') ?: 'active' }} text-orange">
                                    <i class="nav-icon fa-solid fa-plus"></i>
                                    <p>{{ trans('cafeto::formulations.Create') ?: 'Create Formulation' }}</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.admin.configuration.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.admin.configuration.index') }}"
                               class="nav-link {{ !Route::is('cafeto.admin.configuration*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-gears"></i>
                                <p>{{ trans('cafeto::general.Configuration') }}</p>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- ======================= CASHIER (AHORA CON DASHBOARD) ======================= --}}
                @if (Route::is('cafeto.cashier.*'))
                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.index') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-house-chimney"></i>
                                <p>{{ trans('cafeto::general.dashboard') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.inventory.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.inventory.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.inventory.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>{{ trans('cafeto::general.Inventory') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.sale.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.sale.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.sale.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>{{ trans('cafeto::general.Sales') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.cash.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.cash.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.cash.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>{{ trans('cafeto::general.Cash Control') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.reports.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.reports.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.reports.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-chart-column"></i>
                                <p>{{ trans('cafeto::general.Reports Panel') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.movements.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.movements.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.movements.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-shuffle"></i>
                                <p>{{ trans('cafeto::general.Movement History') }}</p>
                            </a>
                        </li>
                    @endif

                    {{-- Formulaciones (CASHIER) --}}
                    @if (Auth::check() && (Auth::user()->havePermission('cafeto.cashier.formulations.index') || Auth::user()->havePermission('cafeto.cashier.formulations.create')))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.formulations.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.formulations.*') ?: 'active' }} text-orange">
                                <i class="nav-icon fa-solid fa-flask"></i>
                                <p>{{ trans('cafeto::formulations.Title') ?: 'Formulations' }}</p>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.formulations.create'))
                            <li class="nav-item">
                                <a href="{{ route('cafeto.cashier.formulations.create') }}"
                                   class="nav-link {{ !Route::is('cafeto.cashier.formulations.create') ?: 'active' }} text-orange">
                                    <i class="nav-icon fa-solid fa-plus"></i>
                                    <p>{{ trans('cafeto::formulations.Create') ?: 'Create Formulation' }}</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.cashier.configuration.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.cashier.configuration.index') }}"
                               class="nav-link {{ !Route::is('cafeto.cashier.configuration*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-gears"></i>
                                <p>{{ trans('cafeto::general.Configuration') }}</p>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- ======================= INSTRUCTOR (SOLO FORMULACIONES + INVENTARIO) ======================= --}}
                @if (Route::is('cafeto.instructor.*'))

                    {{-- ✅ (Opcional) Dashboard del instructor (si lo quieres visible) --}}
                    {{--
                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.index') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-house-chimney"></i>
                                <p>{{ trans('cafeto::general.dashboard') }}</p>
                            </a>
                        </li>
                    @endif
                    --}}

                    {{-- ✅ Formulaciones (INSTRUCTOR) --}}
                    @if (Auth::check() && (Auth::user()->havePermission('cafeto.instructor.formulations.index') || Auth::user()->havePermission('cafeto.instructor.formulations.create')))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.formulations.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.formulations.*') ?: 'active' }} text-orange">
                                <i class="nav-icon fa-solid fa-flask"></i>
                                <p>{{ trans('cafeto::formulations.Title') ?: 'Formulations' }}</p>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.formulations.create'))
                            <li class="nav-item">
                                <a href="{{ route('cafeto.instructor.formulations.create') }}"
                                   class="nav-link {{ !Route::is('cafeto.instructor.formulations.create') ?: 'active' }} text-orange">
                                    <i class="nav-icon fa-solid fa-plus"></i>
                                    <p>{{ trans('cafeto::formulations.Create') ?: 'Create Formulation' }}</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    {{-- ✅ Inventario (INSTRUCTOR) --}}
                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.inventory.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.inventory.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.inventory.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>{{ trans('cafeto::general.Inventory') }}</p>
                            </a>
                        </li>
                    @endif

                    {{-- ❌ TODO LO DEMÁS DEL INSTRUCTOR QUEDA COMENTADO (como pediste) --}}
                    {{--
                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.sale.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.sale.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.sale.*') ?: 'active' }} text-light">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>{{ trans('cafeto::general.Sales') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.cash.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.cash.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.cash.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-cash-register"></i>
                                <p>{{ trans('cafeto::general.Cash Control') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.reports.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.reports.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.reports.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-chart-column"></i>
                                <p>{{ trans('cafeto::general.Reports Panel') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.movements.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.movements.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.movements.*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-shuffle"></i>
                                <p>{{ trans('cafeto::general.Movement History') }}</p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check() && Auth::user()->havePermission('cafeto.instructor.configuration.index'))
                        <li class="nav-item">
                            <a href="{{ route('cafeto.instructor.configuration.index') }}"
                               class="nav-link {{ !Route::is('cafeto.instructor.configuration*') ?: 'active' }} text-light">
                                <i class="nav-icon fa-solid fa-gears"></i>
                                <p>{{ trans('cafeto::general.Configuration') }}</p>
                            </a>
                        </li>
                    @endif
                    --}}
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
