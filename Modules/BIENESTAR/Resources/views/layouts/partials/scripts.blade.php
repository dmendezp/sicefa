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