@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Unidades productivas</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.units.productive_unit.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Registrar unidad productiva
                            </a>
                        </div>
                        <div class="mtop16">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="productive_units_table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th class="text-center">Icono</th>
                                            <th>Líder</th>
                                            <th class="text-center">Sector</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productive_units as $pw)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $pw->name }}</td>
                                                <td>{{ $pw->description }}</td>
                                                <td class="text-center">
                                                    <h1><i class="{{ $pw->icon }}"></i></h1>
                                                </td>
                                                <td>{{ $pw->person->full_name }}</td>
                                                <td class="text-center">{{ $pw->sector->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sica.admin.units.productive_unit.edit', $pw) }}" data-toggle='tooltip' data-placement="top" title="Editar">
                                                        <i class="fas fa-edit text-success"></i>
                                                    </a>
                                                    <a href="{{ route('sica.admin.units.productive_unit.destroy', $pw) }}" data-toggle='tooltip' data-placement="top" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta unidad productiva?')">
                                                        <i class="fas fa-trash-alt text-danger"></i>
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
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#productive_units_table').DataTable({});
        });
    </script>
@endsection
