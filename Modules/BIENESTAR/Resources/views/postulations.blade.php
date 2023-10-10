@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="container">
                <br>
                <h1>Numero de Documento</h1></br>
                <!-- Agrega el formulario de búsqueda -->
                <form action="{{ route('cefa.bienestar.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="number" name="search" class="form-control" placeholder="Ingrese numero de documento de el aprendiz">
                        <div class="input-group-append">
                            <button class="btn btn-success btn-block" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if (isset($resultados))
    <div class="container-fluid">
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="container">
                @foreach ($resultados as $resultado)
                        <h1>Resultado de la búsqueda:</h1>
                        <ul>
                            <label for="">Documento:</label>
                            <input type="text" value="{{ $resultado->document_number }}" class="form-control" readonly>
                            <label for="">Nombre:</label>
                            <input type="text" value="{{ $resultado->first_name }}" class="form-control" readonly>
                            <label for="">Primer Apellido:</label>
                            <input type="text" value="{{ $resultado->first_last_name }}" class="form-control" readonly>
                            <label for="">Segundo Apellido:</label>
                            <input type="text" value="{{ $resultado->second_last_name }}" class="form-control" readonly>
                            <label for="">Código del curso:</label>
                            <input type="text" value="{{ $resultado->code }}" class="form-control" readonly>
                            <label for="">Nombre del programa:</label>
                            <input type="text" value="{{ $resultado->name }}" class="form-control" readonly>
                            <label for="">Email personal:</label>
                            <input type="text" value="{{ $resultado->personal_email }}" class="form-control" readonly> 
                            <label for="">Grupo Social ID:</label>
                            <input type="text" value="{{ $resultado->population_group_id }}" class="form-control" readonly>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection