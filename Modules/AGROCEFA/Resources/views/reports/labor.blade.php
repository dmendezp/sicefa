@extends('agrocefa::layouts.master')

@section('content')
    <h2>{{ trans('agrocefa::balancelabor.Cultural Work Report') }}</h2>

    <div class="container">
        <!-- Div para mostrar notificaciones -->
        <div id="notification" class="alert alert-danger" style="display: none;"></div>
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'agrocefa.reports.filterlabor', 'method' => 'POST']) !!}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('lot', trans('agrocefa::balance.environment')) !!}
                            {!! Form::select(
                                'lot',
                                ['' => trans('agrocefa::balance.select_lot')] +
                                    collect($environmentData)->pluck('name', 'id')->toArray(),
                                old('lot'),
                                ['class' => 'form-control', 'required', 'id' => 'lotSelect'],
                            ) !!}
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('crop', trans('agrocefa::balance.crop')) !!}
                            {!! Form::select('crop', [], old('crop'), ['class' => 'form-control', 'required', 'id' => 'cropSelect']) !!}
                        </div>

                    </div>
                    <br>
                </div>

                {!! Form::hidden('sown_area', null, ['id' => 'sownArea']) !!}

                {!! Form::close() !!}
            </div>
        </div>
        <br>
        <div id="filteredLabors">
            @include('agrocefa::reports.resultlabor')
        </div>

        <div id="laborDetails">
            @include('agrocefa::reports.laborDetails')
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        // Manejador de eventos para el cambio en el campo "Actividad"
        $('#lotSelect').on('change', function() {
            var selectedProductId = $(this).val();

            if (selectedProductId) {
                $.ajax({
                    url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.reports.consumable.getCropsBylot') }}',
                    method: 'GET',
                    data: {
                        unit: selectedProductId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.cropIds) {
                            var cropsSelect = $('#cropSelect');
                            cropsSelect.empty();
                            cropsSelect.append(new Option('Seleccione el cultivo', ''));

                            // Recorre los arreglos cropIds y cropNames y crea opciones
                            for (var i = 0; i < response.cropIds.length; i++) {
                                var id = response.cropIds[i];
                                var name = response.cropNames[i];
                                cropsSelect.append(new Option(name, id));
                            }

                            $('#cropsSelectContainer').show();
                        }
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
            } else {
                $('#cropsSelectContainer').hide();
            }
        });
    </script>

    <script>
        // Cuando cambia la selección de cultivo
        $('#cropSelect').change(function() {
            var selectedCropId = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados de labores filtrados por cultivo
            $.ajax({
                type: 'POST', // Asegúrate de que estás usando el método POST
                url: "{{ route('agrocefa.reports.filterlabor') }}",
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
