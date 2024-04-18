@extends('hangarauto::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card  card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>Asociacion de Conductores y Vehiculos</h4>
                            </div>
                            <div class="col-md">
                                <a href="{{ route('hangarauto.admin.drivers') }}" class="btn btn btn-primary float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Conductores
                                </a>
                                <a href="{{ route('hangarauto.admin.vehicles') }}" class="btn btn btn-primary float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Vehiculos
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('hangarauto.admin.drivervehicles.add') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Conductor:</label>
                                        <select name="driver_id" class="form-control">
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($drivers as $dr)
                                                <option value="{{ $dr->id }}">{{ $dr->person->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> Vehiculo:</label>
                                        <select name="vehicle_id" class="form-control">
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($vehicles as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
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
                                                <th class="text-center">Conductor</th>
                                                <th class="text-center">Vehiculo</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $previous_productive_unit_id = null;
                                            @endphp
                                            @foreach ($drivervehicles_pus as $epu)
                                                @if ($previous_productive_unit_id !== $epu->driver_id)
                                                    <tr>
                                                        <td style="vertical-align: middle" class="text-center" rowspan="{{ $drivervehicles_pus->where('driver_id', $epu->driver_id)->count() }}">
                                                            {{ $epu->driver->person->fullname }}
                                                        </td>
                                                @else
                                                    <tr>
                                                @endif
                                                    <td class="text-center">{{ $epu->vehicle->name }}</td>
                                                    <td class="text-center">
                                                        <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la asociación de el conductor {{ $epu->driver->person->fullname }} y el vehiculo {{ $epu->vehicle->name }}?')) { document.getElementById('delete-form-epu{{ $epu->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-epu{{ $epu->id }}" action="{{ route('hangarauto.admin.drivervehicles.delete', $epu) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    $previous_productive_unit_id = $epu->driver_id;
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
