@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Asociación de unidades productivas y bodegas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3">
                                <form action="{{ route('sica.admin.units.pu_warehouses.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($productive_units as $pu)
                                                <option value="{{ $pu->id }}">{{ $pu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bodega:</label>
                                        <select name="warehouse_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($warehouses as $w)
                                                <option value="{{ $w->id }}">{{ $w->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Sincronizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Unidad productiva</th>
                                                <th>Bodega</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $previous_pu_id = null;
                                        @endphp
                                        @foreach ($productive_unit_warehouses as $puw)
                                            @if ($previous_pu_id !== $puw->productive_unit_id)
                                                <tr>
                                                    <td rowspan="{{ $productive_unit_warehouses->where('productive_unit_id', $puw->productive_unit_id)->count() }}">
                                                        {{ $puw->productive_unit->name }}
                                                    </td>
                                                @php
                                                    $rowspanCount = $productive_unit_warehouses->where('productive_unit_id', $puw->productive_unit_id)->count();
                                                @endphp
                                            @else
                                                <tr>
                                            @endif
                                                <td>{{ $puw->warehouse->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sica.admin.units.pu_warehouses.destroy', $puw) }}" data-toggle='tooltip' data-placement="top" title="Eliminar"
                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar la asociación de la unidad productiva {{ $puw->productive_unit->name }} y la bodega {{ $puw->warehouse->name }}?')">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $previous_pu_id = $puw->productive_unit_id;
                                            @endphp
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
    </div>
@endsection
