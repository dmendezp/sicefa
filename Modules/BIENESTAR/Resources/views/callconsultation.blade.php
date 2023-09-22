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
                        <!-- Contenido de la vista -->

                        <div class="card">
                            <div class="card-header">
                                <!-- Encabezado del card -->
                            </div>
                            <div class="card-body text-center"> <!-- Centramos el contenido en el card verticalmente -->
                                <form>
                                    <div class="form-group">
                                        <label for="numero_documento">Número de Documento</label>
                                        <div class="col-md-6 mx-auto"> <!-- Centramos el campo numérico horizontalmente -->
                                            <input type="number" class="form-control" id="numero_documento" name="numero_documento">
                                        </div>
                                    </div>
                                    <!-- Otros campos y botones de formulario si es necesario -->
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
