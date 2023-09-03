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
                                        @foreach ($productive_units as $pu)
                                            <option value="{{ $pu->id }}">{{ $pu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Recurso:</label>
                                    <select name="Resource_id" class="form-control" required>
                                        <option value="">-- Seleccione --</option>
                                        @foreach($Resource as $re)
                                            <option value="{{ $re->id }}">{{ $re->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Sincronizar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection