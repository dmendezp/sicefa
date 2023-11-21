@extends('gth::layouts.master')

@section('content')
@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Funcionarios </h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                            data-bs-target="#crearModal">
                            Crear Tipo de Funcionarios
                        </button>
                        <table id="employeetype" class="table table-striped table-bordered shadow-lg mt-4"
                            style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('gth::employees.new_officials')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Detecta cambios en el campo "Número de Documento"
        $('#document_number').on('change', function() {
            var numeroDocumento = $(this).val();

            // Realiza una solicitud AJAX para obtener los datos de la persona
            $.ajax({
                url: '{{ route('cefa.gth.getPersonDatas') }}', // Utiliza la ruta configurada en web.php
                method: 'GET',
                data: {
                    document_number: numeroDocumento
                },
                success: function(data) {
                    // Rellena los campos con los datos de la persona
                    $('#full_name').val(data.full_name);
                },
                error: function() {
                    // Maneja errores si es necesario
                }
            });
        });
    </script>

@endsection
