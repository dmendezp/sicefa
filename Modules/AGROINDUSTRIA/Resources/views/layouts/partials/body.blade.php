<link rel="stylesheet" href="css/navbar.css">
<nav class="navbar navbar-expand-sm navbar-Dark" style="background-color:white;">
    <a class="navbar-brand" href="#">DATAGRO</a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('agroindustria.index')}}">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('agroindustria.unidd')}}">Unidades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('agroindustria.solicitud')}}">Solicitud</a>
            </li>
        </ul>
    </div>
</nav>
<script>
    // Obtener la URL actual
    const currentURL = window.location.href;

    // Obtener todos los enlaces en la barra de navegación
    const navLinks = document.querySelectorAll('.navbar-nav li a');

    // Iterar a través de los enlaces y verificar si su href coincide con la URL actual
    navLinks.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add('selected');
        }
    });
</script>