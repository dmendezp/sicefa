
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src='{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.js') }}'></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Include Bootstrap  -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.js.map') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js.map') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.js.map') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.min.js.map') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://kit.fontawesome.com/dbfa94ab11.js" crossorigin="anonymous"></script>
<script src="{{ asset('modules/gth/js/sidebar.js') }}" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

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



<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

<!-- Alerta para guardar y editar -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Exito!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 4000 // Tiempo en milisegundos (2 segundos en este caso)
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
            timer: 4000 // Tiempo en milisegundos (2 segundos en este caso)
        });
    </script>
@endif

<!-- Alerta para guardar y editar -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Exito!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 4000 // Tiempo en milisegundos (2 segundos en este caso)
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
            timer: 4000 // Tiempo en milisegundos (2 segundos en este caso)
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
                    }
                },
                "copy", "csv", "excel", "print", "colvis"
            ]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
</script>




