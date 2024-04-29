@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#">{{ trans('sigac::attendance.Breadcrumb_Active_Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::attendance.Breadcrumb_Register') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="environment"
                                    class="form-label">{{ trans('sigac::attendance.Title_Card_Select_Environment') }}</label>
                                <select id="environment" class="form-select" aria-label="Default select example">
                                    <option selected disabled>{{ trans('sigac::attendance.Select...') }}</option>
                                    <option value="#">Prueba</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="technologist"
                                    class="form-label">{{ trans('sigac::attendance.Title_Card_Select_Technologist') }}</label>
                                <select name="course_id" class="form-select" aria-label="Default select example">
                                    <option value="">{{ trans('sigac::attendance.Select...') }}</option>
                                        <option value="#">
                                            Prueba
                                        </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="producto">{{ trans('sigac::attendance.Title_Current_Date') }}</label>
                                        <p class="card-text" id="fecha-hora"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start-training"
                                            class="form-label">{{ trans('sigac::attendance.Title_Start_Training') }}</label>
                                        <p id="start-training">16/11/2023 07:30</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end-training"
                                            class="form-label">{{ trans('sigac::attendance.Title_End_training') }}</label>
                                        <p id="end-training">16/11/2023 12:50</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <i class="fas fa-plus"></i>
                                            {{ trans('sigac::attendance.Btn_Register_Previous') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('sigac::attendance.Title_Summary_Session') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <dl>
                                <dt>P</dt>
                                <dd>{{ trans('sigac::attendance.Text_Total_Present') }} 0</dd>
                            </dl>
                            <dl>
                                <dt>FJ</dt>
                                <dd>{{ trans('sigac::attendance.Text_Total_Justified_Failures') }} 0</dd>
                            </dl>
                        </div>
                        <div class="col-6">
                            <dl>
                                <dt>FI</dt>
                                <dd>{{ trans('sigac::attendance.Text_Total_Unjustified_Failures') }} 0</dd>
                            </dl>
                            <dl>
                                <dt>MD</dt>
                                <dd>{{ trans('sigac::attendance.Text_Total_Missing_Stockings') }} 0</dd>
                            </dl>
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
                        {{ trans('sigac::attendance.Title_Modal_Register_Previous') }}</h1>
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
                        data-bs-dismiss="modal">{{ trans('sigac::attendance.Btn_Close') }}</button>
                    <button type="button" class="btn btn-success">{{ trans('sigac::attendance.Btn_Accept') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (empty($apprentices))
                        <div class="text-center">{{ trans('sigac::attendance.E1_Text_No_Results') }}</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableAttendance">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">{{ trans('sigac::attendance.1T1_Code') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.1T2_Name') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.1T3_Document_Number') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.1T4_Accumulated_Faults') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.1T5_Attendance') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apprentices as $a)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $a->person->full_name }}</td>
                                            <td>{{ $a->person->document_number }}</td>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
@endpush
