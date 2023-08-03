<nav class="navbar navbar-expand-lg navbar-Dark" style="background-color:white;">
    <a class="navbar-brand" href="#">DATAGRO</a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse d-sm-flex" id="collapsibleNavId">
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

        <!-- Botón del menú desplegable con el ícono ☰ -->
        <button class="navbar-toggler" id="menuButton">&#9776;</button>
        <ul class="dropdown-menu" id="dropdownMenu">
            <li class="dropdown-item">
              <a href="#">Opción 1</a>
            </li>
            <li class="dropdown-item">
              <a href="#">Opción 2</a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const menuButton = document.getElementById('menuButton');
  const dropdownMenu = document.getElementById('dropdownMenu');

  // Función para mostrar u ocultar el menú desplegable
  function toggleDropdownMenu() {
    dropdownMenu.classList.toggle('show');
  }

  // Agregar el evento click al botón del menú desplegable
  menuButton.addEventListener('click', toggleDropdownMenu);
});

</script>
