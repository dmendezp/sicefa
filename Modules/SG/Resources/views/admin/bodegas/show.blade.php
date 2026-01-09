@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container">
    <h1>Detalles de la Bodega</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $warehouse->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Código:</strong> {{ $warehouse->code }}</p>
            <p><strong>Ubicación:</strong> {{ $warehouse->location ?? 'No especificada' }}</p>
            <p><strong>Descripción:</strong> {{ $warehouse->description ?? 'No disponible' }}</p>
            <p><strong>Estado:</strong> {{ $warehouse->is_active ? 'Activo' : 'Inactivo' }}</p>
            <p><strong>Creado el:</strong> {{ $warehouse->created_at }}</p>
            <p><strong>Actualizado el:</strong> {{ $warehouse->updated_at }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('sg.admin.sg.bodegas.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
</div>
@endsection