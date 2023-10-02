@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid" style="max-width:1200px">
    <div class="row justify-content-md-center pt-4">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Vista de Consulta</h3>
                </div>
                <div class="box-body">
                    <!-- Contenido de la vista en un solo card -->
                    <div class="card shadow col-md-12">
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
                                        <th>Nombre del Aprendiz</th>
                                        <th>Número de Documento</th>
                                        <th>Porcentaje de Descuento (Alimentación)</th>
                                        <th>Número de Ruta (Transporte)</th>
                                        <th>Nombre de Ruta (Transporte)</th>
                                        <th></th> <!-- Columna en blanco -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí puedes agregar filas de datos si es necesario -->
                                    @isset($aprendiz)
                                    <tr>
                                        <td>{{ $aprendiz->nombre_aprendiz }}</td>
                                        <td>{{ $aprendiz->numero_documento }}</td>
                                        <td>{{ $aprendiz->porcentaje_descuento_alimentacion }}</td>
                                        <td>{{ $aprendiz->numero_ruta_transporte }}</td>
                                        <td>{{ $aprendiz->nombre_ruta_transporte }}</td>
                                        <td></td> <!-- Puedes dejar esta columna en blanco o agregar contenido adicional -->
                                    </tr>
                                    @endisset
                                </tbody>
                            </table>

                            <!-- Botón "Más info" debajo del título "Nombre de Ruta (Transporte)" -->
<div class="text-center mt-3">
    <button class="btn btn-primary" style="background-color: #00FF22; color: #000000;" data-toggle="modal" data-target="#infoModal">Más info</button>
</div>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Información Adicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <p>Aquí puedes agregar la información adicional que deseas mostrar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

                                            
                        </div>
                    </div>
                    <!-- Fin del contenido en un solo card -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
