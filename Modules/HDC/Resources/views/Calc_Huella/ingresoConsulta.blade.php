@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::calculatefootprint.Indicator_Calculate_Your_Footprint') }} </li>
@endpush

@push('head')
    <!-- Sweealert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush

@section('title', 'calcular')

@section('content')

    <div class="content">

        <div class="container-fluid mt">
            <div class="row justify-content-center">
                <div class="card card-success card-outline shadow col-md-5 mt-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('hdc::calculatefootprint.Title_Card_Enter_User') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="user_id">{{ trans('hdc::calculatefootprint.label_Title_User_Document') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-user-alt"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('documento', null, [
                                        'id' => 'documento',
                                        'class' => 'form-control',
                                        'placeholder' => 'Digite numero de identifación',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success mt-4" onclick="verficarUsuario()">{{ trans('hdc::calculatefootprint.Btn_Check_Your_Fingerprint') }}</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div id="respuesta"></div>

        </div>
    </div><!-- /.container-fluid -->
@stop

@push('scripts')
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        function verficarUsuario() {
            documento = $('#documento').val();
            if (documento == '') {
                return;
            }

            ruta = window.location.origin + '/hdc/calculos/persona/' + documento;

            $.ajax({
                method: "get",
                url: ruta,
                data: {},
                success: function(response) {
                    if (response.mensaje === 'Persona No Encontrada') {
                        // Mostrar SweetAlert de error si la persona no se encuentra
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Persona No Encontrada',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        // Actualizar el contenido con los datos de la persona
                        $("#respuesta").html(response);
                        $('#documento').val('');
                        console.log(response);
                    }
                }
            });
        }

    </script>

@endpush
