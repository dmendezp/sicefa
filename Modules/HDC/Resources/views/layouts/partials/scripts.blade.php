<!-- Jquery -->
<script src="{{ asset('libs/jquery-3.6.4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- Boostrap-5.3.0 -->
<script src="{{ asset('libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js')}}"></script>

<!-- chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Highcharts -->
<script src="{{ asset('Highcharts/code/highcharts.js') }}"></script>
<script src="{{ asset('Highcharts/code/highcharts-3d.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/data.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/exporting.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/accessibility.js') }}"></script>
<script src="{{ asset('Highcharts/code/modules/drilldown.js') }}"></script>

{{--  Funcion AJAX  --}}
<script src="{{asset('js/generalscripts.js')}}"></script>
<!--sweetalert -->
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- SweatAlert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

{{--  <!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('js/generalscripts.js') }}"></script>
<script src="{{ asset('modules/sica/js/scripts.js') }}"></script>  --}}


@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            popup: 'my-custom-popup-class',
        },
    });
</script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 15000,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif


