
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- DataTables -->
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



<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('js/generalscripts.js') }}"></script>
<script src="{{ asset('modules/sica/js/scripts.js') }}"></script>

<script src="{{ asset('AdminLTE/plugins/fullcalendar/lib/main.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/fullcalendar/lib/locales-all.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

{{-- Sweatalert and toast --}}
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/toastr/toastr.min.js') }}"></script>


<!-- Highcharts -->
<script src="{{ asset('Highcharts/code/highcharts.js') }}"></script>
<script src="{{ asset('Highcharts/code/highcharts-3d.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/data.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/exporting.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/accessibility.js') }}"></script>

<script type="text/javascript">
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

    // Configuración mostrar un alert sencillo en la esquina superior derecha
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    @if (Session::get('message'))
          /* Show the message */
          @if (Session::get('icon') == 'success')
              toastr.success("{{ Session::get('message') }}");
          @elseif (Session::get('icon') == 'error')
              toastr.error("{{ Session::get('message') }}");
          @endif
      @endif
</script>

