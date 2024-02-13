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
                        <div class="mtop16">
                            <table id="table_instructors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th>Documento</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Tipo de Empleado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($instructors as $i)
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $i->person->fullname }}</td>
                                        <td class="text-center">{{ $i->person->document_number }}</td>
                                        <td>{{ $i->person->misena_email }}</td>
                                        <td>{{ $i->person->telephone1 }}</td>
                                        <td>{{ $i->employee_type->name }}</td>
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
                                        @endforeach
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
