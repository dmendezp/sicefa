  <aside class="main-sidebar sidebar-light-green elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('bolmeteor.estacion.index') }}" class="brand-link">
      <img src="{{ asset('bolmeteor/images/boletin1.png') }}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .9">
      <span class="brand-text font-weight-light">Boletín Metereológico{{ __('') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('bolmeteor/images/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ __('Welcome') }}</a>
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
            <a href="{{ route('bolmeteor.estacion.index') }}" class="nav-link {{ ! Route::is('bolmeteor.estacion.index') ?: 'active' }}">
              <i class="fas fa-home"></i>
              <p>
                {{ __('Home') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bolmeteor.estacion.graficas') }}" class="nav-link {{ ! Route::is('bolmeteor.estacion.graficas') ?: 'active' }}">
              <i class="fas fa-users"></i>
              <p>
                {{ __('Gráficas') }}
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="{{ route('bolmeteor.estacion.desarrolladores') }}" class="nav-link {{ ! Route::is('bolmeteor.estacion.desarolladores') ?: 'active' }}">
              <i class="fas fa-users"></i>
              <p>
                {{ __('Desarrolladores') }}
              </p>
            </a>
          </li>

           
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>