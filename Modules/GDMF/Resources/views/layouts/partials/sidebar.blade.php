<div class="sidebar-color">
    <link rel="stylesheet" href="{{ asset('modules/gdmf/css/sidebar.css') }}">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.gdmf.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/gdmf/images/icon/book.svg') }}" class="brand-image"
                alt="SIGAC_Logo">{{-- Icono de SIGAC --}}
            <span class="brand-text">GDMF</span>
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
                    @if (Route::is('cefa.gdmf*'))
                        <li class="nav-item">
                            <a href="{{ route('cefa.gdmf.index') }}"
                                class="nav-link {{ !Route::is('cefa.gdmf.index*') ?: 'active' }}">
                                <i class="nav-icon fa-solid fa-school"></i>
                                <p>{{ trans('sigac::general.MainPage') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('cefa.gdmf.info') }}"
                                class="nav-link {{ !Route::is('cefa.gdmf.info*') ?: 'active' }}">
                                <i class="nav-icon fas fa-info"></i>
                                <p>{{ trans('sigac::general.About us') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cefa.gdmf.devs') }}"
                                class="nav-link {{ !Route::is('cefa.gdmf.devs*') ?: 'active' }}">
                                <i class="nav-icon fa-solid fa-code"></i>
                                <p>{{ trans('sigac::general.Developers') }}</p>
                            </a>
                        </li>
                    @endif

                    <!-- Menú de opciones para coordinación académica -->
                    @if (Route::is('gdmf.academic_coordination.*'))
                        @if (Auth::user()->havePermission('gdmf.academic_coordination.curriculum_planning.training_project.index'))
                            <li class="nav-item">
                                <a href="{{ route('gdmf.academic_coordination.annual_budget.index') }}"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>Presupuesto Anual</p>
                                </a>
                            </li>
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
                                        <a href="{{ route('gdmf.academic_coordination.curriculum_planning.training_project.index') }}"
                                            class="nav-link">
                                            <i class="nav-icon fas fa-tags"></i>
                                            <p>Proyecto Formativo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('gdmf.academic_coordination.curriculum_planning.course_trainig_project.index') }}"
                                            class="nav-link">
                                            <i class="nav-icon fas fa-tags"></i>
                                            <p>Curso x Proyecto</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('gdmf.academic_coordination.curriculum_planning.manage_materials.index') }}"
                                            class="nav-link">
                                            <i class="nav-icon fas fa-tags"></i>
                                            <p>Materiales x Proyecto</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('gdmf.academic_coordination.material_request.report') }}"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-paper-plane"></i>
                                    <p>Solicitudes Materiales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cart-shopping"></i>
                                    <p>
                                        Compra Materiales
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview items" style="display: none;">
                                    <li class="nav-item">
                                        <a href="{{ route('gdmf.academic_coordination.purchase.index') }}"
                                            class="nav-link">
                                            <i class="nav-icon fas fa-cash-register"></i>
                                            <p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('gdmf.academic_coordination.purchase.report') }}"
                                            class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Reporte</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('gdmf.academic_coordination.purchase.history_failure') }}"
                                            class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice"></i>
                                            <p>Reporte de Fallos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif

                    <!-- Menú de opciones para Instructor -->
                    @if (Route::is('gdmf.instructor.*'))
                        <li class="nav-item">
                            <a href="{{ route('gdmf.instructor.material_request.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-paper-plane"></i>
                                <p>Solicitar Materiales</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </aside>
</div>
