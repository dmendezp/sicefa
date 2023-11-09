@extends('agrocefa::layouts.master')

@section('content')
    <div class="container">
    <h3>Reporte Labores Culturales</h3>
    
<br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_unit"> Seleccione la Unidad Productiva</label>
                    <select name="product_unit" class="form-control" required id="productUnitSelect">
                        <option value="">Seleccione la unidad</option>
                        @foreach (array_combine($environmentIds, $environmentNames) as $id => $name)
                            <option value="{{ $id }}" {{ old('product_unit') == $id ? 'selected' : '' }}>
                                {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div id="cropsSelectContainer" style="display: none;">
                    <div class="form-group">
                        <label for="cropsSelect">Cultivos Asociados</label>
                        <select name="crops" class="form-control" id="cropsSelect">
                            <option value="">Seleccione el cultivo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
{{-- mostras labores asociadas al cultivo selecionado --}}
    <div id="filteredLabors">
        @include('agrocefa::Reports.resultlabor')
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Manejador de eventos para el cambio en el campo "Unidad Productiva"
        $('#productUnitSelect').on('change', function() {
            var selectedProductId = $(this).val();

            if (selectedProductId) {
                $.ajax({
                    url: '{{ route('agrocefa.crops_by_unit') }}',
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
        $('#productUnitSelect').on('change', function() {
            var selectedProductId = $(this).val(); // Obtener el ID de la unidad productiva seleccionada
            var cropsSelectContainer = $('#cropsSelectContainer'); // Contenedor del campo de selección de cultivos

            if (selectedProductId) {
                // Si se selecciona una unidad productiva, muestra el campo de selección de cultivos
                cropsSelectContainer.show();
            } else {
                // Si no se selecciona ninguna unidad productiva, oculta el campo de selección de cultivos
                cropsSelectContainer.hide();
            }
        });

        $(document).ready(function() {
            // Escuchar el evento de cambio en el select con id "cropsSelect"
            $('#cropsSelect').on('change', function() {
                // Obtener el valor seleccionado
                var selectedCrop = $(this).val();

                // Verificar si se ha seleccionado un cultivo
                if (selectedCrop) {
                    // Mostrar el contenedor de fechas
                    $('#dateFields').show();
                } else {
                    // Ocultar el contenedor de fechas si no se selecciona un cultivo
                    $('#dateFields').hide();
                }
            });
        });


        // Cuando cambia la selección de cultivo
        $('#cropsSelect').change(function() {
            var selectedCropId = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados de labores filtrados por cultivo
            $.ajax({
                type: 'POST',
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

        //mostrar campos de busqueda por fecha cuando se seleccione el cultivo
        $(document).ready(function() {
    // Cuando cambie el valor del select 'cropsSelect'
    $("#cropsSelect").change(function() {
        // Obtén el valor seleccionado
        var selectedCrop = $(this).val();
        
        // Si se selecciona un cultivo (no es un valor vacío), muestra los campos del formulario
        if (selectedCrop !== "") {
            $("#filterForm").show();
        } else {
            // Si no se selecciona un cultivo, oculta los campos del formulario
            $("#filterForm").hide();
        }
    });
});
    </script>
@endsection
