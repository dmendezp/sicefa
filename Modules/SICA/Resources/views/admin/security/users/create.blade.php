@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-10">
                    <div class="card-header">
                        <h4>Formulario de registro de usuario</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="document_number" class="col-md-4 col-form-label text-md-right">Número de documento:</label>
                            <div class="input-group col-md-6">
                                <input id="document_number" type="number" class="form-control" name="document_number" autocomplete="document_number" autofocus>
                                <span class="input-group-append">
                                    <button id="btnSearch" type="button" class="btn btn-info ">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div id="divperson">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function password_specifications(){
            Swal.fire({
                title: '<strong>Contraseña</strong>',
                icon: 'info',
                html:
                    '<em class="text-left">'+
                        'La contraseña se genera automaticamente a partir de la siguiente combinación:'+
                        '<ol>'+
                            '<li>Toma los 2 primeros caracteres del <strong>nombre</strong>.</li>'+
                            '<li>Toma los 2 primeros caracteres del <strong>primer apellido</strong>.</li>'+
                            '<li>Se convierte todo a minúsculas con el primer caracter en mayúscula.</li>'+
                            '<li>Se agrega los 4 últimos dígitos del <strong>número de documento.</strong></li>'+
                        '</ol>'+
                    '</em>',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Entendido!',
                confirmButtonColor: '#27AE60'
            })
        }
    </script>
@endsection
