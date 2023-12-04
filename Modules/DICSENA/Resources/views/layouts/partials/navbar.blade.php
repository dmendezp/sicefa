<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex flex-row justify-content-start">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ url('lang', ['es']) }}" class="dropdown-item">Español</a>
                        <a href="{{ url('lang', ['en']) }}" class="dropdown-item">English</a>
                        <a href="{{ route('cefa.welcome') }}" class="dropdown-item">Volver a SICEFA</a>
                    </div>
                </li>

                <ul class="navbar-nav mx-auto d-flex flex-row justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}">Panel</a>
                    </li>
                </ul>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.manual') }}" data-toggle="tooltip" data-placement="top" data-title="¿Necesitas ayuda en el uso?" data-color="#ffffff">
                        <i class="fas fa-book-open"></i> Ayuda
                    </a>
                </li>


                <ul class="navbar-nav ml-auto d-flex flex-row justify-content-end">
                    <li class="nav-item dropdown" data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->nickname }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <div class="dropdown-item">
                                <small class="text-muted">{{ Auth::user()->roles[0]->name }}</small>
                            </div>
                            <a class="dropdown-item" href="{{ route('cefa.dicsena.home.index') }}">Salir</a>
                        </div>
                    </li>
                </ul>
        </div>
    </div>
</nav>
<style>
    /* Navbar */
    .navbar {
        background-color: #222;
        color: #fff;
    }

    .navbar-toggler {
        background-color: #fff;
        border-color: #fff;
    }

    .navbar-nav .nav-link {
        color: #fff;
    }
</style>