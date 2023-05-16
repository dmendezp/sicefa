@extends('sigac::layouts.master')

@push('title')
    <h1 class="m-0">{{ $view['titleView'] }}</h1>
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Asistencia</a></li>
    <li class="breadcrumb-item active">Registro</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h3>Ambiente N°: 1</h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i> Registrar Anterior
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona el Tecnólogo</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Selecciona el Tecnólogo</option>
                                    <option value="1">Prueba 1</option>
                                    <option value="2">Prueba 2</option>
                                    <option value="3">Prueba 3</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecciona el Tecnólogo</option>
                        <option value="1">Prueba 1</option>
                        <option value="2">Prueba 2</option>
                        <option value="3">Prueba 3</option>
                    </select>
                </div>

                <div class="col-md-2 mx-1 my-1">
                    <div class="form-group">
                        <label for="producto">Fecha y hora actual</label>
                        <p class="card-text" id="fecha-hora"></p>
                    </div>
                </div>
                <div class="col-md-2 mx-1 my-1">
                    <div class="form-group">
                        <label for="producto">Inicio de la Formación</label>
                        <p>16/05/2023 12:50</p>
                    </div>
                </div>
                <div class="col-md-2 mx-1 m-1">
                    <div class="form-group">
                        <label for="precio">Fin de la Formación</label>
                        <p>16/05/2023 12:50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Cod</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Número de Documento</th>
                                <th scope="col">Asitencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Usuario de Prueba 1</td>
                                <td>1000870965</td>
                                <td>
                                    <select class="form-select form-select-sm my-select color-select"
                                        aria-label=".form-select-sm example">
                                        <option value="0">Seleccione</option>
                                        <option value="1">P</option>
                                        <option value="2">MF</option>
                                        <option value="3">FJ</option>
                                        <option value="4">FI</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Usuario de Prueba 2</td>
                                <td>1000432156</td>
                                <td>
                                    <select class="form-select form-select-sm my-select color-select"
                                        aria-label=".form-select-sm example">
                                        <option value="0">Seleccione</option>
                                        <option value="1">P</option>
                                        <option value="2">MF</option>
                                        <option value="3">FJ</option>
                                        <option value="4">FI</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Usuario de Prueba 3</td>
                                <td>1000653278</td>
                                <td>
                                    <select class="form-select form-select-sm my-select color-select"
                                        aria-label=".form-select-sm example">
                                        <option value="0">Seleccione</option>
                                        <option value="1">P</option>
                                        <option value="2">MF</option>
                                        <option value="3">FJ</option>
                                        <option value="4">FI</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>Resumen de la sesion</h4>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <div class="card">
                                    <h6 class="text-center">P</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <p>Total del presentes:</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">35</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="card">
                                    <h6 class="text-center">FJ</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <p>Total del fallas justificadas:</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">5</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="card">
                                    <h6 class="text-center">FI</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <p>Total del fallas injustificadas:</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">13</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="card">
                                    <h6 class="text-center">MF</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <p>Total de medias falta:</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">14</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.my-select').change(function() {
                var selectedOption = $(this).val();
                $(this).removeClass().addClass(
                    'form-select form-select-sm my-select color-select'
                ); // Restablecer las clases a sus valores predeterminados

                if (selectedOption === '1') {
                    $(this).addClass('green-background');
                } else if (selectedOption === '2') {
                    $(this).addClass('yellow-background');
                } else if (selectedOption === '3') {
                    $(this).addClass('orange-background');
                } else if (selectedOption === '4') {
                    $(this).addClass('red-background');
                }
            });
        });
    </script>
    <script>
        function actualizarHora() {
            var fecha_actual = new Date();
            var dia = fecha_actual.getDate();
            var mes = fecha_actual.getMonth() + 1; // Los meses en JavaScript son indexados desde 0
            var año = fecha_actual.getFullYear();
            var hora = fecha_actual.getHours();
            var minutos = fecha_actual.getMinutes();
            var segundos = fecha_actual.getSeconds();

            var fecha_formateada = dia + "/" + mes + "/" + año + " " + hora + ":" + minutos + ":" + segundos;
            document.getElementById("fecha-hora").innerHTML = fecha_formateada;
        }

        // Actualizar la hora cada segundo (1000 milisegundos)
        setInterval(actualizarHora, 1000);

        // Ejecutar la función por primera vez para mostrar la hora actual inmediatamente
        actualizarHora();
    </script>
@endsection
