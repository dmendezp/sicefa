@push('head')
<!-- DataTables-1.13.4 -->
<link rel="stylesheet" href="{{ asset('libs/DataTables-1.13.4/DataTables-1.13.4/css/dataTables.bootstrap5.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables-1.13.4  -->
<script src="{{ asset('libs/DataTables-1.13.4/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/DataTables-1.13.4/DataTables-1.13.4/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    language_datatables = { // Traducción a español de datatables
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
</script>
@endpush
