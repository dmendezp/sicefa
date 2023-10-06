<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">

    <!-- Brand Logo -->
    <a href="{{ route('senamepresa.index') }}" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">Sena Empresa</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2"
                            alt="User Image">
                    @else
                        <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                </div>
                @guest
                    <div class="col info info-user">
                        <div>{{ trans('senaempresa::menu.Welcome') }}</div>
                        <div><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block"><i
                                class="fas fa-sign-in-alt"></i></a>
                    </div>
                @else
                    <div class="col info info-user">
                        <div data-toggle="tooltip" data-placement="top"
                            title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                            {{ Auth::user()->nickname }}</div>
                        <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block"
                            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i
                                class="fas fa-sign-out-alt"></i></a>
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
                            <i class="nav-icon fas fa-puzzle-piece"></i>
                            <p>
                                {{ trans('sica::menu.Back to') }} {{ env('APP_NAME') }}
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
                    <a href="{{ route('senamepresa.index') }}"
                        class="nav-link {{ !Route::is('senamepresa.index') ?: 'active' }}">
                        <i class="fas fa-home"></i>
                        <p>
                            {{ trans('senaempresa::menu.Home') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-vr-cardboard"></i>
                        <p>WIX
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cefa.Nosotros') }}"
                                class="nav-link {{ !Route::is('cefa.Nosotros') ?: 'active' }}">
                                <i class="fas fa-users"></i>
                                <p>
                                    {{ trans('senaempresa::menu.We') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-vr-cardboard"></i>
                        <p>Asistencia
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('company.asistencia') }}"
                                class="nav-link {{ !Route::is('company.asistencia') ?: 'active' }}">
                                <i class="fas fa-users"></i>
                                <p>
                                    Asistencia
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ !Route::is('senaempresa.*') ?: 'menu-is-opening menu-open' }}">
                    <a href="#" class="nav-link {{ !Route::is('senaempresa.*') ?: 'active' }}">
                        <i class="fas fa-chess-rook"></i>
                        <p>SenaEmpresa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('company.senaempresa') }}"
                                class="nav-link {{ !Route::is('company.senaempresa') ?: 'active' }}">
                                <i class="fas fa-chess-rook"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Strategies') }}
                                </p>
                            </a>
                        </li>
                        @if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa')
                            <li class="nav-item">
                                <a href="{{ route('company.senaempresa.mostrar_asociados_senaempresa') }}"
                                    class="nav-link {{ !Route::is('company.senaempresa.mostrar_asociados_senaempresa') ?: 'active' }}">
                                    <i class="fas fa-file-invoice"></i>
                                    <p>{{ trans('senaempresa::menu.Courses SenaEmpresa') }}</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('company.senaempresa.personal') }}"
                                class="nav-link {{ !Route::is('company.senaempresa.personal') ?: 'active' }}">
                                <i class="fas fa-users-cog"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Staff') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ !Route::is('vacant.*') ?: 'menu-is-opening menu-open' }}">
                    <a href="#" class="nav-link {{ !Route::is('vacant.*') ?: 'active' }}">
                        <i class="fas fa-id-card"></i>
                        <p>{{ trans('senaempresa::menu.Vacancies') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('company.vacant.vacantes') }}"
                                class="nav-link {{ !Route::is('company.vacant.vacantes') ?: 'active' }}">
                                <i class="fas fa-user-tag"></i>
                                <p>{{ trans('senaempresa::menu.Availables') }}</p>
                            </a>
                        </li>
                        @if (auth()->user()->person->apprentices())
                            <li class="nav-item">
                                <a href="{{ route('inscription') }}"
                                    class="nav-link {{ !Route::is('inscription') ?: 'active' }}">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <p>{{ trans('senaempresa::menu.Registration') }}</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('company.position.cargos') }}"
                                class="nav-link {{ !Route::is('company.position.cargos') ?: 'active' }}">
                                <i class="fas fa-user-plus"></i>
                                <p>{{ trans('senaempresa::menu.Positions') }}</p>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa')
                            <li class="nav-item">
                                <a href="{{ route('company.vacant.mostrar_asociados') }}"
                                    class="nav-link {{ Route::is('company.vacant.mostrar_asociados') ? 'active' : '' }}">
                                    <i class="fas fa-file-invoice"></i>
                                    <p>{{ trans('senaempresa::menu.Courses Vacancies') }}</p>
                                </a>
                            </li>
                        @endif


                    </ul>
                </li>
                <li class="nav-item {{ !Route::is('entrevistas.*') ?: 'menu-is-opening menu-open' }}">
                    <a href="#" class="nav-link {{ !Route::is('entrevistas.*') ?: 'active' }}">
                        <i class="fas fa-vote-yea"></i>
                        <p>{{ trans('senaempresa::menu.Postulates') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('company.postulate') }}"
                                class="nav-link {{ !Route::is('company.postulate') ?: 'active' }}">
                                <i class="fas fa-address-card"></i>
                                <p>{{ trans('senaempresa::menu.Postulates') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cefa.seleccionados') }}"
                                class="nav-link {{ !Route::is('cefa.seleccionados') ?: 'active' }}">
                                <i class="fas fa-check-double"></i>
                                <p>{{ trans('senaempresa::menu.Selected') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <p>{{ trans('senaempresa::menu.Loans') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('company.loan.prestamos') }}"
                                class="nav-link {{ !Route::is('company.loan.prestamos') ?: 'active' }}">
                                <i class="fas fa-poll"></i>
                                <p>{{ trans('senaempresa::menu.Registrants') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Turnos
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>

                    @guest
                    <li class="nav-item">
                        <a href="{{ route('calendarTurno.home') }}"
                            class="nav-link {{ !Route::is('calendarTurno.home') ?: 'active' }}">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Turnos por Calendario</p>
                        </a>
                    </li>
                @else
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->havePermission('senaempresa.turnosRutinarios'))
                            <li class="nav-item">
                                <a href="{{ route('turnosRutinarios') }}"
                                    class="nav-link {{ !Route::is('turnosRutinarios') ?: 'active' }}">
                                    <i class="nav-icon fas fa-people-carry"></i>
                                    <p>Turnos Rutinarios</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('calendarTurno.home') }}"
                                class="nav-link {{ !Route::is('calendarTurno.home') ?: 'active' }}">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Turnos por Calendario</p>
                            </a>
                        </li>
                        @if (Auth::user()->havePermission('senaempresa.fingerPrint.home'))
                            <li class="nav-item">
                                <a href="{{ route('fingerPrint.home') }}"
                                    class="nav-link {{ !Route::is('fingerPrint.home') ?: 'active' }}">
                                    <i class="nav-icon far fa-id-card"></i>
                                    <p>Turnos Sena Empresa</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                    </li>
                    @if (Auth::user()->havePermission('senaempresa.work.index'))
                        <li class="nav-item">
                            <a href="{{ route('work.index') }}"
                                class="nav-link {{ !Route::is('work.index') ?: 'active' }}">
                                <i class="nav-icon fas fa-hammer"></i>
                                <p>
                                    Works
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                    @endif

                @endguest
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
