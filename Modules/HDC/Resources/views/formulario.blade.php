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
                            <label for="user_id">Unidades Productivas</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
                                    </span>
                                </div>
                                @csrf {{-- Este token es necesario para enviar información de manera segura --}}
                                <select class="form-select w-200" id="unit-select" aria-label="Default select example">
                                    <option selected>Seleccione la unidad productiva</option>
                                    @foreach ($productive_unit as $unit){{-- Consulta de las unidades productivas de sicefa --}}
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>

                                <div class="d-flex justify-content-center mt-6">
                                    <button class="btn btn-success" id="labor-btn">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div id="labor"></div>
    </div>
</div>

<script>
    function formulariolabor(){
        $(document).ready(function () {
            // Agregar un evento que se dispare cuando se haga clic en el botón "Aceptar".
            $('#labor-btn').click(function () {
                // Obtener el valor seleccionado en el select
                var selectedUnit = $('#unit-select').val();
                // ruta = 'http://sicefa.test:8081/hdc/Formulariolabor';  --}}
                $.ajax({
                    url:'/Formulariolabor', //ruta + '/' + selectedUnit, // Corregir la construcción de la URL
                    method: 'GET',
                    success: function (data) {
                        // Insertar la vista cargada en el contenedor
                        $('#labor').html(data);
                    },
                });
            });
        });



    }
</script>

@endsection
