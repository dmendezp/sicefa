@push('head')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
    <!-- SweetAlert2 -->
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        @if (session('message_sia'))
            Swal.fire({
                @if (session('message_sia_type') == 'success')
                    title: '{{ trans('sia::controllers.SIA_apprentice_operation_success') }}',
                    text: '{{ session('message_sia') }}',
                    icon: 'success',
                    iconColor: 'green',
                    confirmButtonText: '{{ trans('sia::controllers.SIA_apprentice_action_accept') }}',
                    confirmButtonColor: 'green',
                @elseif (session('message_sia_type') == 'error')
                    title: '{{ trans('sia::controllers.SIA_apprentice_operation_rejected') }}',
                    text: '{{ session('message_sia') }}',
                    icon: 'error',
                    iconColor: 'red',
                    confirmButtonText: '{{ trans('sia::controllers.SIA_apprentice_action_accept') }}',
                    confirmButtonColor: 'green',
                @endif
            });
        @endif
    </script>
@endpush