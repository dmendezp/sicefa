<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
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
{{-- Select2 --}}
<script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- Sweetalert2 --}}
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script type="text/javascript">
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

    @if (Session::has('message_cpd'))
        Swal.fire({
            @if (Session::get('message_cpd_type') == 'success')
                title: 'Operación realizada',
                text: '{{ Session::get('message_cpd') }}',
                icon: 'success',
                iconColor: 'green',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green',
            @endif
            @if (Session::get('message_cpd_type') == 'error')
                title: 'Operación rechada',
                text: '{{ Session::get('message_cpd') }}',
                icon: 'error',
                iconColor: 'red',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green',
            @endif
        })
    @endif
</script>
