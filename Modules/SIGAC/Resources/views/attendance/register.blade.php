@extends('sigac::layouts.master')

@push('title')
    <h1 class="m-0">{{ $view['titleView'] }}</h1>
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::attendance.Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sigac::attendance.Register') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>{{ trans('sigac::attendance.CardTitle') }}</h3>
            <div class="row">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="technologist" class="form-label">{{ trans('sigac::attendance.CardSubtitle') }}</label>
                        <select id="technologist" class="form-select" aria-label="Default select example">
                            <option selected disabled>{{ trans('sigac::attendance.Select...') }}</option>
                            <option value="1">Prueba 1</option>
                            <option value="2">Prueba 2</option>
                            <option value="3">Prueba 3</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="producto">{{ trans('sigac::attendance.Current date and time') }}</label>
                                <p class="card-text" id="fecha-hora"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start-training"
                                    class="form-label">{{ trans('sigac::attendance.Start of training') }}</label>
                                <p id="start-training">16/05/2023 12:50</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end-training"
                                    class="form-label">{{ trans('sigac::attendance.End of training') }}</label>
                                <p id="end-training">16/05/2023 12:50</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fas fa-plus"></i> {{ trans('sigac::attendance.Register Previous') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        {{ trans('sigac::attendance.Choose the technologist') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>{{ trans('sigac::attendance.Select...') }}</option>
                        <option value="1">Prueba 1</option>
                        <option value="2">Prueba 2</option>
                        <option value="3">Prueba 3</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ trans('sigac::attendance.Close') }}</button>
                    <button type="button" class="btn btn-success">{{ trans('sigac::attendance.Accept') }}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableAttendance">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">{{ trans('sigac::attendance.Code') }}</th>
                                    <th scope="col">{{ trans('sigac::attendance.Name') }}</th>
                                    <th scope="col">{{ trans('sigac::attendance.Document Number') }}</th>
                                    <th scope="col">{{ trans('sigac::attendance.Accumulated Faults') }}</th>
                                    <th scope="col">{{ trans('sigac::attendance.Attendance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Usuario de Prueba 1</td>
                                    <td>1000870965</td>
                                    <td>1</td>
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
                                    <td>4</td>
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
                                    <td>6</td>
                                    <td>
                                        <div class="wrapper-custom">
                                            <input type="checkbox" />
                                            <div class="btn"></div>
                                            <div class="tooltip">
                                                <svg>
                                                    <use xlink:href="#icon-01" class="icon" />
                                                </svg>
                                                <svg>
                                                    <use xlink:href="#icon-02" class="icon" />
                                                </svg>
                                                <svg>
                                                    <use xlink:href="#icon-03" class="icon" />
                                                </svg>
                                                <svg>
                                                    <use xlink:href="#icon-04" class="icon" />
                                                </svg>
                                            </div>

                                            <!-- SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 22" id="icon-01">
                                                    <!-- Código SVG del nuevo icono -->
                                                    <!-- Por ejemplo, un icono de la letra "p" -->
                                                    <text x="10" y="20" style="font-size: 24px;">P</text>
                                                </symbol>
                                                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 22" id="icon-02">
                                                    <!-- Código SVG del nuevo icono -->
                                                    <!-- Por ejemplo, un icono de la letra "p" -->
                                                    <text x="10" y="20" style="font-size: 24px;">FJ</text>
                                                </symbol>
                                                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 22" id="icon-03">
                                                    <!-- Código SVG del nuevo icono -->
                                                    <!-- Por ejemplo, un icono de la letra "p" -->
                                                    <text x="10" y="20" style="font-size: 24px;">FI</text>
                                                </symbol>
                                                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 22" id="icon-04">
                                                    <!-- Código SVG del nuevo icono -->
                                                    <!-- Por ejemplo, un icono de la letra "p" -->
                                                    <text x="10" y="20" style="font-size: 24px;">MD</text>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>{{ trans('sigac::attendance.Summary of the session') }}</h4>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <h5 class="text-center">{{ trans('sigac::attendance.Legend') }}</h5>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">{{ trans('sigac::attendance.Type') }}</h5>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">{{ trans('sigac::attendance.Quantity') }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-center">P</h6>
                            </div>
                            <div class="col-4">
                                <p>{{ trans('sigac::attendance.Total present:') }}</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">35</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-center">FJ</h6>
                            </div>
                            <div class="col-4">
                                <p>{{ trans('sigac::attendance.Total justified failures:') }}</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">5</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-center">FI</h6>
                            </div>
                            <div class="col-4">
                                <p>{{ trans('sigac::attendance.Total unjustified failures:') }}</p>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <h6 class="text-center">13</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-center">MF</h6>
                            </div>
                            <div class="col-4">
                                <p>{{ trans('sigac::attendance.Total missing stockings:') }}</p>
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
    <script>
        $(document).ready(function() {
            /* Initialización of Datatables ---Category */
            $('#tableAttendance').DataTable({
                // opciones de configuración para la tabla 1
            });
        });
    </script>
@endsection
