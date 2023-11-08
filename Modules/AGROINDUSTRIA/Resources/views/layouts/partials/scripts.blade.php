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
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.units.instructor.movements.id', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
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
                $('#price').val('');
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

{{-- Oculta formularios de labor--}}
<script>
    $(document).ready(function() {
        // Inicialmente, oculta el formulario
        $("#form-container").hide();
        $("#form-container-tools").hide();
        $("#form-container-consumables").hide();
        $("#form-container-equipments").hide();

        // Botón para abrir/cerrar el formulario
        $("#toggle-form").click(function() {
            // Alternar la visibilidad del formulario
            $("#form-container").toggle();

            // Cambiar el texto del botón en función del estado del formulario
            var buttonText = $("#form-container").is(":visible")
                ? "{{ trans('agroindustria::labors.closeCollaboratorsForm') }}"
                : "{{ trans('agroindustria::labors.openCollaboratorFormulatio') }}";

            // Actualizar el texto del botón
            $(this).text(buttonText);

            // Cambiar el color del botón a rojo cuando el formulario está abierto
            if ($("#form-container").is(":visible")) {
                $(this).css("background-color", "red");
            } else {
                // Restaurar el color original cuando el formulario se cierra
                $(this).css("background-color", ""); // Vaciar el valor para restaurar el color original
            }
        });
        
        // Botón para abrir/cerrar el formulario
        $("#toggle-form-tools").click(function() {
            // Alternar la visibilidad del formulario
            $("#form-container-tools").toggle();

            // Cambiar el texto del botón en función del estado del formulario
            var buttonText = $("#form-container-tools").is(":visible")
                ? "Cerrar formulario de herramientas"
                : "Registro de herramientas";

            // Actualizar el texto del botón
            $(this).text(buttonText);

            // Cambiar el color del botón a rojo cuando el formulario está abierto
            if ($("#form-container-tools").is(":visible")) {
                $(this).css("background-color", "red");
            } else {
                // Restaurar el color original cuando el formulario se cierra
                $(this).css("background-color", ""); // Vaciar el valor para restaurar el color original
            }
        });
        // Botón para abrir/cerrar el formulario
        $("#toggle-form-consumables").click(function() {
            // Alternar la visibilidad del formulario
            $("#form-container-consumables").toggle();

            // Cambiar el texto del botón en función del estado del formulario
            var buttonText = $("#form-container-consumables").is(":visible")
                ? "Cerrar formulario de consumibles"
                : "Registro de consumibles";

            // Actualizar el texto del botón
            $(this).text(buttonText);

            // Cambiar el color del botón a rojo cuando el formulario está abierto
            if ($("#form-container-consumables").is(":visible")) {
                $(this).css("background-color", "red");
            } else {
                // Restaurar el color original cuando el formulario se cierra
                $(this).css("background-color", ""); // Vaciar el valor para restaurar el color original
            }
        });

        // Botón para abrir/cerrar el formulario
        $("#toggle-form-equipment").click(function() {
            // Alternar la visibilidad del formulario
            $("#form-container-equipments").toggle();

            // Cambiar el texto del botón en función del estado del formulario
            var buttonText = $("#form-container-equipments").is(":visible")
                ? "Cerrar formulario de equipos"
                : "Registro de equipos";

            // Actualizar el texto del botón
            $(this).text(buttonText);

            // Cambiar el color del botón a rojo cuando el formulario está abierto
            if ($("#form-container-equipments").is(":visible")) {
                $(this).css("background-color", "red");
            } else {
                // Restaurar el color original cuando el formulario se cierra
                $(this).css("background-color", ""); // Vaciar el valor para restaurar el color original
            }
        });
    });
</script>



{{-- Trae el responsable de la actividad seleccionada --}}
<script>
    $(document).ready(function() {
        // Detecta cambios en el primer campo de selección (Receiver)
        $('#activity-selected').on('change', function() {
            var selectedActivity = $(this).val();
            var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.responsibilities', ['activityId' => ':activityId'])) !!}.replace(':activityId', selectedActivity.toString());
            // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var options = '<option value="">' + '{{ trans("agroindustria::labors.selectResponsiblePerson") }}' + '</option>';
                    $.each(response.id, function(index, warehouse) {
                        options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                    });

                    // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                    $('#responsible').html(options);

                    // Añade aquí el código para consultar el tipo de actividad
                    var activityType = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.type', ['type' => ':type'])) !!}.replace(':type', selectedActivity.toString());
                    $.ajax({
                        url: activityType,
                        type: 'GET',
                        success: function(typeResponse) {
                            if (typeResponse.type.length > 0) {
                                $('#recipe-field').show();
                                $('#date-expiration-field').show();
                                $('#lot-field').show();
                                $('#amount-production-field').show();
                            } else {
                                $('#recipe-field').hide();
                                $('#date-expiration-field').hide();
                                $('#lot-field').hide();
                                $('#amount-production-field').hide();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

{{-- Trae el precio segun el tipo de empleado seleccionado --}}
<script>
    $(document).ready(function() {
         // Detecta cambios en el primer campo de selección (Receiver)
         $('.employement_type').on('change', function() {
            var selectedEmployement = $(this).val();

            var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.price', ['id' => ':id'])) !!}.replace(':id', selectedEmployement.toString());

            // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                    var price = response.price;
                    $('.price').val(price);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    })
</script>

{{-- Busca personas segun el numero de documento --}}
<script>
    $(document).ready(function() {
         var baseUrl = '{{ route("cefa.agroindustria.units.instructor.labor.executors", ["document_number" => ":document_number"]) }}';
 
         // Inicializa Select2 en el campo de búsqueda de personas
         $('.personSearch-select').select2({
             placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
             minimumInputLength: 1, // Habilita la búsqueda en tiempo real
             ajax: {
                 url: function(params) {
                     // Reemplaza el marcador de posición con el término de búsqueda
                     var searchUrl = baseUrl.replace(':document_number', params.term);
 
 
                     return searchUrl; // Utiliza la URL actualizada con el término de búsqueda
                 },
                 dataType: 'json',
                 delay: 250, // Retardo antes de iniciar la búsqueda
                 processResults: function(data) {
                     return {
                         results: data.id.map(function(person) {
                             return {
                                 id: person.id,
                                 text: person.name,
                             };
                         })
                     };
                 },
                 cache: true
             }
         });
 
         // Manejar la selección de una persona en el campo de búsqueda
         $('.personSearch-select').on('select2:select', function(e) {
             var selectedPerson = e.params.data;
             // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
             $('.executors_id').val(selectedPerson.id);
             $('.collaborator_executors').val(selectedPerson.text);
         });
     });
 </script>
 

<script>
    new DataTable('#inventory');
    new DataTable('#discharge')
    new DataTable('#formulation')
    new DataTable('#labors')
    new DataTable('#request')
    new DataTable('#table-production')
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

