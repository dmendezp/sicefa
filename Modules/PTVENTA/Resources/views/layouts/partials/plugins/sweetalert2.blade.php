@push('head')
<!-- Sweealert2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
<!-- Sweealert2  -->
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
@endpush
