<nav class="main-header navbar-background-cafeto navbar navbar-expand navbar-warning navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item mx-2">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:aliceblue"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('cefa.cafeto.index') }}" class="nav-link text-light">Inicio</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li>
            <div class="nav-item dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-title="{{ trans('cafeto::general.Language') }}">
                    <i class="fas fa-globe-americas"></i> {{ session('lang') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <!-- Agregar la clase dropdown-menu-end -->
                    <li>
                        <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                            <img src="{{ asset('modules/ptventa/images/flags/estados-unidos.webp') }}" alt="">
                            Ingles
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                            <img src="{{ asset('modules/ptventa/images/flags/colombia.webp') }}" alt="">
                            Español
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip"
                data-bs-placement="bottom" data-bs-title="Pantalla Completa">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Aplicaciones">
                <i class="fa-solid fa-shapes"></i>
            </a>
        </li>
    </ul>
</nav>
