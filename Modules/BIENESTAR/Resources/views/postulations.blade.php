@extends('bienestar::layouts.master')

@section('content')
    <div class="container-fluid">
        <h1>Listado de Aprendices Afiliados <i class="fas fa-clipboard-list"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="container">
                    <br><h1>Numero de Documento</h1></br>
                    <!-- Agrega el formulario de búsqueda -->
                    <form action="{{ route('cefa.bienestar.busqueda') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="number" name="busqueda" class="form-control" placeholder="Ingrese numero de documento de el aprendiz">
                            <div class="input-group-append">
                                <button class="btn btn-success btn-block" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <!-- Resto de tu contenido -->
                </div>
            </div>
        </div>
    </div>
@endsection
