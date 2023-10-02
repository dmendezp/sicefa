<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link" style="text-decoration: none; display: flex; align-items: center;">
    <i class="fas fa-hand-holding-heart" style="color: #ffffff; font-size: 60px; margin-right: 10px;"></i>
    <div>
      <span class="brand-text font-weight-dark" id="logo">Bienestar al</span><br>
      <span class="brand-text font-weight-dark" id="logo">Aprendiz</span>
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
            <a href="{{ route('cefa.welcome') }}" class="nav-link">
              <i class="fas fa-puzzle-piece"></i>
              <p>
                {{ trans('bienestar::menu.Back to Sicefa')}}
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
            <p>{{ trans('bienestar::menu.Apprentices')}}</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-pizza-slice"></i>
            <p>{{ trans('bienestar::menu.Feeding')}} <i class="fas fa-angle-left right"></i></p>
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
            <p>{{ trans('bienestar::menu.Transportation')}} <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.buses') }}" class="nav-link">Buses</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.drivers') }}" class="nav-link">Conductores</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.transportroutes') }}" class="nav-link">Rutas</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Asignar Rutas</a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-handshake"></i>
            <p>{{ trans('bienestar::menu.Benefits')}} <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.benefits') }}" class="nav-link">Tipos de Beneficios</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.typeofbenefits')}}" class="nav-link">Tipo de Beneficiario</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.benefitstypeofbenefits')}}" class="nav-link">Configurar Beneficios</a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-clipboard-list"></i>
            <p>{{ trans('bienestar::menu.Convoctions')}} <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.editform') }}" class="nav-link">Formularios</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.Convocations')}}" class="nav-link">Convocatorias</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.typeofbenefits')}}" class="nav-link">Configurar Convocatoria</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cefa.bienestar.benefitstypeofbenefits')}}" class="nav-link">Postulaciones </a>
            </li>
          </ul>
        </li>
        
        <!-- Nueva sección "Consulta" debajo de "Convocatorias" -->
        <li class="nav-item has-treeview">
          <a href="{{route('cefa.bienestar.callconsultation')}}" class="nav-link">
            <i class="fas fa-search"></i>
            <p>Consulta</p>
          </a>
          
        </li>
        <!-- Fin de la nueva sección "Consulta" -->
        
      </ul><br>          
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
