<!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('../modules/bienestar/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('../modules/bienestar/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('../modules/bienestar/AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
    <!-- js general -->
    <script src="{{ asset('../bienestarxd/js/script.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('../modules/bienestar/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('../modules/bienestar/AdminLTE-3.2.0/plugins/fullcalendar/main.js') }}"></script>
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

    <!-- Page specific script -->

    @section('script')
    <!-- Configuración del DataTable -->
    <script>
      $(document).ready(function() {
        // Configura el DataTable en el elemento con el id 'miDataTable'
        $('#benefitsTable').DataTable();
      });
    </script>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          timeZone: 'UTC',
          initialView: 'dayGridMonth',
          events: 'https://fullcalendar.io/api/demo-feeds/events.json',
          editable: true,
          selectable: true
        });

        calendar.render();
      });
    </script>
<script>
    'use strict';//Boton de eliminar
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
                title: "Are you sure?",
                text: "It is an irreversible process.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario usando AJAX
                    axios.post(form.action, new FormData(form))
                        .then(function(response) {
                            // Manejar la respuesta JSON del servidor
                            if (response.data && response.data.mensaje) {
                                showSweetAlert('success', 'Vacancy deleted!', response.data.mensaje, 1500);
                            } else {
                                showSweetAlert('error', 'Error', 'An error occurred while trying to delete the vacancy.');
                            }
                        })
                        .catch(function(error) {
                            showSweetAlert('error', 'Error', 'Ha ocurrido un error a eliminar.');
                            console.error(error);
                        });
                }
            });
        });
    });

</script>
<script>
    // Define una función para mostrar el SweetAlert
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

// Botón de eliminar
var deleteButtons = document.querySelectorAll('.formEliminar[data-method="delete"]');

Array.prototype.slice.call(deleteButtons)
    .forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "This action is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = button.getAttribute('href');
                    axios.delete(url)
                        .then(function(response) {
                            if (response.data && response.data.mensaje) {
                                Swal.fire({
                                    title: 'Question deleted!',
                                    text: response.data.mensaje,
                                    icon: 'success'
                                }).then(() => {
                                    // Utiliza la función showSweetAlert para recargar la página
                                    showSweetAlert('success', 'Success', response.data.mensaje, 1500);
                                });
                            }
                        })
                        .catch(function(error) {
                            // Mostrar SweetAlert de error
                            showSweetAlert('error', 'Error', 'An error occurred.', 1500);
                            console.error(error);
                        });
                }
            });
        });
    });
// Define una función para mostrar el SweetAlert
// Define una función para mostrar el SweetAlert
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

// Botón de eliminar
var deleteButtons = document.querySelectorAll('.formEliminar2[data-method="delete"]');

Array.prototype.slice.call(deleteButtons)
    .forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "This action is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = button.getAttribute('href');
                    axios.delete(url)
                        .then(function(response) {
                            if (response.data && response.data.mensaje) {
                                // Verificar si la respuesta del servidor contiene un mensaje de éxito
                                showSweetAlert('success', 'Success', response.data.mensaje, 1500);
                            } else {
                                // Mostrar SweetAlert de error en caso de problemas
                                showSweetAlert('error', 'Error', 'An error occurred1.', 1500);
                            }
                        })
                        .catch(function(error) {
                            // Mostrar SweetAlert de error en caso de problemas con la solicitud
                            showSweetAlert('error', 'Error', 'An error occurred2.', 1500);
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
        }).then(function () {
            // Recargar la página después del SweetAlert
            location.reload();
        });
    }

    // Configura el evento para el formulario de edición
    document.querySelectorAll('.formEditar').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar que el formulario se envíe de inmediato
            var editForm = this;

            // Realizar una solicitud AJAX para enviar el formulario de edición
            axios.post(editForm.action, new FormData(editForm))
                .then(function (response) {
                    if (response.status === 200 && response.data.mensaje) {
                        // Mostrar el SweetAlert de éxito
                        showSweetAlert('success', 'Éxito', response.data.mensaje, 1500);
                    } else {
                        // Mostrar el SweetAlert de error en caso de problemas
                        showSweetAlert('error', 'Error', 'Ha ocurrido un error al intentar editar el tipo de beneficiario.');
                    }
                })
                .catch(function (error) {
                    // Mostrar el SweetAlert de error en caso de problemas
                    showSweetAlert('error', 'Error', 'Ha ocurrido un error al intentar editar el tipo de beneficiario.');
                });
        });
    });
</script>

<!-- Alerta para guardar y editar -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Exito!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
        });
    </script>
@endif

<!-- Datatable postulados -->
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": [
                {
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
            'color': 'white' // Color del texto en el botón PDF
        });

        $('.excel-button').css({
            'background-color': 'green',
            'color': 'white' // Color del texto en el botón Excel
        });
    });
</script>

