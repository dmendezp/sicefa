@push('head')
    <!-- DataTables-1.13.4 -->
    <link rel="stylesheet" href="{{ asset('libs/DataTables-1.13.4/DataTables-1.13.4/css/dataTables.bootstrap5.min.css') }}">
@endpush

@push('scripts')
    <!-- DataTables-1.13.4 -->
    <script src="{{ asset('libs/DataTables-1.13.4/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/DataTables-1.13.4/DataTables-1.13.4/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        window.language_datatables = { // Traducción a español de datatables
            "decimal": "",
            "emptyTable": "{{ trans('sia::controllers.SIA_datatables_empty') }}",
            "info": "{{ trans('sia::controllers.SIA_datatables_info') }}",
            "infoEmpty": "{{ trans('sia::controllers.SIA_datatables_info_empty') }}",
            "infoFiltered": "{{ trans('sia::controllers.SIA_datatables_info_filtered') }}",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "{{ trans('sia::controllers.SIA_datatables_length_menu') }}",
            "loadingRecords": "{{ trans('sia::controllers.SIA_datatables_loading') }}",
            "processing": "{{ trans('sia::controllers.SIA_datatables_processing') }}",
            "search": "{{ trans('sia::controllers.SIA_datatables_search') }}",
            "zeroRecords": "{{ trans('sia::controllers.SIA_datatables_zero_records') }}",
            "paginate": {
                "first": "{{ trans('sia::controllers.SIA_datatables_paginate_first') }}",
                "last": "{{ trans('sia::controllers.SIA_datatables_paginate_last') }}",
                "next": "{{ trans('sia::controllers.SIA_datatables_paginate_next') }}",
                "previous": "{{ trans('sia::controllers.SIA_datatables_paginate_previous') }}"
            }
        };
    </script>
@endpush