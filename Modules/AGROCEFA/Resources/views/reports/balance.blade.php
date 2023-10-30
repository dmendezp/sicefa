@extends('agrocefa::layouts.master')

@section('content')
    <h2>Reporte Consumo</h2>

    <div class="container">
        <!-- Div para mostrar notificaciones -->
        <div id="notification" class="alert alert-danger" style="display: none;"></div>
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'agrocefa.reports.filterbalance', 'method' => 'POST']) !!}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('lot', 'Lote') !!}
                            {!! Form::select(
                                'lot',
                                ['' => 'Seleccione el Lote'] +
                                    collect($environmentData)->pluck('name', 'id')->toArray(),
                                old('lot'),
                                ['class' => 'form-control', 'required', 'id' => 'lotSelect'],
                            ) !!}
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('crop', 'Cultivo') !!}
                            {!! Form::select('crop', [], old('crop'), ['class' => 'form-control', 'required', 'id' => 'cropSelect']) !!}
                        </div>

                    </div>
                    <br>
                </div>

                {!! Form::hidden('sown_area', null, ['id' => 'sownArea']) !!}

                {!! Form::close() !!}
            </div>
        </div>

        <div id="filteredLabors">
            @include('agrocefa::reports.resultsbalance')
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Manejador de eventos para el cambio en el campo "Actividad"
        $('#lotSelect').on('change', function() {
            var selectedlotId = $(this).val(); // Obtener el ID de la actividad seleccionada

            // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
            $.ajax({
                url: '{{ route('agrocefa.obtenerecrop') }}',
                method: 'GET',
                data: {
                    lot: selectedlotId
                },
                success: function(response) {
                    // Manejar la respuesta de la solicitud AJAX aquí
                    console.log('Respuesta de la solicitud AJAX:', response);

                    // Verificar si hay responsables en la respuesta
                    if (response.crop_data.length > 0) {
                        // Actualizar el campo de selección de responsables con las opciones recibidas
                        var cropSelect = $('#cropSelect');
                        cropSelect.empty(); // Vaciar las opciones actuales
                        cropSelect.append(new Option('Seleccione el Cultivo',
                            ''));

                        // Agregar las nuevas opciones desde el objeto de personas en la respuesta JSON
                        $.each(response.crop_data, function(index, crop) {
                            cropSelect.append(new Option(crop
                                .name, crop.id));
                        });
                    } else {
                        // Mostrar un campo de selección vacío y limpiar el campo "Receptor Responsable"
                        $('#cropSelect').val('');
                    }
                },
                error: function() {
                    // Manejar errores si la solicitud AJAX falla
                    console.error('Error en la solicitud AJAX');
                }
            });
        });
    </script>

    <script>
        // Cuando cambia la selección de cultivo
        $('#cropSelect').change(function() {
            var selectedCropId = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados de labores filtrados por cultivo
            $.ajax({
                type: 'POST',
                url: "{{ route('agrocefa.reports.filterbalance') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    crop: selectedCropId
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados de labores filtrados
                    $('#filteredLabors').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

@endsection
