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

<!-- Script para el formulario de solicitud de bienes -->
<script>

    const selectElement = function(element) {
        return document.querySelector(element);
    }

    let menuToggle = selectElement('.inicio-to');
    let body = selectElement('body');

    menuToggle.addEventListener('click', function(){
        body.classList.toggle('open');
    })

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/6364639265.js" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

