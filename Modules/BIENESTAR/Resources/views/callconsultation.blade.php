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

                            <!-- Otros campos y botones de formulario si es necesario -->

                            <!-- Tabla con 7 columnas y estilo -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="resultados_table">
                                <thead>
                                    <tr>
                                        <th>Nombre del Aprendiz</th>
                                        <th>Número de Documento</th>
                                        <th>Porcentaje de Descuento (Alimentación)</th>
                                        <th>Número de Ruta (Transporte)</th>
                                        <th>Nombre de Ruta (Transporte)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí se agregarán las filas con los datos -->
                                </tbody>
                            </table>
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
