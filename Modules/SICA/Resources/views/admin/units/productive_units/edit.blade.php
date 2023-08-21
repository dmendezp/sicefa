@extends('sica::layouts.master')

@section('stylesheet')
    @livewireStyles()
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-8">
                    <div class="card-header">
                        <h4>Actualizar unidad productiva</h4>
                    </div>
                    <form action="{{ route('sica.admin.units.productive_unit.update', $productive_unit) }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                {!! Form::text('name', $productive_unit->name, [
                                    'class'=>'form-control',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                {!! Form::textarea('description', $productive_unit->description, [
                                    'class'=>'form-control',
                                    'rows'=>'3',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>Icono:</label>
                                {!! Form::text('icon', $productive_unit->icon, ['class'=>'form-control']) !!}
                            </div>

                            {{-- Se incluye el componente para consultar una persona y asignarla como líder --}}
                            @livewire('sica::admin.units.productive-units.consult-leader', ['productive_unit'=>$productive_unit])

                            <div class="form-group">
                                <label>Sector:</label>
                                <select name="sector_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($sectors as $s)
                                        <option value="{{ $s->id }}" {{ $productive_unit->sector_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.admin.units.productive_unit.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @livewireScripts()
@endsection
