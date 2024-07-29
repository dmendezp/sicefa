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
                        <h4>{{trans('sica::menu.Productive Unit Registration')}}</h4>
                    </div>
                    <form action="{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.store') }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Área productiva:</label>
                                <select name="sector_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($sectors as $s)
                                        <option value="{{ $s->id }}" {{ old('sector_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{trans('sica::menu.Name')}}:</label>
                                {!! Form::text('name', null, [
                                    'class'=>'form-control',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>{{trans('sica::menu.Description')}}:</label>
                                {!! Form::textarea('description', null, [
                                    'class'=>'form-control',
                                    'rows'=>'3',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>Icono:</label>
                                {!! Form::text('icon', null, ['class'=>'form-control']) !!}
                            </div>

                            {{-- Se incluye el componente para consultar una persona y asignarla como líder --}}
                            @livewire('sica::admin.units.productive-units.consult-leader', ['productive_unit'=>null])

                            <div class="form-group">
                                <label>Finca:</label>
                                <select name="farm_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($farms as $f)
                                        <option value="{{ $f->id }}" {{ old('farm_id') == $f->id ? 'selected' : '' }}>{{ $f->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm">{{trans('sica::menu.Register')}}</button>
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
