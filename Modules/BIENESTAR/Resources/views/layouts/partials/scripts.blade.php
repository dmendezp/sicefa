<!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
    <!-- js general -->
    <script src="{{ asset('../bienestarxd/js/script.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/fullcalendar/main.js') }}"></script>
    <!-- SweatAlert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
    'use strict';
    // Selecciona todos los formularios con la clase "formEliminar"
    var forms = document.querySelectorAll('.formEliminar');

    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita que el formulario se envíe de inmediato

                Swal.fire({
                    title: "Are you sure?'",
                    text: "It is an irreversible process.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, delete it'",
                    cancelButtonText: "Cancel" // Cambiar el texto del botón "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario usando AJAX
                        axios.post(form.action, new FormData(form))
                            .then(function(response) {
                                // Manejar la respuesta JSON del servidor
                                if (response.data && response.data.mensaje) {
                                    Swal.fire({
                                        title: 'Vacancy deleted!',
                                        text: response.data.mensaje,
                                        icon: 'success'
                                    }).then(() => {
                                        // Recargar la página u otra acción según sea necesario
                                        location
                                            .reload(); // Recargar la página después de eliminar
                                    });
                                }
                            })
                            .catch(function(error) {
                                // Manejar errores si es necesario
                                console.error(error);
                            });
                    }
                });
            });
        });

</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Configura el evento para el formulario de creación
    document.querySelector('.formCrear').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe de inmediato
        var form = this;

        // Realizar una solicitud AJAX para enviar el formulario
        axios.post(form.action, new FormData(form))
            .then(function (response) {
                if (response.status === 200 && response.data.mensaje) {
                    // Mostrar el SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.data.mensaje,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        // Recargar la página después del SweetAlert
                        location.reload();
                    });
                } else {
                    // Mostrar el SweetAlert de error en caso de problemas
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al intentar crear el tipo de beneficiario.'
                    });
                }
            })
            .catch(function (error) {
                // Mostrar el SweetAlert de error en caso de problemas
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al intentar crear el tipo de beneficiario.'
                });
            });
    });

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
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.data.mensaje,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            // Recargar la página después del SweetAlert
                            location.reload();
                        });
                    } else {
                        // Mostrar el SweetAlert de error en caso de problemas
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error al intentar editar el tipo de beneficiario.'
                        });
                    }
                })
                .catch(function (error) {
                    // Mostrar el SweetAlert de error en caso de problemas
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al intentar editar el tipo de beneficiario.'
                    });
                });
        });
    });
});
</script>






<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.formCrear').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe de inmediato
        var form = this;

        // Realizar una solicitud AJAX para enviar el formulario
        axios.post(form.action, new FormData(form))
            .then(function (response) {
                if (response.status === 200) {
                    if (response.data.mensaje) {
                        // Mostrar el SweetAlert de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.data.mensaje,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            // Recargar la página después del SweetAlert
                            location.reload();
                        });
                    } else if (response.data.restaurado) {
                        // Mostrar un SweetAlert para indicar que se ha restaurado un registro
                        Swal.fire({
                            icon: 'info',
                            title: 'Información',
                            text: 'El tipo de beneficiario existía y se ha restaurado correctamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            // Recargar la página después del SweetAlert
                            location.reload();
                        });
                    }
                } else {
                    // Mostrar el SweetAlert de error en caso de problemas
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al intentar crear el tipo de beneficiario.'
                    });
                }
            })
            .catch(function (error) {
                // Mostrar el SweetAlert de error en caso de problemas
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al intentar crear el tipo de beneficiario.'
                });
            });
    });
});
</script>




