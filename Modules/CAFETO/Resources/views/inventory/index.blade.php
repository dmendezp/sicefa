@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.inventory.index') }}" class="text-decoration-none">Inventario</a></li>
    <li class="breadcrumb-item active">Productos</li>
@endpush

@section('content')
    <div class="card col-12 mx-auto">
        <div class="card-body">
            <h1>Contenido del inventario</h1>
        </div>
    </div>
@endsection
