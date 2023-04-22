<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
{{-- Boostrap 5 --}}
<link rel="stylesheet" href=" {{ asset('ptventa/libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"> {{-- Se llaman todos los estilos de bootstrap 5.3.0 de manera local desde la ruta que esta mencionanda --}}
{{-- Sweetalert2 --}}
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script type="text/javascript">
    @if (Session::has('message_ptventa'))
        Swal.fire({
            @if (Session::get('message_ptventa_type') == 'success')
                title: 'Operación realizada',
                text: '{{ Session::get('message_ptventa') }}',
                icon: 'success',
                iconColor: 'green',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green',
            @endif
            @if (Session::get('message_ptventa_type') == 'error')
                title: 'Operación rechada',
                text: '{{ Session::get('message_ptventa') }}',
                icon: 'error',
                iconColor: 'red',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green',
            @endif
        });
    @endif
</script>


