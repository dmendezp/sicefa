@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Formulario</li>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card card-success card-outline shadow col-md-5 mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="product_unit">Unidades Productivas</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
                                    </span>
                                </div>
                                <form method="post" action="{{ route('hdc.activities') }}">
                                    @csrf <!-- Esto es para protección CSRF en Laravel -->
                                    <select name="product_unit" id="product_unit">
                                        @foreach($productive_unit as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="activity">Selecciona una actividad:</label>
                                    <select name="activity" id="activity">
                                        <!-- Aquí se cargarán las actividades dinámicamente -->
                                    </select>

                                    <button type="submit">Consultar Actividades</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div id="actividades"></div>
    </div>
</div>

@push('scripts')
<script>
    // Cuando se cambia la unidad productiva seleccionada
    $(document).on("change", "#product_unit", function() {
        var unitId = $(this).val(); // Obtener el ID de la unidad productiva seleccionada
        var requestData = { unit_id: unitId };

        // Realizar una petición AJAX para obtener las actividades relacionadas
        $.ajax({
            type: "POST",
            url: '/hdc/get-activities/', // Usar la ruta nombrada en Laravel
            data: requestData,
            dataType: "json",
            success: function(response) {
                var activitySelect = $("#activity");
                activitySelect.empty(); // Limpiar el select de actividades

                // Llenar el select de actividades con las actividades recibidas
                $.each(response.activities, function(key, activity) {
                    activitySelect.append(
                        $("<option>", {
                            value: activity.id,
                            text: activity.name
                        })
                    );
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("Error en la solicitud AJAX: " + errorThrown);
            }
        });
    });
</script>
@endpush

@endsection



