@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Fincas</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.location.farms.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Registrar finca
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="table_farms" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Responsable</th>
                                        <th class="text-center">Localización</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($farms as $f)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $f->name }}</td>
                                            <td>{{ $f->description }}</td>
                                            <td>{{ $f->person->full_name }}</td>
                                            <td class="text-center">{{ $f->municipality->cou_dep_mun }}</td>
                                            <td class="text-center">
                                                <div class="text-center">
                                                    <a href="{{ route('sica.admin.location.farms.edit', $f) }}" data-toggle='tooltip' data-placement="top" title="Actualizar finca">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('sica.admin.location.farms.destroy', $f) }}" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la finca {{ $f->name }}?')) { document.getElementById('delete-form-farm{{ $f->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar finca">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-farm{{ $f->id }}" action="{{ route('sica.admin.location.farms.destroy', $f) }}" method="POST" style="display: none;">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#table_farms').DataTable({});
        });
    </script>
@endsection
