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
                title: "{{trans('agroindustria::formulations.Success')}}",
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
 
 {{-- Busca productos segun el numero de documento --}}
<script>
    $(document).ready(function() {
        var baseUrl = '{{ route("agroindustria.instructor.units.element.name") }}';
          console.log(baseUrl);
          $('select[name="element[]"]').select2({
            placeholder: 'Seleccione un elemento',
            minimumInputLength: 3,
            ajax: {
                url: baseUrl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        element_id: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });
                    return {
                        results: results
                    };
                },
                cache: true
            }
          });

          // Manejar la selección de una persona en el campo de búsqueda
          $('.elementInventory-select').on('select2:select', function(e) {
              var selectedElement = e.params.data;
              console.log(selectedElement);
              // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
              $(this).closest('.elements').find('input.element_id').val(selectedElement.id);
              $(this).closest('.elements').find('input.element_name').val(selectedElement.text);
          });
        });
 </script>


<script>
    new DataTable('#discharge')
    new DataTable('#formulation')
    new DataTable('#labors')
    new DataTable('#request')
    new DataTable('#table-production')
    new DataTable('#request')
    new DataTable('#deliveries')
    new DataTable('#inventoryAlert')
    new DataTable('#inventoryExp')
    $(document).ready(function() {
        $('#deliveries').DataTable({
            "order": [[0, "desc"]], // Ordenar por la primera columna (Fecha de Solicitud) en orden descendente
            "paging": true,
            // Agrega otras opciones de configuración según tus necesidades
        });
    });
</script>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/6364639265.js" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>