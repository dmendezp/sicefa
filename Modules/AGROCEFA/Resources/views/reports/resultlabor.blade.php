@if (!empty($filteredLabors) && count($filteredLabors) > 0)
    <div class="card">
        <div class="card-header">
            {{ trans('agrocefa::balancelabor.Cultural Work Report') }}
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('agrocefa::balancelabor.Labor ID') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Activity') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Responsible') }}</th>
                        <th>{{ trans('agrocefa::balance.executiondate') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Description') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Total Cost') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Comment') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Destination') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Details') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredLabors as $labor)
                        <tr data-labor-id="{{ $labor->id }}">
                            <td>{{ $labor->id }}</td>
                            <td>{{ optional($labor->activity)->name }}</td>
                            <td>{{ optional($labor->person)->first_name }}</td>
                            <td>{{ $labor->execution_date }}</td>
                            <td>{{ $labor->description }}</td>
                            <td>{{ $labor->price }}</td>
                            <td>{{ $labor->observations }}</td>
                            <td>{{ $labor->destination }}</td>
                            <style>
                                .custom-btn {
                                    background-color: #3498db;
                                    color: #fff;
                                    padding: 10px 20px;
                                    font-size: 16px;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                }
                            </style>

                            <!-- ... -->

                            <td>
                                <button class="custom-btn btn-show-details">
                                    {{ trans('agrocefa::balancelabor.Details') }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <br>
    @if (isset($no_found))
        <p>{{ $no_found }}</p>
    @endif
    
@endif
<script>
    // Cuando se hace clic en una fila de la tabla de labores
    $('#example1 tbody').on('click', 'tr', function() {
        // Obtiene el ID de la labor de la fila clicada
        var laborId = $(this).data('labor-id');

        // Realiza una solicitud AJAX para obtener los detalles de la labor y sus componentes
        $.ajax({
            type: 'GET',
            url: "{{ route('agrocefa.reports.laborDetails') }}",
            data: {
                laborId: laborId
            },
            success: function(data) {
                // Actualiza el contenedor con los detalles de la labor
                $('#laborDetails').html(data);

                // Muestra el contenedor de detalles
                $('#laborDetails').show();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Cuando se hace clic en el botón "Cerrar Detalles"
    $('#closeDetails').on('click', function() {
        // Oculta el contenedor de detalles
        $('#laborDetails').hide();
    });

    // Cuando se hace clic en el botón "Detalle"
    $('#example1 tbody').on('click', '.btn-show-details', function(e) {
        e.stopPropagation(); // Detiene la propagación del evento para evitar conflictos con el clic en la fila
        var laborId = $(this).closest('tr').data('labor-id');

        // Realiza una solicitud AJAX para obtener los detalles de la labor y sus componentes
        $.ajax({
            type: 'GET',
            url: "{{ route('agrocefa.reports.laborDetails') }}",
            data: {
                laborId: laborId
            },
            success: function(data) {
                // Actualiza el contenedor con los detalles de la labor
                $('#laborDetails').html(data);

                // Muestra el contenedor de detalles
                $('#laborDetails').show();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>
