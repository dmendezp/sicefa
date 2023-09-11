
{{-- Dropdown traduccion --}}
<script>
    function toggleDropdown() {
    var dropdown = document.getElementById("myDropdown");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

// Cerrar el menú desplegable si se hace clic fuera de él
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}
</script>  

{{-- Pone background a la opcion seleccionada del navbar --}}
<script>
    // Obtener la URL actual
    const currentURL = window.location.href;

    // Obtener todos los enlaces en la barra de navegación
    const navLinks = document.querySelectorAll('.navbar-nav li a');
    const navLinksDashboard = document.querySelectorAll('.dashboard li a');
    const navLinksHome = document.querySelectorAll('.home li a');


    // Iterar a través de los enlaces y verificar si su href coincide con la URL actual
    navLinks.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add('selected');
        }
    });
    navLinksDashboard.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add('selected');
        }
    });
    navLinksHome.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add('selected');
        }
    });
</script>


{{--Script para traer la cedula de la persona que se seleccione--}}
<script>
    $(document).ready(function() {
        // Escucha el evento de cambio en el select
        $('#coordinator_select').change(function() {
            // Obtén el valor seleccionado
            var selectedValue = $(this).val();
            
            // Si el valor no está vacío, realiza una solicitud AJAX para obtener la cédula
            if (selectedValue) {
                console.log('ID de la persona seleccionada:', selectedValue);
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.cedula', ['coordinatorId' => ':coordinatorId'])) !!}.replace(':coordinatorId', selectedValue.toString()), // Convierte a cadena de texto
                    method: 'GET',
                    success: function(response) {
                        if (!isNaN(response.cedula.document_number)) {
                            // Convierte la cédula a un número antes de establecerla
                            var cedula = parseFloat(response.cedula.document_number);
                            $('#document_number_coordinator').val(cedula);
                        } else {
                            // Manejar el caso en que la cédula no sea un número válido
                            console.error('La cédula no es un número válido.');
                        }
                    },


                    error: function() {
                        // Maneja errores si es necesario
                        console.error('Error al obtener la cédula del coordinador.');
                    }
                });
            } else {
                // Si se selecciona la opción predeterminada, deja el campo de "Cédula" en blanco
                $('#document_number_coordinator').val('');
            }
        });
    });
</script>


{{-- Obtiene el precio del inventario --}}
<script>
    $(document).ready(function () {
        $('#elementInventory').change(function () {
            var elementoSeleccionado = $(this).val();

            // Realiza una petición AJAX para obtener la cantidad
            if (elementoSeleccionado) {
                console.log('ID de la persona seleccionada:', elementoSeleccionado);
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.instructor.movements.id', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
                    method: 'GET',
                    success: function (response) {
                    if (Array.isArray(response.id)) {
                        // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                        response.id.forEach(function (value) {
                            var amount = parseFloat(value.amount); // Acceder al amount
                            var price = parseFloat(value.price);   // Acceder al price
                            
                            // Establecer los valores en los campos correspondientes
                            $('#available').val(amount);
                            $('#price').val(price);
                        });
                    } else {
                        // Manejar el caso en que el valor no sea un número válido
                        console.error('No se encontró el precio válido.');
                    }
                },
                    error: function (error) {
                        console.error('Error al obtener la cantidad:', error);
                    }
                });
            } else {
                // Si se selecciona la opción predeterminada, deja el campo de "Cédula" en blanco
                $('#available').val('');
            }
        });
    });
</script>


{{--Script para traer el id del curso seleccionado--}}
<script>
    $(document).ready(function() {
        $('#course').change(function() {
            var selectedCourseId = $(this).val(); // Obtiene el ID del curso seleccionado
            console.log('ID del curso seleccionado:', selectedCourseId);
        });
    });
</script>

{{--Sweet alert para la solicitud--}}
<script>
    @if(Session::get('message_line'))
        @if (Session::get('icon') == 'success')
            swal({
                title: "Éxito!",
                text: "{{ Session::get('message_line') }}",
                icon: "success",
            });
        @elseif (Session::get('icon') == 'error')
            swal({
                title: "Error!",
                text: "{{ Session::get('message_line') }}",
                icon: "error",
            });
        @endif
    @endif
</script>

<script>
    new DataTable('#deliveries');
    new DataTable('#example');
</script>
<script>
    $(document).ready(function() {
    $('#deliveries').DataTable({
        "order": [[0, "desc"]], // Ordenar por la primera columna (Fecha de Solicitud) en orden descendente
        "paging": true,
        // Agrega otras opciones de configuración según tus necesidades
    });
});

</script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/6364639265.js" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

