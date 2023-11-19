<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('cefa.senaempresa.index') }}" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">Sena Empresa</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset(Auth::user()->person->avatar) }}" class="img-circle elevation-2"
                            alt="User Image">
                    @else
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
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
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Route::is('cefa.senaempresa.*'))
                    <li class="nav-item">
                        <a href="{{ route('cefa.senaempresa.index') }}"
                            class="nav-link {{ !Route::is('cefa.senaempresa.index') ?: 'active' }}">
                            <i class="fas fa-home"></i>
                            <p>
                                {{ trans('senaempresa::menu.Home') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cefa.senaempresa.developers') }}"
                            class="nav-link {{ !Route::is('cefa.senaempresa.developers') ?: 'active' }}">
                            <i class="fas fa-laptop-code"></i>
                            <p>
                                {{ trans('senaempresa::menu.Developers') }}
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
                        <a href="{{ route('cefa.senaempresa.seleccionados') }}"
                            class="nav-link {{ !Route::is('cefa.senaempresa.seleccionados') ?: 'active' }}">
                            <i class="fas fa-check-double"></i>
                            <p>{{ trans('senaempresa::menu.Selected') }}</p>
                        </a>
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
                @endif

                {{-- Menú de opciones para Administrador Senaempresa --}}
                @if (Route::is('senaempresa.admin.*'))
                    @if (Auth::user()->havePermission('senaempresa.admin.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.admin.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.admin.index') ?: 'active' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <p> {{ trans('sica::menu.Dashboard') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.attendances.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.admin.attendances.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.admin.attendances.index') ?: 'active' }}">
                                <i class="fas fa-users-cog"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Attendance') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.phases'))
                        <li
                            class="nav-item {{ Route::is('senaempresa.admin.phases.index', 'senaempresa.admin.phases.show_associates', 'senaempresa.admin.staff.index') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ !Route::is('senaempresa.admin.phases.*') ?: 'active' }}">
                                <i class="fas fa-chess-rook"></i>
                                <p>SenaEmpresa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('senaempresa.admin.phases.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.phases.index') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.phases.index') ?: 'active' }}">
                                            <i class="fas fa-chess-rook"></i>
                                            <p>
                                                {{ trans('senaempresa::menu.Strategies') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('senaempresa.admin.phases.show_associates'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.phases.show_associates') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.phases.show_associates') ?: 'active' }}">
                                            <i class="fas fa-file-invoice"></i>
                                            <p>{{ trans('senaempresa::menu.Courses SenaEmpresa') }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('senaempresa.admin.staff.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.staff.index') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.staff.index') ?: 'active' }}">
                                            <i class="fas fa-users-cog"></i>
                                            <p>
                                                {{ trans('senaempresa::menu.Staff') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.vacancies'))
                        <li
                            class="nav-item {{ Route::is('senaempresa.admin.vacancies.index', 'senaempresa.admin.vacancies.partner_course', 'senaempresa.admin.positions.index') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ !Route::is('senaempresa.admin.vacancies.*') ?: 'active' }}">
                                <i class="fas fa-id-card"></i>
                                <p>{{ trans('senaempresa::menu.Vacancies') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('senaempresa.admin.vacancies.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.vacancies.index') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.vacancies.index') ?: 'active' }}">
                                            <i class="fas fa-user-tag"></i>
                                            <p>{{ trans('senaempresa::menu.Availables') }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('senaempresa.admin.vacancies.partner_course'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.vacancies.partner_course') }}"
                                            class="nav-link {{ Route::is('senaempresa.admin.vacancies.partner_course') ? 'active' : '' }}">
                                            <i class="fas fa-file-invoice"></i>
                                            <p>{{ trans('senaempresa::menu.Courses Vacancies') }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.positions.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.admin.positions.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.admin.positions.index') ?: 'active' }}">
                                <i class="fas fa-user-plus"></i>
                                <p>{{ trans('senaempresa::menu.Positions') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.postulates'))
                        <li
                            class="nav-item {{ !Route::is('senaempresa.admin.postulates.*') ?: 'menu-is-opening menu-open' }}">
                            <a href="#"
                                class="nav-link {{ !Route::is('senaempresa.admin.postulates.*') ?: 'active' }}">
                                <i class="fas fa-vote-yea"></i>
                                <p>{{ trans('senaempresa::menu.Postulates') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('senaempresa.admin.postulates.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.postulates.index') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.postulates.index') ?: 'active' }}">
                                            <i class="fas fa-address-card"></i>
                                            <p>{{ trans('senaempresa::menu.Postulates') }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.loans.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.admin.loans.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.admin.loans.index') ?: 'active' }}">
                                <i class="fas fa-poll"></i>
                                <p>{{ trans('senaempresa::menu.Loans') }}</p>
                            </a>
                        </li>
                    @endif
                @endif



                {{-- Menú de opciones para Pasante Senaempresa --}}
                @if (Route::is('senaempresa.pasante.*'))
                    <li class="nav-item">
                        <a href="{{ route('senaempresa.pasante.index') }}"
                            class="nav-link {{ !Route::is('senaempresa.pasante.index') ?: 'active' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <p> {{ trans('sica::menu.Dashboard') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company.asistencia') }}"
                            class="nav-link {{ !Route::is('company.asistencia') ?: 'active' }}">
                            <i class="fas fa-users-cog"></i>
                            <p>
                                {{ trans('senaempresa::menu.Attendance') }}
                            </p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ Route::is('company.senaempresa.senaempresa', 'company.senaempresa.courses_senaempresa', 'company.senaempresa.personal') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ !Route::is('senaempresa.*') ?: 'active' }}">
                            <i class="fas fa-chess-rook"></i>
                            <p>SenaEmpresa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('company.senaempresa.senaempresa') }}"
                                    class="nav-link {{ !Route::is('company.senaempresa.senaempresa') ?: 'active' }}">
                                    <i class="fas fa-chess-rook"></i>
                                    <p>
                                        {{ trans('senaempresa::menu.Strategies') }}
                                    </p>
                                </a>
                            </li>
                            @if (checkRol('senaempresa.admin'))
                                <li class="nav-item">
                                    <a href="{{ route('company.senaempresa.courses_senaempresa') }}"
                                        class="nav-link {{ !Route::is('company.senaempresa.courses_senaempresa') ?: 'active' }}">
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
                    <li
                        class="nav-item {{ Route::is('company.vacant.vacantes', 'inscription', 'company.position.cargos', 'company.vacant.mostrar_asociados') ? 'menu-is-opening menu-open' : '' }}">
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
                            @if (checkRol('senaempresa.admin'))
                                <li class="nav-item">
                                    <a href="{{ route('company.vacant.mostrar_asociados') }}"
                                        class="nav-link {{ Route::is('company.vacant.mostrar_asociados') ? 'active' : '' }}">
                                        <i class="fas fa-file-invoice"></i>
                                        <p>{{ trans('senaempresa::menu.Courses Vacancies') }}</p>
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
                        <a href="{{ route('company.loan.prestamos') }}"
                            class="nav-link {{ !Route::is('company.loan.prestamos') ?: 'active' }}">
                            <i class="fas fa-poll"></i>
                            <p>{{ trans('senaempresa::menu.Loans') }}</p>
                        </a>
                    </li>

                @endif

                {{-- Menú de opciones para Usuario Senaempresa --}}
                @if (Route::is('senaempresa.usuario.*'))
                    <li class="nav-item">
                        <a href="{{ route('senaempresa.usuario.index') }}"
                            class="nav-link {{ !Route::is('senaempresa.usuario.index') ?: 'active' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <p> {{ trans('sica::menu.Dashboard') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company.asistencia') }}"
                            class="nav-link {{ !Route::is('company.asistencia') ?: 'active' }}">
                            <i class="fas fa-users-cog"></i>
                            <p>
                                {{ trans('senaempresa::menu.Attendance') }}
                            </p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ Route::is('company.senaempresa.senaempresa', 'company.senaempresa.courses_senaempresa', 'company.senaempresa.personal') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ !Route::is('senaempresa.*') ?: 'active' }}">
                            <i class="fas fa-chess-rook"></i>
                            <p>SenaEmpresa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('company.senaempresa.senaempresa') }}"
                                    class="nav-link {{ !Route::is('company.senaempresa.senaempresa') ?: 'active' }}">
                                    <i class="fas fa-chess-rook"></i>
                                    <p>
                                        {{ trans('senaempresa::menu.Strategies') }}
                                    </p>
                                </a>
                            </li>
                            @if (checkRol('senaempresa.admin'))
                                <li class="nav-item">
                                    <a href="{{ route('company.senaempresa.courses_senaempresa') }}"
                                        class="nav-link {{ !Route::is('company.senaempresa.courses_senaempresa') ?: 'active' }}">
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
                    <li
                        class="nav-item {{ Route::is('company.vacant.vacantes', 'inscription', 'company.position.cargos', 'company.vacant.mostrar_asociados') ? 'menu-is-opening menu-open' : '' }}">
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
                            @if (checkRol('senaempresa.admin'))
                                <li class="nav-item">
                                    <a href="{{ route('company.vacant.mostrar_asociados') }}"
                                        class="nav-link {{ Route::is('company.vacant.mostrar_asociados') ? 'active' : '' }}">
                                        <i class="fas fa-file-invoice"></i>
                                        <p>{{ trans('senaempresa::menu.Courses Vacancies') }}</p>
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
                        <a href="{{ route('company.loan.prestamos') }}"
                            class="nav-link {{ !Route::is('company.loan.prestamos') ?: 'active' }}">
                            <i class="fas fa-poll"></i>
                            <p>{{ trans('senaempresa::menu.Loans') }}</p>
                        </a>
                    </li>

                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
