@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">Administrar Recursos</li>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-green card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">ADMINISTRAR RECURSOS</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 pr-3 pb-3">
                            <form action="{{ route('sica.admin.units.pu_warehouses.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Unidad Productiva:</label>
                                    <select name="productive_unit_id" class="form-control" required>
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($productive_unit as $pro) {{-- Consulta las unidades productivas de SICEFA --}}
                                            <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Recurso:</label>
                                    <select name="Resource_id" class="form-control" required>
                                        <option value="">-- Seleccione --</option>
                                        @foreach($resource as $re)
                                            <option value="{{ $re->id }}">{{ $re->name }}</option>
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
                                <table class="table table-bordered table-stripped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Unidad Productiva</th>
                                            <th>Recurso Utilizado</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $previos_pro_id = null;
                                        @endphp
                                        @foreach ($resource as $re)
                                            @if ($previos_pro_id !== $pror->productive_unit_id)
                                                <tr>
                                                    <td style="vertical-align: middle" rowspan="{{ $productive_unit_resource->where('productive_unit_id', $pror->productive_unit_id)->count() }}">
                                                    {{ $pror->productive_unit->name }}
                                                    </td>
                                                @php
                                                    $rowspanCount = $productive_unit_resource->where('productive_unit_id', $pror->productive_unit_id)->count();
                                                @endphp
                                            @else
                                                <tr>
                                            @endif
                                            <td>{{ $re->resource->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('hdc.Adminresources.destroy', $re) }}" data-toogle='tooltip' data-placement="top" title="Eliminar"
                                                    onclick="return confirm('¿Estas Seguro Que Deseas Eliminar La Asociación De La Unidad Productiva {{ $pror->productive_unit->name }} Y El Recurso {{ $pror->resource->name }}?')">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $previos_pro_id = $pror->productive_unit_id;
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