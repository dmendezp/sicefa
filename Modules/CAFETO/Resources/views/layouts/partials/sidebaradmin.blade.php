<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('Modules/cafeto/img/coffee.png')}}"  class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CAFETO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('cafeto.admin.dashboard') }}" class="nav-link {{ ! Route::is('cafeto.admin.dashboard') ?: 'active' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeto.admin.sales') }}" class="nav-link {{ ! Route::is('cafeto.admin.sales') ?: 'active' }}">
                        <i class="fas fa-cash-register"></i>
                        <p>
                            {{ __('Sales')}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeto.admin.inventory') }}" class="nav-link {{ ! Route::is('cafeto.admin.inventory') ?: 'active' }}">
                        <i class="fas fa-boxes"></i>
                        <p>
                          {{ __('Inventory')}}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>