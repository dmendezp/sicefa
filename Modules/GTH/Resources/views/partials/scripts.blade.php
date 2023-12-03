
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
<script src="{{ asset('libs/DataTables-1.13.4/datatables.min.css') }}"></script>
<script src="{{ asset('libs/DataTables-1.13.4/datatables.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://kit.fontawesome.com/dbfa94ab11.js" crossorigin="anonymous"></script>
<script src="{{ asset('modules/gth/js/sidebar.js') }}" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>



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






