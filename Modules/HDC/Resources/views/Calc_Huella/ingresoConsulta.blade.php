@extends('hdc::layouts.master')

@section('title', 'calcular')

@section('content')

    <div class="content">

        <div class="container-fluid mt">
            <div class="row justify-content-center">
                <div class="card card-success card-outline shadow col-md-5 mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese su usuario</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="user_id">Documento de usuario</label>
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
                                <button class="btn btn-success mt-4" onclick="verficarUsuario()">Verificar</button>
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
@section('js')
    <script>
        function verficarUsuario(){
            documento = $('#documento').val();
            if(documento == ''){
                alert('Ingrese el número de identifación para realizar la verifcación.');
            }else{
                ruta = 'http://sicefa.test:8081/hdc//verificar-persona'+documento;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "get",
                    url: ruta,
                    data: {}
                })
                .done(function(html){
                    $("#respuesta").html(html);
                    $('#documento').val('');
                });
            }
        }
    </script>
@stop

