<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">

    <!-- Brand Logo -->
    <a href="{{route('index')}}" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sena Empresa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" >
          <!-- {{--<img src="{{ Auth::user()->imagen }}" class="img-circle elevation-2"  alt="User Image">--}} -->
        </div>
        <div class="info">
          <!-- {{--<a href="#" class="d-block">{{ Auth::user()->name }}</a>--}}-->
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Turnos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('turnosRutinarios')}}" class="nav-link active">
                  <i class="nav-icon fas fa-people-carry"></i>
                  <p>Turnos Rutinarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          
          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
