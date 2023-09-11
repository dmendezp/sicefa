@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h4>Registro de bodega</h4>
                    </div>
                    <form action="{{ route('sica.admin.inventory.warehouse.store') }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'3', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Aplicación:</label>
                                <select name="app_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($apps as $app)
                                        <option value="{{ $app->id }}" {{ old('app_id') == $app->id ? 'selected' : '' }}>{{ $app->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.admin.inventory.warehouse.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
