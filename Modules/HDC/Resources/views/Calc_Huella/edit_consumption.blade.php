@extends('hdc::layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>Editar Valor de Consumo</strong></h2>
            </div>
            <br>
            <div class="container">
                <form method="post" action="{{ route('carbonfootprint.update_consumption', $personEnvironmentalAspect->id) }}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="consumption_value">Nuevo Valor de Consumo:</label>
                        <input name="consumption_value" class="form-control" type="number" value="{{ $personEnvironmentalAspect->consumption_value }}">
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
