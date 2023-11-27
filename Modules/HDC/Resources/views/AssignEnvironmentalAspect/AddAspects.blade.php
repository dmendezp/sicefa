@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a style="text-decoration: none"
            href="{{ route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.table') }}">{{ trans('hdc::ConsumptionRegistry.Title_Card_Records_Saver') }}
        </a> /{{ trans('hdc::ConsumptionRegistry.indicator_form') }}</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-success card-outline shadow mt-6">
                        <div class="card-body">
                            <label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Productive_Unit') }}</label>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend w-100">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-user-alt fs-10"></i>
                                            </span>
                                            <select class="form-select" name="productive_unit_id" id="productive_unit_id">
                                                <option value="">
                                                    --{{ trans('hdc::ConsumptionRegistry.Select_Productive_Unit') }}--
                                                </option>
                                                @foreach ($productive_unit as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="div-actividades"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-1 float -end  text-justify" id="div-aspectos"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@push('scripts')
    <script>
        // Cuando se cambia la unidad productiva seleccionada
        $(document).on("change", "#activity_id", function() {
            // Obtener el valor seleccionado del campo 'activity_id'
            var activity_id = $(this).val();

            if (activity_id == '') {
                $("#div-aspectos").html('');
            } else {
                var myObjet = new Object();
                myObjet.activity_id = activity_id;
                var myString = JSON.stringify(myObjet);

                // Realizar la solicitud AJAX y reemplazar el contenido de 'div-aspectos'
                ajaxReplace("div-aspectos", '/hdc/admin/Aspect', myString);

                // Realizar una solicitud GET para obtener datos adicionales
                var url = "{{ route('cefa.hdc.getEnvironmentalAspects', ':id') }}";
                $.get(url, function(data) {
                    console.log("Datos recibidos:", data);

                    // Desmarcar todas las casillas de verificación
                    $('input[name="Environmental_Aspect"]').prop('checked', false);

                    // Marcar las casillas de verificación según los datos recibidos
                    data.forEach(function(aspectId) {
                        $('#Aspecto' + aspectId).prop('checked', true);
                    });
                });
            }
        });

        // Cuando se cambia la unidad productiva seleccionada
        $(document).on("change", "#productive_unit_id", function() {
            unit_id = $(this).val();
            if (unit_id == '') {
                $("#div-actividades").html('');
            } else {
                var myObjet = new Object();
                myObjet.productive_unit_id = $('#productive_unit_id').val();
                var myString = JSON.stringify(myObjet);
                ajaxReplace("div-actividades", '/hdc/admin/Aspect/activities', myString);
            }
        });
    </script>
@endpush
