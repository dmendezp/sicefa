@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Ambientes de formación</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="#" class="btn btn-primary" disabled>
                                <i class="fas fa-calendar-plus"></i>
                                Registrar ambiente
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="table_environments" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Coordenadas</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($environments as $e)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $e->name }}</td>
                                            <td class="text-center">{{ $e->type_environment }}</td>
                                            <td class="text-center">{{ $e->length }} / {{ $e->latitude }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle='tooltip' data-placement="top" title="Actualizar ambiente" disabled>
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="text-danger" data-toggle='tooltip' data-placement="top" title="Eliminar ambiente" disabled>
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
            $("#table_environments").DataTable({});
        });
    </script>
@endsection
