  <aside class="main-sidebar sidebar-light-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('evs.voto.index') }}" class="brand-link">
      <img src="{{ asset('evs/images/voto.png') }}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EVS {{ __('Electronic voting') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('general/images/usuario.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ __('Administrator') }}</a>
        </div>
      </div>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('general/images/logosicefa.png') }}" class="" alt="">
        </div>
        <div class="info">
          <a href="http://sicefa.test:8081" class="d-block">{{ __('Back to SICEFA') }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('evs.admin.dashboard') }}" class="nav-link {{ ! Route::is('evs.admin.dashboard') ?: 'active' }}">
              <i class="fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
              </p>
            </a>
          </li>         
          <li class="nav-item">
            <a href="{{ route('evs.admin.elections') }}" class="nav-link {{ ! Route::is('evs.admin.elections*') ?: 'active' }}">
              <i class="fas fa-calendar-alt"></i>
              <p>
                {{ __('Elections') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('evs.admin.candidates') }}" class="nav-link {{ ! Route::is('evs.admin.candidates*') ?: 'active' }}">
              <i class="fas fa-id-card-alt"></i>
              <p>
                {{ __('Candidates') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('evs.admin.juries') }}" class="nav-link {{ ! Route::is('evs.admin.juries*') ?: 'active' }}">
              <i class="fas fa-gavel"></i>
              <p>
                {{ __('Juries') }}
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>