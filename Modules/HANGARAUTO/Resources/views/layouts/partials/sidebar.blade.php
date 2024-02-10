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
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('cefa.parking.drivers')}}" class="nav-link">
                            <i class="fa-regular fa-id-card"></i>
                            <p>
                                {{trans('hangarauto::drivers.Drivers')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.parking.vehicles') }}" class="nav-link">
                            <i class="fas fa-bus"></i>
                            <p>
                                {{trans('hangarauto::vehiculos.Vehicles')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.parking.tecnomecanica') }}" class="nav-link">
                            <i class="fa-solid fa-screwdriver"></i>
                            <p>
                                {{trans('hangarauto::Tecno.Tecnomecanic')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.parking.soat') }}" class="nav-link">
                            <i class="fas fa-file-signature"></i>
                            <p>
                                {{trans('hangarauto::soat.Soat')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-gas-pump"></i>
                            <p>
                                {{trans('hangarauto::comsuption.fuelcomsuption')}}
                            </p>
                        </a>
                    </li>
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
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
