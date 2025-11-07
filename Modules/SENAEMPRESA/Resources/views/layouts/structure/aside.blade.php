<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('cefa.senaempresa.index') }}" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">SENA Empresa</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2"
                            alt="User Image">
                    @else
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                </div>
                @guest
                    <div class="col info info-user">
                        <div>{{ trans('senaempresa::menu.Welcome') }}</div>
                        <div><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Login') }}"><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block"><i
                                class="fas fa-sign-in-alt"></i></a>
                    </div>
                @else
                    <div class="col info info-user">
                        <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->full_name }}">
                            {{ Auth::user()->nickname }}
                        </div>
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
                                {{ trans('senaempresa::menu.Back to SICEFA') }}
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
                            <p>Estrategia
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('cefa.senaempresa.nosotros') }}"
                                    class="nav-link {{ !Route::is('cefa.senaempresa.nosotros') ?: 'active' }}">
                                    <i class="fas fa-users"></i>
                                    <p>
                                        {{ trans('senaempresa::menu.We') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
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
                    @if (Auth::user()->havePermission('senaempresa.admin.phases'))
                        <li
                            class="nav-item {{ Route::is('senaempresa.admin.phases.index', 'senaempresa.admin.phases.show_associates', 'senaempresa.admin.staff.index', 'senaempresa.admin.attendances.index') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ !Route::is('senaempresa.admin.phases.*') ?: 'active' }}">
                                <i class="fas fa-chess-rook"></i>
                                <p>SENA Empresa
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
                                                {{ trans('senaempresa::menu.Phases') }}
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
                                            <i class="fas fa-id-card-alt"></i>
                                            <p>
                                                {{ trans('senaempresa::menu.Staff') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('senaempresa.admin.attendances.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.attendances.index') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.attendances.index') ?: 'active' }}">
                                            <i class="fas fa-tasks"></i>
                                            <p>
                                                {{ trans('senaempresa::menu.Attendance') }}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.admin.vacancies'))
                        <li
                            class="nav-item {{ Route::is('senaempresa.admin.vacancies.index', 'senaempresa.admin.vacancies.partner_course') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ !Route::is('senaempresa.admin.vacancies.*') ?: 'active' }}">
                                <i class="fas fa-id-card"></i>
                                <p>{{ trans('senaempresa::menu.Vacancies') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->havePermission('senaempresa.admin.positions.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.positions.index') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.positions.index') ?: 'active' }}">
                                            <i class="fas fa-users-cog"></i>
                                            <p>{{ trans('senaempresa::menu.Positions') }}</p>
                                        </a>
                                    </li>
                                @endif
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
                                @if (Auth::user()->havePermission('senaempresa.admin.postulates.selected'))
                                    <li class="nav-item">
                                        <a href="{{ route('senaempresa.admin.postulates.selected') }}"
                                            class="nav-link {{ !Route::is('senaempresa.admin.postulates.selected') ?: 'active' }}">
                                            <i class="fas fa-check-double"></i>
                                            <p>{{ trans('senaempresa::menu.Selected') }}</p>
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
                    @if (Auth::user()->havePermission('senaempresa.admin.loans.inventory'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.admin.loans.inventory') }}"
                                class="nav-link {{ !Route::is('senaempresa.admin.loans.inventory') ?: 'active' }}">
                                <i class="fas fa-boxes"></i>
                                <p>{{ trans('senaempresa::menu.Inventory') }}</p>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Menú de opciones para Lider talento humano Senaempresa --}}
                @if (Route::is('senaempresa.human_talent_leader.*'))
                    @if (Auth::user()->havePermission('senaempresa.human_talent_leader.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.human_talent_leader.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.human_talent_leader.index') ?: 'active' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <p> {{ trans('sica::menu.Dashboard') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.human_talent_leader.attendances.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.human_talent_leader.attendances.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.human_talent_leader.attendances.index') ?: 'active' }}">
                                <i class="fas fa-tasks"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Attendance') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.human_talent_leader.staff.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.human_talent_leader.staff.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.human_talent_leader.staff.index') ?: 'active' }}">
                                <i class="fas fa-users-cog"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Staff') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.human_talent_leader.loans.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.human_talent_leader.loans.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.human_talent_leader.loans.index') ?: 'active' }}">
                                <i class="fas fa-poll"></i>
                                <p>{{ trans('senaempresa::menu.Loans') }}</p>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Menú de opciones para Psicologo Senaempresa --}}
                @if (Route::is('senaempresa.psychologo.*'))
                    @if (Auth::user()->havePermission('senaempresa.psychologo.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.psychologo.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.psychologo.index') ?: 'active' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <p> {{ trans('sica::menu.Dashboard') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.psychologo.postulates.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.psychologo.postulates.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.psychologo.postulates.index') ?: 'active' }}">
                                <i class="fas fa-address-card"></i>
                                <p>{{ trans('senaempresa::menu.Postulates') }}</p>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Menú de opciones para Aprendiz Senaempresa --}}
                @if (Route::is('senaempresa.apprentice.*'))
                    <li class="nav-item">
                        <a href="{{ route('senaempresa.apprentice.index') }}"
                            class="nav-link {{ !Route::is('senaempresa.apprentice.index') ?: 'active' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <p> {{ trans('sica::menu.Dashboard') }}</p>
                        </a>
                    </li>
                    @if (Auth::user()->havePermission('senaempresa.apprentice.vacancies.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.apprentice.vacancies.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.apprentice.vacancies.index') ?: 'active' }}">
                                <i class="fas fa-user-tag"></i>
                                <p>{{ trans('senaempresa::menu.Vacancies') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.apprentice.staff.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.apprentice.staff.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.apprentice.staff.index') ?: 'active' }}">
                                <i class="fas fa-users-cog"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Staff') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.apprentice.loans.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.apprentice.loans.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.apprentice.loans.index') ?: 'active' }}">
                                <i class="fas fa-poll"></i>
                                <p>{{ trans('senaempresa::menu.Loans') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.apprentice.attendances.index'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.apprentice.attendances.index') }}"
                                class="nav-link {{ !Route::is('senaempresa.apprentice.attendances.index') ?: 'active' }}">
                                <i class="fas fa-tasks"></i>
                                <p>
                                    {{ trans('senaempresa::menu.Attendance') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('senaempresa.apprentice.postulates.state_apprentice'))
                        <li class="nav-item">
                            <a href="{{ route('senaempresa.apprentice.postulates.state_apprentice') }}"
                                class="nav-link {{ !Route::is('senaempresa.apprentice.postulates.state_apprentice') ?: 'active' }}">
                                <i class="far fa-address-card"></i>
                                <p>
                                    Postulaciones
                                </p>
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
