<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('ptventa/libs/jquery-3.6.4.min.js') }}"></script>

<link rel="stylesheet" href=" {{ asset('ptventa/libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"> {{-- Se llaman todos los estilos de bootstrap 5.3.0 de manera local desde la ruta que esta mencionanda --}}


<script type="text/javascript">
    @if (Session::has('message_cafeto'))
        Swal.fire({
            @if (Session::get('message_cafeto_type') == 'success')
                title: 'Operación realizada',
                text: '{{ Session::get('message_cafeto') }}',
                icon: 'success',
                iconColor: 'green',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green',
            @endif
            @if (Session::get('message_cafeto_type') == 'error')
                title: 'Operación rechada',
                text: '{{ Session::get('message_cafeto') }}',
                icon: 'error',
                iconColor: 'red',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green',
            @endif
        });
    @endif
</script>