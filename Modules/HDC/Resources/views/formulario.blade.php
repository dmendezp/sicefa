@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Formulario</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <label>Unidad Productiva</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
                                    </span>
                                    <select class="form-select" name="productive_unit_id" id="productive_unit_id">
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($productive_unit as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="div-actividades"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-8">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <h5>Resultados:</h5>
                            <div class="mt-2" id="div-tabla"></div>
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
        $(document).on("change", "#productive_unit_id", function() {
            unit_id = $(this).val();
            if (unit_id == '') {
                $("#div-actividades").html('Seleccione la unidad');
            } else {
                var myObjet = new Object();
                myObjet.productive_unit_id = $('#productive_unit_id').val();
                var myString = JSON.stringify(myObjet);
                ajaxReplace("div-actividades", '/hdc/get_activities', myString)

            }
        });
    </script>
@endpush
 @push('scripts')
    <script>
        // Cuando se cambia la unidad productiva seleccionada
        $(document).on("change", "#activity_id", function() {
        // Obtener el valor seleccionado del campo 'activity_id'
             activity_id = $(this).val();
            if (activity_id == '') {
                $("#div-tabla").html('Seleccione la unidad');
            } else {
                var myObjet = new Object();
                myObjet.activity_id = $('#activity_id').val();
                var myString = JSON.stringify(myObjet);
                 {{--  console.log('Datos enviados:', myString);  --}}
                 console.log('Mary se jodio con una pequeña consulta');

                ajaxReplace("div-tabla", '/hdc/aspecto_ambiental/', myString);
            }
        });
    </script>
@endpush

