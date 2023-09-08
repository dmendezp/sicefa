<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

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


<!--Sweetalert2 online para utilizar en la plantilla-->
<!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- trabajar con sweetalert en linea -->

<!--Sweetalert2 local para utilizar en la plantilla-->
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js') }}"></script>


<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- sweetalert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Full Calendar-->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.js"></script>
<!--traducción full calendar -->


<!-- axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.3/axios.min.js"
    integrity="sha512-L4lHq2JI/GoKsERT8KYa72iCwfSrKYWEyaBxzJeeITM9Lub5vlTj8tufqYk056exhjo2QDEipJrg6zen/DDtoQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- {{-- Sweatalert and toast --}} -->
<script src="{{ asset('AdminLTE/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

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



<script src="{{ asset('senaempresa/js/modal.js') }}"></script>
<script src="{{ asset('senaempresa/js/fecha_alerta.js') }}"></script>
