<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
<!-- SweatAlert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- DataTables  & Plugins -->
{{-- //estos datos se sacaron de public/libs/AdminLTE/tables/data.html --}}
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('js/generalscripts.js')}}"></script>
<!-- Page specific script -->


@section('script')
<!-- Configuración del DataTable -->
<script>
   $(document).ready(function() {
    // Configura el DataTable en el elemento con el id 'benefitsTable'
    $('#benefitsTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], // Define las opciones de longitud del menú
        "pagingType": "simple", // Tipo de paginación simple con solo Siguiente y Anterior
        "responsive": true, // Hace que la tabla sea responsive
        "order": [[0, 'asc']], // Ordena por la primera columna en orden ascendente por defecto
        "language": {
            "lengthMenu": 'Mostrar <select class="custom-select custom-select-sm form-control form-control-sm">' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">Todos</option>' +
                '</select> registros por página',
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});



</script>
<script>
    'use strict'; //Boton de eliminar
    // Define una función reutilizable para mostrar los SweetAlerts
    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        }).then(function() {
            // Recargar la página después del SweetAlert
            location.reload();
        });
    }

    // Boton de eliminar
    var forms = document.querySelectorAll('.formEliminar');

    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita que el formulario se envíe de inmediato

                Swal.fire({
                    title: "{{ trans('bienestar::menu.¿Are You Sure?') }}",
            text: "{{ trans('bienestar::menu.This Action Is Irreversible') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ trans('bienestar::menu.Yes, Delete It') }}",
            cancelButtonText: "{{ trans('bienestar::menu.Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario usando AJAX
                        axios.post(form.action, new FormData(form))
                            .then(function(response) {
                                // Manejar la respuesta JSON del servidor
                                if (response.data && response.data.mensaje) {
                                    showSweetAlert('success', "{{ trans('bienestar::menu.Successful Elimination') }}", response.data.mensaje, 1500);
                                } else {
                                    showSweetAlert('error', 'Error',"{{ trans('bienestar::menu.An error occurred while trying to delete.') }}");
                                }
                            })
                            .catch(function(error) {
                                showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to delete.') }}");
                                console.error(error);
                            });
                    }
                });
            });
        });
</script>
<script>
// Configura el evento para el formulario de eliminación
document.querySelectorAll('.formEliminar[data-method="delete"]').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();

        Swal.fire({
            title: "{{ trans('bienestar::menu.¿Are You Sure?') }}",
            text: "{{ trans('bienestar::menu.This Action Is Irreversible') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ trans('bienestar::menu.Yes, Delete It') }}",
            cancelButtonText: "{{ trans('bienestar::menu.Cancel') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                var url = button.getAttribute('href');
                axios.delete(url)
                    .then(function (response) {
                                // Manejar la respuesta JSON del servidor
                                if (response.data && response.data.mensaje) {
                                    showSweetAlert('success', "{{ trans('bienestar::menu.Successful Elimination') }}", response.data.mensaje, 1500);
                                } else {
                                    showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to delete.') }}",15000);
                                }
                            })
                    .catch(function (error) {
                        // Mostrar el SweetAlert de error en caso de problemas
                        showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to delete.') }}", 1500);
                        console.error(error);
                    });
            }
        });
    });
});
</script>
<script>
    // Define una función reutilizable para mostrar los SweetAlerts
    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        }).then(function() {
            // Recargar la página después del SweetAlert
            location.reload();
        });
    }

    // Configura el evento para el formulario de edición
    document.querySelectorAll('.formEditar').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de inmediato
            var editForm = this;

            // Realizar una solicitud AJAX para enviar el formulario de edición
            axios.post(editForm.action, new FormData(editForm))
                .then(function(response) {
                    console.log(response)
                    if (response.status === 200) {
                        if (response.data.success) {
                            // Mostrar el SweetAlert de éxito con el mensaje del controlador
                            showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", response.data.success, 1500);
                        } else if (response.data.error) {
                            // Mostrar el SweetAlert de conflicto con el mensaje del controlador
                            showSweetAlert('error', 'Error', response.data.error, 1500);
                        } else {
                            // Mostrar el SweetAlert sin mensaje específico del controlador
                            showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", "{{ trans('bienestar::menu.Successful operation!') }}", 1500);
                        }
                    } else if (response.status === 409 && response.data.error) {
                        // Mostrar el SweetAlert de conflicto con el mensaje del controlador
                        showSweetAlert('error', 'Error', response.data.error, 1500);
                    }
                })
                .catch(function(error) {
                    // Mostrar el SweetAlert de error en caso de problemas
                    showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to edit.') }}",3000);
                });
        });
    });
</script>

<!-- Datatable postulados  de alimentacion-->
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": [{
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    customize: function(doc) {
                        doc.styles.tableHeader = {
                            fillColor: '#000000',
                            color: '#FAFAFA',
                            fontSize: 12
                        };
                        doc.content[1].alignment = 'center';
                    },
                    className: 'pdf-button' // Clase CSS personalizada para el botón PDF
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'excel-button' // Clase CSS personalizada para el botón Excel
                }
            ]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');

        // Establece los estilos CSS para el botón PDF (rojo) y el botón Excel (verde)
        $('.pdf-button').css({
            'background-color': 'red',
            'color': 'white', // Color del texto en el botón PDF
            'margin-right': '10px' // Margen derecho para separar los botones
        });

        $('.excel-button').css({
            'background-color': 'green',
            'color': 'white' // Color del texto en el botón Excel
        });
    });
</script>

<script>
    //Script para la alerta de la accion de guardar un formulario
    // Define una función reutilizable para mostrar los SweetAlerts
    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        }).then(function() {
            // Recargar la página después del SweetAlert
            location.reload();
        });
    }
    // Configura el evento para el formulario de guardar
    document.querySelectorAll('.formGuardar').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de inmediato
            var createForm = this;

            // Realizar una solicitud AJAX para enviar el formulario de creación
            axios.post(createForm.action, new FormData(createForm))
                .then(function(response) {
                    if (response.status === 200) {
                        if (response.data.success) {
                            showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", response.data.success, 1500);
                        } else {
                            showSweetAlert('error', 'Error',response.data.error,3000);
                        }
                    }
                })
        });
    });
</script>

<script>
    // Define una función reutilizable para mostrar los SweetAlerts
    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        }).then(function() {
            // Recargar la página después del SweetAlert
            location.reload();
        });
    }

    // Configura el evento para el formulario de edición
    document.querySelectorAll('#update-benefit-status-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de inmediato
            var editForm = this;

            // Realizar una solicitud AJAX para enviar el formulario de edición
            axios.post(editForm.action, new FormData(editForm))
                .then(function(response) {
                    if (response.status === 200 && response.data.success) {
                        // Mostrar el SweetAlert de éxito
                        showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", response.data.success, 1500);
                    } else if (response.status === 409 && response.data.error) {
                        // Mostrar el SweetAlert de conflicto
                        showSweetAlert('error', 'Error', response.data.error, 1500);
                    } else if (response.status === 200 && response.data.warning) {
                        // Mostrar el SweetAlert de advertencia si hay un mensaje de advertencia
                        showSweetAlert('warning', 'Advertencia', response.data.warning, 2000);
                    } else {
                        // Mostrar el SweetAlert de error en caso de problemas inesperados
                        showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to save records.') }}");
                    }
                })
                .catch(function(error) {
                    // Mostrar el SweetAlert de error en caso de problemas
                    showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to save records.') }}");
                });
        });
    });
</script>
