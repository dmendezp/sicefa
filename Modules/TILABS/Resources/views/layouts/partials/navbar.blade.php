  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item mx-2">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item mx-2 d-none d-sm-inline-block {{ !Route::is('*cefa.tilabs.*') ?: 'active' }}">
              <a href="{{ route('cefa.tilabs.index') }}" class="nav-link">Inicio</a>
          </li>
          @guest
          @else
              <li class="nav-item d-none d-sm-inline-block {{ !Route::is('*admin.*') ?: 'active' }}">
                  <a href="{{ route('tilabs.admin.dashboard') }}" class="nav-link">Administrador</a>
              </li>
          @endguest
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown mx-2">
              <button type="button" class="btn btn-primary" id="notificationsDropdown" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="fas fa-bell"></i> <!-- Icono de notificación -->
                  <span class="badge badge-warning navbar-badge">15</span> <!-- Cantidad de notificaciones -->
              </button>
              <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="notificationsDropdown">
                  <li>
                      <span class="dropdown-header">15 Notificaciones</span>
                  </li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <li>
                      <a href="#" class="dropdown-item">
                          <i class="fas fa-envelope me-2"></i> 4 Nuevos Mensajes
                      </a>
                  </li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <li>
                      <a href="#" class="dropdown-item">
                          <i class="fas fa-file me-2"></i> 3 Nuevos Reportes
                      </a>
                  </li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <li>
                      <a href="#" class="dropdown-item dropdown-footer">Ver todas las Notificaciones</a>
                  </li>
              </ul>
          </li>
          <li class="nav-item mx-1">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-title="{{ trans('ptventa::general.Full Screen Mode') }}">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          <!-- languaje Dropdown Menu-->
          <li>
              <div class="nav-item dropdown mx-1">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                      data-bs-toggle="tooltip" data-bs-placement="left"
                      data-bs-title="Internacionalización">
                      <i class="fas fa-globe-americas"></i> {{ session('lang') }}
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <!-- Agregar la clase dropdown-menu-end -->
                      <li>
                          <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                              <img src="{{ asset('modules/tilabs/images/flags/estados-unidos.webp') }}" alt="">
                              Inglés
                          </a>
                      </li>
                      <li>
                          <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                              <img src="{{ asset('modules/tilabs/images/flags/colombia.webp') }}" alt="">
                              Español
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
      </ul>
  </nav>
