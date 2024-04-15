@extends('agrocefa::layouts.master')

@section('content')
    <div class="container">
        <h3>{{ trans('agrocefa::reports.ConsumptionReport') }}</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lot">{{ trans('agrocefa::reports.Lot') }}</label>
                            <select name="lot" class="form-control" required id="lotSelect">
                                <option value="">{{ trans('agrocefa::reports.Select_lot') }}</option>
                                @foreach (array_combine($environmentIds, $environmentNames) as $id => $name)
                                    <option value="{{ $id }}" {{ old('lot') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cropsSelect">{{ trans('agrocefa::reports.Crop') }}</label>
                            <select name="crops" class="form-control" id="cropsSelect">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        
        <div id="resultTableContainer">
            <!-- Aquí se mostrará la tabla de resultados -->
        </div>

        <script>
            $(document).ready(function() {
                // Manejador de eventos para el cambio en el campo "Unidad Productiva"
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
                                    var cropsSelect = $('#cropsSelect');
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


                // Manejador de eventos para el cambio en el campo "Unidad Productiva muestra el campo cuando se selecciona el lote "
                $('#lotSelect').on('change', function() {
                    var selectedProductId = $(this).val(); // Obtener el ID de la unidad productiva seleccionada
                    var cropsSelectContainer = $(
                    '#cropsSelectContainer'); // Contenedor del campo de selección de cultivos

                    if (selectedProductId) {
                        // Si se selecciona una unidad productiva, muestra el campo de selección de cultivos
                        cropsSelectContainer.show();
                    } else {
                        // Si no se selecciona ninguna unidad productiva, oculta el campo de selección de cultivos
                        cropsSelectContainer.hide();
                    }
                });

                // Manejador de eventos para el cambio en el campo "Lote"
                $('#cropsSelect').on('change', function() {
                    var selectedCrop = $(this).val();
                    
                    if (selectedCrop) {
                        $.ajax({
                            url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.reports.consumable.resultreport') }}',
                            method: 'GET',
                            data: {
                                _token: '{{ csrf_token() }}',
                                crop: selectedCrop,
                            },
                            success: function(response) {
                                $('#resultTableContainer').html(response);
                            },
                            error: function() {
                                console.error('Error en la solicitud AJAX');
                            }
                        });
                    }
                });

            });
        </script>
    @endsection
