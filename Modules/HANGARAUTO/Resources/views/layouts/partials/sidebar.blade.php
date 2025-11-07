<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.hangarauto.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/HANGARAUTO/img/autologo.png') }}" class="brand-image" alt="HANGARAUTO-Logo">{{-- Icono de huella de carbono --}}
            <span class="brand-text font-weight-bold">{{ trans('hangarauto::general.AutoHangar') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-1 d-flex">
                <div class="image">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"class="img-circle elevation-2"
                            alt="User Image">
                    @else
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                </div>
                @guest
                    <div class="col info info-user">
                        <div>{{ trans('menu.Welcome') }}</div>
                        <div>
                            <a href="{{ route('login') }}" class="d-block">{{ trans('hangarauto::general.login') }}</a>
                        </div>
                    </div>
                    <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Login') }}">
                        <a href="{{ route('login') }}" class="d-block">
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
                    <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Logout') }}">
                        <a href="{{ route('logout') }}" class="d-block"
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
                        <a href="{{ route('cefa.welcome') }}"
                            class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                            <i class="nav-icon fas fa-puzzle-piece"></i>
                            <p>{{ trans('hangarauto::general.BacktoSICEFA') }}</p>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Menu Administrador-->
            @if (Route::is('hangarauto.admin.*'))
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"data-accordion="false">
                        @if (Session::has('countTecnomecanica') && Session::get('countTecnomecanica') > 0)
                        @if (Auth::user()->havePermission('hangarauto.admin.tecnomecanica.notification'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.admin.tecnomecanica.notification') }}" class="nav-link">
                                <i class="fa-solid fa-bell"> @if (Session::has('countTecnomecanica') && Session::get('countTecnomecanica') > 0)
                                    <span class="notification-badge">{{ Session::get('countTecnomecanica') }}</span>
                                @endif</i>
                                <p>
                                    Alerta Tecnomecanica
                                </p>
                            
                            </a>
                        </li>
                        @endif
                        @endif
                        @if (Session::has('countSoat') && Session::get('countSoat') > 0)
                            @if (Auth::user()->havePermission('hangarauto.admin.soat.notification'))
                            <li class="nav-item">
                                <a href="{{ route('hangarauto.admin.soat.notification') }}" class="nav-link">
                                    <i class="fa-solid fa-bell"> @if (Session::has('countSoat') && Session::get('countSoat') > 0)
                                        <span class="notification-badge">{{ Session::get('countSoat') }}</span>
                                    @endif</i>
                                    <p>
                                        Alerta Soat
                                    </p>
                                
                                </a>
                            </li>
                            @endif
                        @endif
                        <li class="nav-item {{ !Route::is('hangarauto.admin.vehicles.report.*') ?: 'menu-is-opening menu-open' }}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file"></i>
                                <p>
                                    {{trans('hangarauto::general.Parameters')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('hangarauto.admin.drivers'))
                                <li class="nav-item">
                                    <a href="{{ route('hangarauto.admin.fueltype')}}" class="nav-link">
                                        <i class="fa-solid fa-gas-pump"></i>
                                        <p>
                                            Tipo de Combustible
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('hangarauto.admin.vehicletype')}}" class="nav-link">
                                        <i class="fa-solid fa-car-burst"></i>
                                        <p>
                                            Tipo de Vehiculo
                                        </p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->havePermission('hangarauto.admin.drivers'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.drivers')}}" class="nav-link">
                                            <i class="fa-regular fa-id-card"></i>
                                            <p>
                                                {{trans('hangarauto::drivers.Drivers')}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('hangarauto.admin.vehicles'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.drivervehicles') }}" class="nav-link">
                                            <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                                            <p>
                                                {{trans('hangarauto::general.Vehicle_drivers') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('hangarauto.admin.vehicles'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.vehicles') }}" class="nav-link">
                                            <i class="fas fa-bus"></i>
                                            <p>
                                                {{trans('hangarauto::vehiculos.Vehicles')}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item {{ !Route::is('hangarauto.admin.vehicles.report.*') ?: 'menu-is-opening menu-open' }}">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <p>
                                    {{trans('hangarauto::Tecno.Maintainances')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('hangarauto.admin.tecnomecanica'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.tecnomecanica') }}" class="nav-link">
                                            <i class="fa-solid fa-screwdriver"></i>
                                            <p>
                                                {{trans('hangarauto::Tecno.Tecnomechanic')}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('hangarauto.admin.soat'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.soat') }}" class="nav-link">
                                            <i class="fas fa-file-signature"></i>
                                            <p>
                                                {{trans('hangarauto::soat.Soat')}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('hangarauto.admin.consumo'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.consumo') }}" class="nav-link">
                                            <i class="fa-solid fa-gas-pump"></i>
                                            <p>
                                                {{trans('hangarauto::comsuption.fuelcomsuption')}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('hangarauto.admin.check'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.check') }}" class="nav-link">
                                            <i class="fas fa-file-signature"></i>
                                            <p>
                                                {{ trans('hangarauto::general.Check')}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @if (Auth::user()->havePermission('hangarauto.admin.petitions'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.admin.petitions') }}" class="nav-link">
                                <i class="fa-solid fa-envelope-open"></i>
                                <p>
                                    {{ trans('hangarauto::general.Requests')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item {{ !Route::is('hangarauto.admin.vehicles.report.*') ?: 'menu-is-opening menu-open' }}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file"></i>
                                <p>
                                    {{trans('hangarauto::Vehiculos.Reports')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('hangarauto.admin.vehicles.report.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('hangarauto.admin.vehicles.report.index') }}" class="nav-link ">
                                            <i class="fa-solid fa-car-on"></i>
                                            <p>{{trans('hangarauto::Vehiculos.Vehicle')}}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
            @endif
            <!-- Sidebar Menu Encargado -->
            @if (Route::is('hangarauto.charge.*'))
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Session::has('countTecnomecanica') && Session::get('countTecnomecanica') > 0)
                        @if (Auth::user()->havePermission('hangarauto.charge.tecnomecanica.notification'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.tecnomecanica.notification') }}" class="nav-link">
                                <i class="fa-solid fa-bell"> @if (Session::has('countTecnomecanica') && Session::get('countTecnomecanica') > 0)
                                    <span class="notification-badge">{{ Session::get('countTecnomecanica') }}</span>
                                @endif</i>
                                <p>
                                    Alerta Tecnomecanica
                                </p>
                            
                            </a>
                        </li>
                        @endif
                    @endif
                    @if (Session::has('countSoat') && Session::get('countSoat') > 0)
                        @if (Auth::user()->havePermission('hangarauto.charge.soat.notification'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.soat.notification') }}" class="nav-link">
                                <i class="fa-solid fa-bell"> @if (Session::has('countSoat') && Session::get('countSoat') > 0)
                                    <span class="notification-badge">{{ Session::get('countSoat') }}</span>
                                @endif</i>
                                <p>
                                    Alerta Soat
                                </p>
                            
                            </a>
                        </li>
                        @endif
                    @endif
                        @if (Auth::user()->havePermission('hangarauto.charge.tecnomecanica'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.tecnomecanica') }}" class="nav-link">
                                <i class="fa-solid fa-screwdriver"></i>
                                <p>
                                    {{trans('hangarauto::Tecno.Tecnomechanic')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->havePermission('hangarauto.charge.soat'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.soat') }}" class="nav-link">
                                <i class="fas fa-file-signature"></i>
                                <p>
                                    {{trans('hangarauto::soat.Soat')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->havePermission('hangarauto.charge.consumo'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.consumo') }}" class="nav-link">
                                <i class="fa-solid fa-gas-pump"></i>
                                <p>
                                    {{trans('hangarauto::comsuption.fuelcomsuption')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->havePermission('hangarauto.charge.petitions'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.petitions') }}" class="nav-link">
                                <i class="fa-solid fa-envelope-open"></i>
                                <p>
                                    {{ trans('hangarauto::general.Requests')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->havePermission('hangarauto.charge.check'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.charge.check') }}" class="nav-link">
                                <i class="fas fa-file-signature"></i>
                                <p>
                                    {{ trans('hangarauto::general.Check')}}
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            @endif
            <!-- Sidebar Menu Conductor -->
            @if (Route::is('hangarauto.driver.*'))
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->havePermission('hangarauto.driver.vehicles.report.index'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.driver.vehicles.report.index') }}" class="nav-link ">
                                <i class="fa-solid fa-car-on"></i>
                                <p>
                                    {{ trans('hangarauto::drivers.Vehicle_Report')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->havePermission('hangarauto.driver.petitions'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.driver.petitions') }}" class="nav-link">
                                <i class="fa-solid fa-envelope-open"></i>
                                <p>
                                    {{ trans('hangarauto::drivers.Assigned_Routes')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->havePermission('hangarauto.driver.check'))
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.driver.check') }}" class="nav-link">
                                <i class="fas fa-file-signature"></i>
                                <p>
                                    {{ trans('hangarauto::general.Check')}}
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('hangarauto.driver.consumo') }}" class="nav-link">
                                <i class="fa-solid fa-gas-pump"></i>
                                <p>
                                    {{trans('hangarauto::comsuption.fuelcomsuption')}}
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
            @if (Route::is('cefa.*'))
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Menú de opciones públicas -->
                    <li class="nav-item">
                        <a href="{{ route('cefa.parking.table') }}" class="nav-link">
                            <i class="fas fa-check-square"></i>
                            <p>
                                {{trans('hangarauto::solicitar.Request_Vehicle')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.hangarauto.developers') }}" class="nav-link">
                            <i class="fa-solid fa-people-group"></i>
                            <p>
                                {{ trans('hangarauto::Developers.developers')}}
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            @endif
            
            
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
