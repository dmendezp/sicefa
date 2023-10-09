@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>Listado de Aprendices Afiliados <i class="fas fa-clipboard-list"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="container">
                <h2>Número de Documento</h2>
                <!-- Agrega el formulario de búsqueda -->
                <form action="{{ route('cefa.bienestar.busqueda') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="number" name="busqueda" class="form-control" placeholder="Ingrese número de documento del aprendiz">
                        <div class="input-group-append">
                            <button class="btn btn-success btn-block" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>

                @if(session('no_resultados'))
                <div class="alert alert-danger mt-3">
                    No se encontraron resultados en la base de datos.
                </div>
                @else
                <!-- Si se encontraron resultados, muestra los nombres y apellidos -->
                <div class="mt-3">
                    @foreach($resultados as $aprendiz)
                        <p>Primer Nombre: {{ $aprendiz->primer_nombre }}</p>
                        <p>Segundo Nombre: {{ $aprendiz->segundo_nombre }}</p>
                        <p>Primer Apellido: {{ $aprendiz->primer_apellido }}</p>
                        <p>Segundo Apellido: {{ $aprendiz->segundo_apellido }}</p>
                    @endforeach
                </div>
                @endif
                <!-- Resto de tu contenido -->
            </div>
        </div>
    </div>
</div>
@endsection
