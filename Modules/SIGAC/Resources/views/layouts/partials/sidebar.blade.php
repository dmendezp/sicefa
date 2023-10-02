<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.sigac.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/sigac/images/icon/logo_sigac.png') }}" class="brand-image"
                alt="SIGAC_Logo">{{-- Icono de SIGAC --}}
            <span class="brand-text">SIGAC</span>
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
                        <a href="{{ route('login') }}" class="d-block"
                            style="text-decoration: none">{{ trans('sigac::general.Session') }}</a>
                    </div>
                    <div class="col-auto info float-right ">
                        <a href="{{ route('login') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="{{ trans('sigac::general.InSession') }}">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </div>
                @else
                    <div class="col info info-user">
                        <div data-toggle="tooltip" data-placement="top"
                            title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                            <div style="color:white">{{ Auth::user()->nickname }}</div>
                        </div>
                        <div class="small" style="color:white">
                            <em> {{ Auth::user()->roles[0]->name }}</em>
                        </div>
                    </div>
                    <div class="col-auto info float-right mt-2">
                        <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="{{ trans('sigac::general.ExitSession') }}"
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
                            <p>{{ trans('sigac::general.Back to SICEFA') }}</p>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.index') }}" class="nav-link {{ !Route::is('cefa.sigac.index*') ?: 'active' }}">
                            <i class="nav-icon fa-solid fa-school"></i>
                            <p>{{ trans('sigac::general.Home') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.attendance.register') }}" class="nav-link {{ !Route::is('cefa.sigac.attendance.register*') ?: 'active' }}">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>{{ trans('sigac::general.Attendance Register') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.instructor.index')}}" class="nav-link {{ !Route::is('cefa.sigac.instructor.index*') ?: 'active' }}">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>{{ trans('sigac::general.Instructor Management') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-calendar-days"></i>
                            <p>
                                {{ trans('sigac::general.Schedules') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('cefa.sigac.scheduleInstructor.index') }}" class="nav-link {{ !Route::is('cefa.sigac.scheduleInstructor.index*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-user-clock"></i>
                                    <p>{{ trans('sigac::general.Schedule Instructor') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cefa.sigac.scheduleApprentice.index')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-user-graduate"></i>
                                    <p>{{ trans('sigac::general.Schedule Apprentice') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-clock"></i>
                            <p>
                                {{ trans('sigac::general.Programming') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('cefa.sigac.scheduleProgramInstructor.index') }}" class="nav-link {{ !Route::is('cefa.sigac.scheduleProgramInstructor.index*') ?: 'active' }}">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>{{ trans('sigac::general.Schedule Programming') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cefa.sigac.scheduleProgramEnvironment.index') }}" class="nav-link {{ !Route::is('cefa.sigac.scheduleProgramEnvironment.index*') ?: 'active' }}">
                                    <i class="nav-icon fas fa-chalkboard"></i>
                                    <p>{{ trans('sigac::general.Environment Programming') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-magnifying-glass"></i>
                            <p>
                                {{ trans('sigac::general.Consult') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('cefa.sigac.attendance.consult') }}" class="nav-link {{ !Route::is('cefa.sigac.attendance.consult*') ?: 'active' }}">
                                    <i class="nav-icon fa-solid fa-users-viewfinder"></i>
                                    <p>{{ trans('sigac::general.Consult Apprentice') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-folder"></i>
                                    <p>{{ trans('sigac::general.Consult Excuses') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.attendanceReports.index') }}" class="nav-link" {{ !Route::is('cefa.sigac.attendanceReports.index*') ?: 'active' }}>
                            <i class="nav-icon fa-solid fa-chart-line"></i>
                            <p>{{ trans('sigac::general.Attendance Reports') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.info') }}" class="nav-link {{ !Route::is('cefa.sigac.info*') ?: 'active' }}">
                            <i class="nav-icon fas fa-info"></i>
                            <p>{{ trans('sigac::general.About us') }}</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
