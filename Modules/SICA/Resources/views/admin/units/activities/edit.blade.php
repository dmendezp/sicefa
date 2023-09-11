@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h4>Actualización de actividad</h4>
                    </div>
                    <form action="{{ route('sica.admin.units.activities.update', $activity) }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                {!! Form::text('name', $activity->name, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Unidad productiva:</label>
                                <select name="productive_unit_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($productive_units as $pu)
                                        <option value="{{ $pu->id }}" {{ old('productive_unit_id') ? (old('productive_unit_id') == $pu->id ? 'selected' : '') : ($activity->productive_unit_id == $pu->id ? 'selected' : '') }}>{{ $pu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipo de actividad:</label>
                                <select name="activity_type_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($activity_types as $at)
                                        <option value="{{ $at->id }}" {{ old('activity_type_id') ? (old('activity_type_id') == $at->id ? 'selected' : '') : ($activity->activity_type_id == $at->id ? 'selected' : '') }}>{{ $at->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                {!! Form::textarea('description', $activity->description, ['class'=>'form-control', 'rows'=>'3', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Periodo:</label>
                                {!! Form::text('period', $activity->period, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                {!! Form::select('status', getEnumValues('activities','status'), $activity->status, ['class' => 'form-control', 'placeholder'=>'-- Seleccione --', 'required']) !!}
                            </div>
                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.admin.units.activities.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
