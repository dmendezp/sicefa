<div class="sidebar-color">
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
        <a href="{{route('cefa.ptventa.index')}}" class="brand-link text-decoration-none">
            <img src="{{ asset('ptventa/images/Logo-Sidebar.png') }}" class="brand-image" alt="PTVenta-Logo">{{-- Icono de punto de venta --}}
            <span class="brand-text font-weight-bold">Punto de Venta</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                    {{-- List of options available in the sidebar --}}
                    <li class="nav-item">
                        <a href="{{route('cefa.ptventa.indexProducts')}}" class="nav-link">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>Productos</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>Empleados</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('cefa.ptventa.indexSales')}}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Ventas</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-percentage"></i>
                            <p>Promociones</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-code"></i>
                            <p>Desarrolladores</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>