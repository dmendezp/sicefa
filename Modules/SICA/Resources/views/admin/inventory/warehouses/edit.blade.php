@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h4>Actualizar bodega</h4>
                    </div>
                    <form action="{{ route('sica.admin.inventory.warehouse.update', $warehouse) }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                {!! Form::text('name', $warehouse->name, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                {!! Form::textarea('description', $warehouse->description, ['class'=>'form-control', 'rows'=>'3', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Aplicación:</label>
                                <select name="app_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($apps as $app)
                                        <option value="{{ $app->id }}" {{ $warehouse->app_id == $app->id ? 'selected' : '' }}>{{ $app->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.admin.inventory.warehouse.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
