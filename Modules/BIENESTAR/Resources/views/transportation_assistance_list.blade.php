@extends('bienestar::layouts.master')

@section('content') 

    <h1>Asistencia De Transporte <i class="fas fa-bus"></i></h1>

    <div class="container-fluid" style="max-width: 1200px;">
        <div class="row justify-content-md-center pt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Tabla de Asistencias -->
                        <div class="container mt-4">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>id</th>
                                        <th>Aprendiz</th>
                                        <th>ruta de transporte</th>
                                        <th>Convocatoria</th>
                                        <th>acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- Puedes iterar sobre los datos reales aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
