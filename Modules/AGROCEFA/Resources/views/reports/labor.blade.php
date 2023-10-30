@extends('agrocefa::layouts.master')

@section('content')

<div class="container">
    <h3>Reporte Labores Culturales</h3>

    <div class="form-group">
        <label for="product_unit">Seleccione la unidad</label>
        <select name="product_unit" class="form-control" required id="productUnitSelect">
            <option value="">Seleccione la unidad</option>
            @foreach(array_combine($environmentIds, $environmentNames) as $id => $name)
                <option value="{{ $id }}" {{ old('product_unit') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    
    <div id="cropsSelectContainer" style="display: none;">
        <div class="form-group">
            <label for="cropsSelect">Cultivos Asociados</label>
            <select name="crops" class="form-control" id="cropsSelect">
                <option value="">Seleccione el cultivo</option>
            </select>
        </div>
    </div>

    <div id="dateFields" style="display: none;">
        <form id="filterForm" method="GET" action="{{ route('agrocefa.reports.filterByFecha') }}">
            @csrf
            <div class="form-group">
                <label for="startDate">{{ trans('agrocefa::reports.Start_Date') }}</label>
                <input type="date" class="form-control" name="startDate" id="startDate">
            </div>
    
            <div class="form-group">
                <label for "endDate">{{ trans('agrocefa::reports.End_Date') }}</label>
                <input type="date" class="form-control" name="endDate" id="endDate">
            </div>
    
            <button type="submit" style="margin-top: 10px" class="btn btn-primary">{{ trans('agrocefa::reports.Btn_Filter') }}</button>
        </form>
    </div>

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


</script>

@endsection