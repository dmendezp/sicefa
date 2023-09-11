@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Instructores</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="#" class="btn btn-primary" disabled>
                                <i class="fas fa-user-plus"></i>
                                Registrar instructor
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="table_instructors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Documento</th>
                                        <th>Nombre</th>
                                        <th>Vinculación</th>
                                        <th>Especialidad</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">
                                            <div class="opts">
                                                <a href="#" class="text-success" data-toggle='tooltip' data-placement="top" title="Actualizar instructor" disabled>
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="text-danger" data-toggle='tooltip' data-placement="top" title="Eliminar instructor" disabled>
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $("#table_instructors").DataTable({});
        });
    </script>
@endsection
