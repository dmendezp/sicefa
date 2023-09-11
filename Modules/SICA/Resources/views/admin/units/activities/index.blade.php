@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Actividades</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.units.activities.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Registrar actividad
                            </a>
                        </div>
                        <div class="mtop16">
                            <div class="table-responsive">
                                <table class="table table-striped" id="activities_table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Actividad</th>
                                            <th data-toggle='tooltip' data-placement="top" title="Unidad productiva">U. productiva</th>
                                            <th data-toggle='tooltip' data-placement="top" title="Tipo de actividad">Tipo</th>
                                            <th>Descripción</th>
                                            <th class="text-center">Periodo</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activities as $a)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $a->name }}</td>
                                                <td>{{ $a->productive_unit->name }}</td>
                                                <td>{{ $a->activity_type->name }}</td>
                                                <td>{{ $a->description }}</td>
                                                <td class="text-center">{{ $a->period }}</td>
                                                <td class="text-center">{{ $a->status }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sica.admin.units.activities.edit', $a) }}" data-toggle='tooltip' data-placement="top" title="Editar actividad">
                                                        <i class="fas fa-edit text-success"></i>
                                                    </a>
                                                    <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la actividad {{ $a->name }}?')) { document.getElementById('delete-form-activity{{ $a->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar actividad">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-activity{{ $a->id }}" action="{{ route('sica.admin.units.activities.destroy', $a) }}" method="POST" style="display: none;">
                                                        @csrf               
                                                        @method('DELETE')
                                                    </form>
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
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#activities_table').DataTable({});
        });
    </script>
@endsection
