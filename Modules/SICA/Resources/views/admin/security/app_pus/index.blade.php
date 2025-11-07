@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>Asociación de aplicaciones y unidades productivas</h4>
                            </div>
                            <div class="col-md">
                                <a href="{{ route('sica.admin.security.apps.index') }}" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Aplicaciones
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sica.admin.security.apps.app_pus.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Aplicación:</label>
                                        <select name="app_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($apps as $a)
                                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($productive_units as $pu)
                                                <option value="{{ $pu->id }}">{{ $pu->name }}</option>
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
                                                <th class="text-center">Aplicación</th>
                                                <th>Bodega</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $previous_app_id = null;
                                            @endphp
                                            @foreach ($app_pus as $apu)
                                                @if ($previous_app_id !== $apu->app_id)
                                                    <tr>
                                                        <td class="text-center" rowspan="{{ $app_pus->where('app_id', $apu->app_id)->count() }}">
                                                            <h3 style="color: {{ $apu->app->color }}"><i class="fas {{ $apu->app->icon }}"></i></h3>
                                                            {{ $apu->app->name }}
                                                        </td>
                                                @else
                                                    <tr>
                                                @endif
                                                    <td style="vertical-align: middle">{{ $apu->productive_unit->name }}</td>
                                                    <td class="text-center"  style="vertical-align: middle">
                                                        <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la asociación de la aplicación {{ $apu->app->name }} y la unidad productiva {{ $apu->productive_unit->name }}?')) { document.getElementById('delete-form-apu{{ $apu->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-apu{{ $apu->id }}" action="{{ route('sica.admin.security.apps.app_pus.destroy', $apu) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    $previous_app_id = $apu->app_id;
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
