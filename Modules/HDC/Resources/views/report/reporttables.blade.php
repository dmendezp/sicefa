<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-body">
                <h3 class="text-center font-weight-bold">{{ trans('Reporte Huella de Carbono') }}</h3>
                <table class="table table-bordered custom-table-style" id="carbonTable">
                    <thead>
                        <tr>
                            <th>{{ trans('hdc::report.Sector_Column') }}</th>
                            <th>Unidad Productiva</th>
                            <th>Huella de Carbono</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCarbonBySector = [];
                            $groupedAspects = collect($aspectosAmbientales)->groupBy('sector_name');
                        @endphp

                        @foreach ($groupedAspects as $sectorName => $aspects)
                                {{-- Muestra el nombre del sector solo una vez --}}
                                <tr>
                                    <td rowspan="{{ count($aspects) }}">{{ $sectorName }}</td>
                                    <td>{{ $aspects[0]['productive_unit_name'] }}</td>
                                    <td>{{ $aspects[0]['carbon_footprint'] }}</td>
                                    <td rowspan="{{ count($aspects) }}">
                                        @php
                                            // Suma los carbon_footprint de cada aspecto para el total del sector
                                            $totalCarbonBySector[$sectorName] = $aspects->sum('carbon_footprint');
                                            echo $totalCarbonBySector[$sectorName];
                                        @endphp
                                    </td>
                                </tr>

                                @for ($i = 1; $i < count($aspects); $i++)
                                    {{-- Verifica si hay carbon_footprint antes de mostrar la fila --}}
                                    @if ($aspects[$i]['carbon_footprint'] > 0)
                                        <tr>
                                            <td>{{ $aspects[$i]['productive_unit_name'] }}</td>
                                            <td>{{ $aspects[$i]['carbon_footprint'] }}</td>
                                        </tr>
                                    @endif
                                @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Hoja de estilo de DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

<!-- jQuery (asegúrate de incluirlo antes de DataTables) -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- DataTables (JavaScript) -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<!-- jsPDF -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<!-- Botones de DataTables (para exportar a PDF) -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<!-- Estilos adicionales para los botones (opcional) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<!-- Configuración de DataTables y botones -->
<script>
    $(document).ready(function () {
        // Inicializa DataTable
        var table = $('#carbonTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Descargar PDF',
                    filename: 'reporte',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
    });
</script>
@endpush
