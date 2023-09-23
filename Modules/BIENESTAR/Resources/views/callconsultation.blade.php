@extends('bienestar::layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vista de Consulta</h3>
                    </div>
                    <div class="box-body">
                        
                        <!-- Contenido de la vista en un solo card -->
                        <div class="card">
                            <div class="card-body text-center"> <!-- Centramos el contenido en el card verticalmente -->
                                <form>
                                    <div class="form-group">
                                        <div class="input-group col-md-6 mx-auto"> <!-- Centramos el campo numérico horizontalmente -->
                                            <input type="number" class="form-control" id="numero_documento" name="numero_documento" placeholder="Documento Identidad">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Otros campos y botones de formulario si es necesario -->
                                </form>

                                <!-- Tabla con 5 columnas y estilo -->
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Aprendiz</th>
                                            <th>Programa</th>
                                            <th>Ficha</th>
                                            <th>Apoyo</th>
                                            <th></th> <!-- Columna en blanco -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Aquí puedes agregar filas de datos si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Fin del contenido en un solo card -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
