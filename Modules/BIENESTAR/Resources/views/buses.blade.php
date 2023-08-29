@extends('bienestar::layouts.adminlte')

@section('content')
 <h1>Insertar Bus</h1>
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Columna 1: Placa -->
                        <div class="col-md-3">
                            <label for="placa">Placa:</label>
                            <input type="text" class="form-control" id="placa">
                        </div>
                        
                        <!-- Columna 2: Conductor -->
                        <div class="col-md-3">
                            <label for="conductor">Conductor:</label>
                            <input type="text" class="form-control" id="conductor">
                        </div>
                        
                        <!-- Columna 3: Cupos y Botón Guardar -->
                        <div class="col-md-3">
                            <label for="cupos">Cupos:</label>
                            <input type="number" class="form-control" id="cupos">
                        </div>
                        <div class="col-md-3 align-self-end">
                        <button class="btn btn-primary mt-3" style="background-color: #00FF22; color: black;">Guardar</button>

                        </div>
                    </div>
                    <div class="row">
    <div class="col-md-12">
        <h2>Listado de Buses</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Conductor</th>
                    <th>Placa</th>
                    <th>Cupos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td> </td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-sm btn-info">Editar</button>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
                <!-- Repite este bloque para cada bus en tu lista -->
            </tbody>
        </table>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
