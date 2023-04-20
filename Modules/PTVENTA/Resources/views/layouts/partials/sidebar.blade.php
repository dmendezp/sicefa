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
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{route('ptventa.inventory.index')}}" class="nav-link {{ !Route::is('ptventa.inventory.index*') ?: 'active'}}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>Inventario</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('ptventa.sale.index')}}" class="nav-link {{ !Route::is('ptventa.sale.index*') ?: 'active'}}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Ventas</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ptventa.element.index') }}" class="nav-link {{ !Route::is('ptventa.element.index*') ?: 'active'}}">
                            <i class="nav-icon fas fa-image"></i>
                            <p>Productos</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
