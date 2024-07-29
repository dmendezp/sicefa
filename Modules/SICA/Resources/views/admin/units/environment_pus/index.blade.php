@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>Asociación de ambientes y unidades productivas</h4>
                            </div>
                            <div class="col-md">
                                <a href="{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.index') }}" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Unidades productivas
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_units.environment_pus.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control">
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($productive_units as $pu)
                                                <option value="{{ $pu->id }}">{{ $pu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ambiente:</label>
                                        <select name="environment_id" class="form-control">
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($environments as $e)
                                                <option value="{{ $e->id }}">{{ $e->name }}</option>
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
                                                <th class="text-center">Unidad productiva</th>
                                                <th class="text-center">Ambiente</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $previous_productive_unit_id = null;
                                            @endphp
                                            @foreach ($environment_pus as $epu)
                                                @if ($previous_productive_unit_id !== $epu->productive_unit_id)
                                                    <tr>
                                                        <td style="vertical-align: middle" class="text-center" rowspan="{{ $environment_pus->where('productive_unit_id', $epu->productive_unit_id)->count() }}">
                                                            {{ $epu->productive_unit->name }}
                                                        </td>
                                                @else
                                                    <tr>
                                                @endif
                                                    <td class="text-center">{{ $epu->environment->name }}</td>
                                                    <td class="text-center">
                                                        <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la asociación de la unidad productiva {{ $epu->productive_unit->name }} y el ambiente {{ $epu->environment->name }}?')) { document.getElementById('delete-form-epu{{ $epu->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-epu{{ $epu->id }}" action="{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_units.environment_pus.destroy', $epu) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    $previous_productive_unit_id = $epu->productive_unit_id;
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
