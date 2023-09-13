@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>Unidades productivas</h4>
                            </div>
                            <div class="col-md">
                                <a href="{{ route('sica.admin.units.productive_units.environment_pus.index') }}" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Relación de ambientes y unidades productivas
                                </a>
                            </div>
                        </div>
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
                                            <th class="text-center">Finca</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productive_units as $pu)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $pu->name }}</td>
                                                <td>{{ $pu->description }}</td>
                                                <td class="text-center">
                                                    <h1><i class="{{ $pu->icon }}"></i></h1>
                                                </td>
                                                <td>{{ $pu->person->full_name }}</td>
                                                <td class="text-center">{{ $pu->sector->name }}</td>
                                                <td class="text-center">{{ $pu->farm->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sica.admin.units.productive_unit.edit', $pu) }}" data-toggle='tooltip' data-placement="top" title="Editar">
                                                        <i class="fas fa-edit text-success"></i>
                                                    </a>
                                                    <a href="{{ route('sica.admin.units.productive_unit.destroy', $pu) }}" data-toggle='tooltip' data-placement="top" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar la unida productiva {{ $pu->name }}?')">
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
