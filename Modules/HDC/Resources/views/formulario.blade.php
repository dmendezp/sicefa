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
                    <label>Unidad Productiva</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend w-100">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
                            </span>
                            <select class="form-select" name="productive_unit_id" id="productive_unit_id">
                                <option value="">-- Seleccione --</option>
                                @foreach($productive_unit as $unit)
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
    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Cuando se cambia la unidad productiva seleccionada
        $(document).on("change", "#productive_unit_id", function() {
            unit_id = $('#productive_unit_id').val();
            if(unit_id == ''){
                $("#div-actividades").html('');
            }else{
                ruta = window.location.origin + '/hdc/get_activities/' + $('#productive_unit_id').val(); // Obtener ruta para consultar por ajax
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "get",
                    url: ruta,
                    data: {}
                })
                .done(function(html){
                    console.log(html);
                    $("#div-actividades").html(html);
                    $('#productive_unit_id').val('');
                });
            }
        });
@endpush

