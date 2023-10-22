@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <h1 class="text-center">Número de Documento</h1>
                <div class="card-body">
                    <!-- Agrega el formulario de búsqueda -->
                    <form action="{{ route('cefa.bienestar.search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="number" name="search" class="form-control" placeholder="Ingrese número de documento del aprendiz">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (isset($resultados) && count($resultados) > 0)
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    @foreach ($resultados as $resultado)
                    <ul class="list-unstyled">
                        <div class="form-container">
                            <h3>Información Personal</h3>
                            <div class="form-group">
                                <label for="document_number">Documento:</label>
                                <input type="text" id="document_number" value="{{ $resultado->document_number }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="first_name">Nombre:</label>
                                <input type="text" id="first_name" value="{{ $resultado->first_name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Primer Apellido:</label>
                                <input type="text" value="{{ $resultado->first_last_name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Segundo Apellido:</label>
                                <input type="text" value="{{ $resultado->second_last_name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="code">Código del curso:</label>
                                <input type="text" id="code" value="{{ $resultado->code }}" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre del programa:</label>
                                <input type="text" id="name" value="{{ $resultado->name }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="personal_email">Email personal:</label>
                                <input type="text" id="personal_email" value="{{ $resultado->personal_email }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="population_group_id">Nivel del Sisben:</label>
                                <input type="text" id="population_group_id" value="{{ $resultado->sisben_level }}" class="form-control" readonly>
                            </div>
                        </div>
                    </ul>
                    @endforeach
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Beneficios Disponibles</h4>
                    <p>Elija el beneficio al que desea postularse. Puede elejir los 2*</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="benefits[]" id="alimentacion" value="Alimentacion">
                        <label class="form-check-label" for="alimentacion">Alimentación</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="benefits[]" id="transporte" value="Transporte">
                        <label class="form-check-label" for="transporte">Transporte</label>
                    </div>

                    <!-- Agrega más beneficios aquí con el mismo formato -->
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
