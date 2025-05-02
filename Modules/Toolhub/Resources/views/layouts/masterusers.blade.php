<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unidad Préstamos de Herramientas</title>
  <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

  <style>
    :root {
      --green-50: #f0fdf4; --green-100: #dcfce7; --green-200: #bbf7d0;
      --green-300: #86efac; --green-400: #4ade80; --green-500: #22c55e;
      --green-600: #16a34a; --green-700: #15803d; --green-800: #166534;
      --green-900: #14532d;
    }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .bg-green-50 { background-color: var(--green-50); }
    .bg-green-100 { background-color: var(--green-100); }
    .bg-green-600 { background-color: var(--green-600); }
    .text-green-600 { color: var(--green-600); }
    .text-green-800 { color: var(--green-800); }
    .border-green-100 { border-color: var(--green-100) !important; }
    .btn-green { background-color: var(--green-600); color: white; }
    .btn-green:hover { background-color: var(--green-700); }
    .btn-outline-green { border-color: var(--green-600); color: var(--green-600); }
    .btn-outline-green:hover { background-color: var(--green-50); }
    .feature-badge { display: inline-block; background: var(--green-100); color: var(--green-800); padding: .25rem .75rem; border-radius: .5rem; font-size: .875rem; }
    .feature-icon, .step-number { display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-bottom: 1rem; width: 3rem; height: 3rem; }
    .feature-icon { background: var(--green-100); color: var(--green-600); }
    .step-number { background: var(--green-600); color: #fff; font-weight: bold; }
    .hero-gradient { background: linear-gradient(to bottom, white, var(--green-50)); }
    .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .feature-card { transition: transform .3s ease; }
    .feature-card:hover { transform: translateY(-5px); }
    .check-icon { color: var(--green-600); margin-right: .5rem; }
  </style>

  <!-- Scripts diferidos -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
      <a class="navbar-brand" href="#">
    <img src=../resourses/views/img/image.png alt="Logo" style="width: 30px; height: 30px;">
  </a>
        <i class="bi bi-tools text-green-600 me-2"></i>
        <span class="fw-bold">ToolHub</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link" href="#features">Características</a></li>
          <li class="nav-item"><a class="nav-link" href="#how-it-works">Cómo Funciona</a></li>
          <li class="nav-item"><a class="nav-link" href="#advantages">Ventajas</a></li>
          @auth
            @if(checkRol('toolhub.admin'))
              <li class="nav-item"><a class="nav-link @if(Route::is('toolhub.admin.*')) active @endif" href="{{ route('toolhub.admin.welcome') }}">Administrador</a></li>
            @endif
            @if(checkRol('toolhub.superadmin'))
              <li class="nav-item"><a class="nav-link @if(Route::is('toolhub.superadmin.*')) active @endif" href="{{ route('toolhub.superadmin.welcomesuper') }}">Super Administrador</a></li>
            @endif
          @endauth
        </ul>
        <div class="d-flex gap-2">
          @guest
            <a href="{{ route('login') }}" class="btn btn-green btn-lg">Iniciar Sesión</a>
            
          @endguest
          @auth
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-outline-green">Logout</button>
            </form>
          @endauth
        </div>
      </div>
    </div>
  </nav>

 <!-- Hero Section -->
 <section class="hero-gradient py-5">
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <h1 class="display-4 fw-bold text-green-800 mb-3">Bienvenido a ToolHub</h1>
        <p class="lead text-muted mb-4">
          La plataforma digital para el préstamo de herramientas del SENA la Angostura. Facilitamos el acceso, control y 
          gestión de los recursos técnicos para estudiantes y personal.
        </p>
      </div>
      <div class="col-lg-6">
        <img src="https://placehold.co/600x400" alt="Herramientas del SENA" class="img-fluid rounded-4 shadow">
      </div>
    </div>
  </div>
</section>

  <!-- Aquí irían las secciones Features, How It Works, Advantages, Admin, CTA -->
 

  <!-- Features Section -->
  <section id="features" class="py-5 bg-white">
    <div class="container py-5">
      <div class="text-center mb-5">
        <span class="feature-badge mb-2">Características</span>
        <h2 class="display-5 fw-bold text-green-800 mb-3">¿Qué es ToolHub?</h2>
        <p class="lead text-muted mx-auto" style="max-width: 800px;">
          ToolHub es un software especializado para la gestión y préstamo de herramientas en el SENA la Angostura, 
          diseñado para optimizar el uso de recursos técnicos y mejorar la experiencia educativa.
        </p>
      </div>
      
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 border-green-100 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="feature-icon mx-auto">
                <i class="bi bi-tools"></i>
              </div>
              <h3 class="h4 text-green-800 mb-3">Inventario Digital</h3>
              <p class="text-muted">
                Catálogo completo de todas las herramientas disponibles con detalles técnicos y estado actual.
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card h-100 border-green-100 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="feature-icon mx-auto">
                <i class="bi bi-people"></i>
              </div>
              <h3 class="h4 text-green-800 mb-3">Gestión de Usuarios</h3>
              <p class="text-muted">
                Control de acceso para estudiantes y personal con diferentes niveles de permisos.
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card h-100 border-green-100 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="feature-icon mx-auto">
                <i class="bi bi-check-circle"></i>
              </div>
              <h3 class="h4 text-green-800 mb-3">Seguimiento en Tiempo Real</h3>
              <p class="text-muted">
                Monitoreo del estado de préstamos, devoluciones y disponibilidad de herramientas.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section id="how-it-works" class="py-5 bg-green-50">
    <div class="container py-5">
      <div class="text-center mb-5">
        <span class="feature-badge mb-2">Proceso</span>
        <h2 class="display-5 fw-bold text-green-800 mb-3">¿Cómo Funciona?</h2>
        <p class="lead text-muted mx-auto" style="max-width: 800px;">
          Un proceso simple y eficiente para el préstamo y devolución de herramientas.
        </p>
      </div>
      
      <div class="row g-4">
        <div class="col-md-4">
          <div class="text-center">
            <div class="step-number mx-auto">1</div>
            <h3 class="h4 text-green-800 mb-3">Solicitud</h3>
            <p class="text-muted">
              Los usuarios registrados pueden solicitar herramientas específicas a través de la plataforma.
            </p>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="text-center">
            <div class="step-number mx-auto">2</div>
            <h3 class="h4 text-green-800 mb-3">Aprobación</h3>
            <p class="text-muted">
              Los administradores revisan y aprueban las solicitudes según disponibilidad y prioridad.
            </p>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="text-center">
            <div class="step-number mx-auto">3</div>
            <h3 class="h4 text-green-800 mb-3">Entrega y Devolución</h3>
            <p class="text-muted">
              Recogida de herramientas aprobadas y devolución dentro del plazo establecido.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Advantages Section -->
  <section id="advantages" class="py-5 bg-white">
    <div class="container py-5">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <span class="feature-badge mb-2">Ventajas</span>
          <h2 class="display-5 fw-bold text-green-800 mb-4">Beneficios de ToolHub</h2>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill check-icon mt-1"></i>
              <span class="text-muted">Optimización del uso de recursos técnicos disponibles</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill check-icon mt-1"></i>
              <span class="text-muted">Reducción de tiempos de espera y procesos administrativos</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill check-icon mt-1"></i>
              <span class="text-muted">Mayor control y seguimiento del inventario de herramientas</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill check-icon mt-1"></i>
              <span class="text-muted">Transparencia en la asignación de recursos</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill check-icon mt-1"></i>
              <span class="text-muted">Generación de reportes y estadísticas de uso</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill check-icon mt-1"></i>
              <span class="text-muted">Mejora en la planificación de adquisiciones futuras</span>
            </li>
          </ul>
        </div>
        <div class="col-lg-6">
          <img src="https://placehold.co/600x400" alt="Beneficios de ToolHub" class="img-fluid rounded-4 shadow">
        </div>
      </div>
    </div>
  </section>

  <!-- Admin Section -->
  <section id="admin" class="py-5 bg-green-50">
    <div class="container py-5">
      <div class="text-center mb-5">
        <span class="feature-badge mb-2">Acceso Administrativo</span>
        <h2 class="display-5 fw-bold text-green-800 mb-3">Para Administradores</h2>
        <p class="lead text-muted mx-auto" style="max-width: 800px;">
          El acceso completo al sistema está reservado exclusivamente para el personal administrativo autorizado del SENA la Angostura.
        </p>
      </div>
      
      <div class="card border-green-100 shadow p-4 p-md-5 mx-auto" style="max-width: 800px;">
        <div class="row align-items-center">
          <div class="col-md-3 text-center mb-4 mb-md-0">
            <div class="bg-green-100 rounded-circle p-4 d-inline-flex">
              <i class="bi bi-key text-green-600" style="font-size: 3rem;"></i>
            </div>
          </div>
          <div class="col-md-9 text-center text-md-start">
            <h3 class="h4 text-green-800 mb-3">Proceso de Acceso Administrativo</h3>
            <p class="text-muted mb-4">
              Los administradores designados recibirán credenciales únicas para acceder al panel de control completo. 
              Para solicitar acceso administrativo, contacte al departamento de sistemas del SENA la Angostura con su 
              identificación de empleado y justificación.
            </p>
            <button class="btn btn-green">Portal de Administradores</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  

  <!-- Footer -->
  <footer class="py-4 bg-white border-top fixed-bottom">
    <div class="container text-center">
      <span class="text-muted small">
        &copy; 2023-2025 ToolHub - SENA la Angostura. Todos los derechos reservados. Versión 3.2.0
      </span>
    </div>
  </footer>

  <!-- Scripts AdminLTE originales -->
  <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script>$.widget.bridge('uibutton', $.ui.button);</script>
  <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

</body>
</html>