<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{ route('cefa.sigac.index') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('modules/sigac/images/logo-sigac.png') }}" class="brand-image"
                alt="SIGAC-Logo">{{-- Icono de SIGAC --}}
            <span class="brand-text">SIGAC</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-1 d-flex">
                <div class="image">
                    <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block" style="text-decoration:none">Alexander Pierce</a>
                </div>
            </div>

            <div class="user-panel d-flex">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('cefa.welcome') }}" class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                            <i class="fas fa-puzzle-piece"></i>
                            <p>{{ trans('sigac::general.Back')}}</p>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.attendance.register') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>{{ trans('sigac::general.Attendance Register') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.attendance.consult') }}" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>{{ trans('sigac::general.Consult Apprentice') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.sigac.schedule.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-clock"></i>
                            <p>{{ trans('sigac::schedule.Schedule Instructor') }}</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
