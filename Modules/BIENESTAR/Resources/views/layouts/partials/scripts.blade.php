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
@if (session('success'))
<script>
  Swal.fire({
  icon: 'success',
  title: 'Exito!',
  text: '{{ session('success') }}',
  showConfirmButton: false,
  timer: 2000
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
  timer: 2000
});
</script>
@endif