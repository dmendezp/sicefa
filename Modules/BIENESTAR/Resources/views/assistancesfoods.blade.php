@extends('bienestar::layouts.master')

@section('content')
    <div class="container-fluid">
        <h1>Listado de Aprendices Afiliados <i class="fas fa-pizza-slice"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">
                    {!! Form::open(['url' => route('cefa.bienestar.AssistancesFoods.store'), 'method' => 'POST']) !!}
                    @csrf
                    <!-- Campo de búsqueda -->
                    <div class="row p-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar..." id="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="searchButton"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Cuadro con la tabla -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Aprendiz</th>
                                    <th>Beneficiario</th>
                                    <th>Programa</th>
                                    <th>Ficha</th>
                                    <th>Porcentaje</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

