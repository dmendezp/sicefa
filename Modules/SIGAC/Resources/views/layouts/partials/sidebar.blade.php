<div class="sidebar-color">
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/sidebar.css')}}">
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
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                            alt="User Image">
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
                    <!-- Menú de opciones públicas -->
                    @if (Route::is('cefa.sigac*'))
                        <li class="nav-item">
                            <a href="{{ route('cefa.sigac.index') }}"
                                class="nav-link {{ !Route::is('cefa.sigac.index*') ?: 'active' }}">
                                <i class="nav-icon fa-solid fa-school"></i>
                                <p>{{ trans('sigac::general.MainPage') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('cefa.sigac.info') }}"
                                class="nav-link {{ !Route::is('cefa.sigac.info*') ?: 'active' }}">
                                <i class="nav-icon fas fa-info"></i>
                                <p>{{ trans('sigac::general.About us') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cefa.sigac.devs') }}"
                                class="nav-link {{ !Route::is('cefa.sigac.devs*') ?: 'active' }}">
                                <i class="nav-icon fa-solid fa-code"></i>
                                <p>{{ trans('sigac::general.Developers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cefa.sigac.programming.index') }}"
                                class="nav-link {{ !Route::is('cefa.sigac.programming.index*') ?: 'active' }}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>{{ trans('sigac::general.Scheduling') }}</p>
                            </a>
                        </li>
                    @endif

                    <!-- Menú de opciones para coordinación académica -->
                    @if (Route::is('sigac.academic_coordination.*'))
                        @if (Auth::user()->havePermission('sigac.academic_coordination.dashboard'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Comites
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Reporte novedades</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-book-reader"></i>
                                            <p>Resultado Comite</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-clock"></i>
                                <p>
                                    {{ trans('sigac::general.Programming') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items" style="display: none;">
                                @if (Auth::user()->havePermission('sigac.academic_coordination.programming.parameters.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.programming.parameters.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-th-large"></i>
                                            <p>Parametros</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('sigac.academic_coordination.programming.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.programming.index') }}"
                                            class="nav-link {{ !Route::is('sigac.academic_coordination.programming.*') ?: 'active' }}">
                                            <i class="nav-icon fas fa-calendar-alt"></i>
                                            <p>{{ trans('sigac::general.Scheduling') }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('sigac.academic_coordination.programming.management.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.programming.management.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-user-tie"></i>
                                            <p>Gestion</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('sigac.academic_coordination.programming.external_activities.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.programming.external_activities.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-graduation-cap"></i>
                                            <p>Actividades Externas</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->havePermission('sigac.academic_coordination.programming.management.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.programming.program_request.table') }}" class="nav-link">
                                            <i class="nav-icon fas fa-user-tie"></i>
                                            <p>Solicitud Programa</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @if (Auth::user()->havePermission('sigac.academic_coordination.programming.management.index'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        Asistencias
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items" style="display: none;">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-address-card"></i>
                                            <p>Seguimientos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-folder-open"></i>
                                            <p>Excusas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-paste"></i>
                                            <p>Reportes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-people-carry"></i>
                                    <p>
                                        Talento Humano
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items" style="display: none;">
                                    @if (Auth::user()->havePermission('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))
                                        <li class="nav-item">
                                            <a href="{{ route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index') }}" class="nav-link">
                                                <i class="nav-icon fas fa-th-large"></i>
                                                <p>Gestion Instructores</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->havePermission('sigac.academic_coordination.human_talent.assign_learning_outcomes.index'))
                                        <li class="nav-item">
                                            <a href="{{route('sigac.academic_coordination.human_talent.assign_learning_outcomes.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-user-plus"></i>
                                                <p>Instructor x Rap</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        
                        @if (Auth::user()->havePermission('sigac.academic_coordination.curriculum_planning.training_project.index'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-calendar"></i>
                                    <p>
                                        Planeacion curricular
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items" style="display: none;">
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tags"></i>
                                            <p>Profesión x Co</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.competencie_class.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-square-poll-vertical"></i>
                                            <p>Ambiente x Co</p>
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.course_trainig_project.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tags"></i>
                                            <p>Cu x Proyecto Formativo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.training_project.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-users-cog"></i>
                                            <p>Proyecto formativo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.evaluative_judgment.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-address-card"></i>
                                            <p>Juicio Evaluativo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                       
                        @if (Auth::user()->havePermission('sigac.academic_coordination.curriculum_planning.training_project.index'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-hand-paper"></i>
                                    <p>
                                        Control Ambientes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items" style="display: none;">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-pen-fancy"></i>
                                            <p>Novedad</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-pen-fancy"></i>
                                            <p>Verificacion Inventario</p>
                                        </a>
                                    </li>
                                    
        
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Reportes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items">
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.reports.quartelies.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Trimestralización</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.reports.environments.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Ambientes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.reports.instructors.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Instructores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.reports.active_courses.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Fichas Activas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif

                    <!-- Menú de opciones para Instructor -->
                    @if (Route::is('sigac.instructor.*'))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-clock"></i>
                                <p>
                                    {{ trans('sigac::general.Programming') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items" style="display: none;">
                                @if (Auth::user()->havePermission('sigac.instructor.programming.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.instructor.programming.index') }}"
                                            class="nav-link {{ !Route::is('sigac.instructor.programming.*') ?: 'active' }}">
                                            <i class="nav-icon far fa-calendar-alt"></i>
                                            <p>{{ trans('sigac::general.Scheduling') }}</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('sigac.instructor.programming.program_request.table') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user-tie"></i>
                                        <p>Solicitud Programa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Asistencias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items" style="display: none;">
                                @if (Auth::user()->havePermission('sigac.instructor.attendances.attendance.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.instructor.attendances.attendance.index') }}"
                                            class="nav-link {{ !Route::is('sigac.instructor.attendances.attendance.index*') ?: 'active' }}">
                                            <i class="nav-icon fas fa-user-check"></i>
                                            <p>{{ trans('sigac::general.AttendanceRegister') }}</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-address-card"></i>
                                        <p>Seguimientos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-folder-open"></i>
                                        <p>Excusas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-paste"></i>
                                        <p>Reportes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-paper"></i>
                                <p>
                                    Control ambientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('sigac.instructor.environmentcontrol.assign_environment_warehouse.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-pen-fancy"></i>
                                        <p>Bodega x Ambiente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sigac.instructor.environmentcontrol.environment_inventory_movement.entrance.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-pen-fancy"></i>
                                        <p>Entrada Inventario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-pen-fancy"></i>
                                        <p>Movimiento Inventario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-pen-fancy"></i>
                                        <p>Novedad</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sigac.instructor.environmentcontrol.environment_inventory_movement.check.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-pen-fancy"></i>
                                        <p>Verificacion Inventario</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Comites
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>Reporte novedades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-book-reader"></i>
                                        <p>Resultado Comite</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Reportes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items">
                                <li class="nav-item">
                                    <a href="{{ route('sigac.instructor.reports.quartelies.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>Trimestralización</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- Menú de opciones para Bienestar -->
                    @if (Route::is('sigac.wellness.*'))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Comites
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>Reporte Novedades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-book-reader"></i>
                                        <p>Resultado Comite</p>
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
                            <ul class="nav nav-treeview items" style="display: none;">
                                @if (Auth::user()->havePermission('sigac.wellness.programming.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.wellness.programming.index') }}"
                                            class="nav-link {{ !Route::is('sigac.wellness.programming.*') ?: 'active' }}">
                                            <i class="nav-icon far fa-calendar-alt"></i>
                                            <p>{{ trans('sigac::general.Scheduling') }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->havePermission('sigac.wellness.programming.external_activities.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.wellness.programming.external_activities.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-graduation-cap"></i>
                                            <p>Actividades Externas</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Asistencias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items" style="display: none;">
                                @if (Auth::user()->havePermission('sigac.academic_coordination.reports.attendance.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('sigac.academic_coordination.reports.attendance.index') }}"
                                            class="nav-link"
                                            {{ !Route::is('sigac.academic_coordination.reports.attendance.*') ?: 'active' }}>
                                            <i class="nav-icon fa-solid fa-chart-line"></i>
                                            <p>Reportes</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Menú de opciones para Aprendiz -->
                    @if (Route::is('sigac.apprentice.*'))
                        @if (Auth::user()->havePermission('sigac.apprentice.programming.index'))
                            <li class="nav-item">
                                <a href="{{ route('sigac.apprentice.programming.index') }}"
                                    class="nav-link {{ !Route::is('sigac.apprentice.programming.*') ?: 'active' }}">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>{{ trans('sigac::general.Scheduling') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('sigac.apprentice.apprentice'))
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa-solid fa-star"></i>
                                    <p>Consultar Asistencia</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('sigac.apprentice.excuses.send'))
                            <li class="nav-item">
                                <a href="{{ route('sigac.apprentice.excuses.send') }}"
                                    class="nav-link {{ !Route::is('sigac.apprentice.excuses.send.*') ?: 'active' }}">
                                    <i class="nav-icon fa-solid fa-paper-plane"></i>
                                    <p>{{ trans('sigac::general.SendExcuses') }}</p>
                                </a>
                            </li>
                        @endif
                    @endif
                    <!-- Menú de opciones para Aprendiz -->
                    @if (Route::is('sigac.support.*'))
                        @if (Auth::user()->havePermission('sigac.support.programming.program_request.characterization.index'))
                            <li class="nav-item">
                                <a href="{{ route('sigac.support.programming.program_request.characterization.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-star"></i>
                                    <p>Caracterización</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->havePermission('sigac.support.programming.index'))
                            <li class="nav-item">
                                <a href="{{ route('sigac.support.programming.index') }}"
                                    class="nav-link {{ !Route::is('sigac.programming.*') ?: 'active' }}">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>{{ trans('sigac::general.Scheduling') }}</p>
                                </a>
                            </li>
                        @endif
                    @endif
                    @if (Route::is('sigac.securitystaff.*'))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Control Ambientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items">
                                <li class="nav-item">
                                    <a href="{{  route('sigac.securitystaff.environmentcontrol.environment_inventory_movement.check.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>Verificar Ambiente</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <!-- Menú de opciones para Aprendiz -->
                    @if (Route::is('sgac.committee_leader.*'))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Comites
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview items">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>Reporte novedades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-user-edit"></i>
                                        <p>Citar comite</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-book-reader"></i>
                                        <p>Resultado Comite</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </aside>
</div>

