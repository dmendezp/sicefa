@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h4>Trimestres</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.academy.quarters.create') }}" class="btn btn-primary ">
                                <i class="fas fa-plus"></i> Registrar Trimestre
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="quarters_table" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Trimestre</th>
                                        <th class="text-center">Fecha de inicio</th>
                                        <th class="text-center">Fecha de finalización</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quarters as $q)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $q->name }}</td>
                                            <td class="text-center">{{ $q->start_date }}</td>
                                            <td class="text-center">{{ $q->end_date }}</td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    <a href="{{ route('sica.admin.academy.quarters.edit', $q) }}" class="mr-1" data-toggle='tooltip' data-placement="top" title="Actualizar trimestre">
                                                        <i class="fas fa-edit text-success"></i>
                                                    </a>
                                                    <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar el trimestre {{ $q->name }}?')) { document.getElementById('delete-form-quarter{{ $q->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar trimestre">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-quarter{{ $q->id }}" action="{{ route('sica.admin.academy.quarters.destroy', $q) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#quarters_table').DataTable({});
        });
    </script>
@endsection