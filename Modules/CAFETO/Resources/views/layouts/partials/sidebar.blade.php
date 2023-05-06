<aside class="main-sidebar sidebar-light-primary sidebar-background-cafeto elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.cafeto.index') }}" class="brand-link pb-1 text-decoration-none">
        <h3 class="text-light">
            <i class="nav-icon fas fa-mug-hot ml-3 mr-1"></i>
            <span class="brand-text">CAFETO</span>
        </h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('cefa.cafeto.index') }}" class="nav-link {{ !Route::is('cefa.cafeto.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.inventory.index') }}" class="nav-link {{ !Route::is('cafeto.inventory.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Inventario</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.sale.index') }}" class="nav-link {{ !Route::is('cafeto.sale.index*') ?: 'active' }} text-light">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Ventas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cafeto.element.index') }}" class="nav-link {{ !Route::is('cafeto.element.index*') ?: 'active' }} text-light">
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
