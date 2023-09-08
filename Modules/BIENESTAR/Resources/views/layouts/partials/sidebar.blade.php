<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link" style="text-decoration: none; display: flex; align-items: center;">
        <i class="fas fa-hand-holding-heart" style="color: #ffffff; font-size: 60px; margin-right: 10px;"></i>
        <div>
          <span class="brand-text font-weight-dark" style="color: white; font-size: 25px">Bienestar al</span><br>
          <span class="brand-text font-weight-dark" style="color: white; font-size: 25px">Aprendiz</span>
        </div>
      </a><br>
    
      <!-- Sidebar -->
      <div class="sidebar" style="background: #28b463;">
       <!-- Línea separadora -->
       <hr class="sidebar-divider">
      <!-- Enlace "Volver a Sicefa" -->
      <div class="user-panel ">
            <nav class="">
              <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                  <a href="{{ route('cefa.welcome') }}" class="nav-link {{ ! Route::is('cefa.contact.maps') ?: 'active' }}">
                    <i class="fas fa-puzzle-piece"></i>
                    <p>
                      Volver a Sicefa
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
           <!-- Línea separadora -->
           <hr class="sidebar-divider">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-user"></i>
                <p>Aprendices</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-pizza-slice"></i>
                <p>Alimentación <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 1</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 2</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 3</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-house-user"></i>
                <p>Internado <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 1</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 2</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 3</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-bus"></i>
                <p>Transporte <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('bienestar.buses') }}" class="nav-link">Buses</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bienestar.drivers') }}" class="nav-link">Conductores</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bienestar.transportroutes') }}" class="nav-link">Rutas</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Asignar Rutas</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list"></i>
                <p>Convocatorias <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('bienestar.benefits') }}" class="nav-link">Beneficios</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bienestar.typeofbenefits')}}" class="nav-link">Tipo de Beneficiario</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bienestar.benefitstypeofbenefits')}}" class="nav-link">Configurar Beneficios</a>
                </li>
              </ul>
            </li>
          </ul><br>          
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
