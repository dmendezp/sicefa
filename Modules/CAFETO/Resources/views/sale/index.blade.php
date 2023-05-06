@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.sale.index') }}" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Registro</li>
@endpush

@section('content')
    <div class="card col-12 mx-auto">
        <div class="card-body">
            <h1>Contenido de las ventas</h1>
        </div>
    </div>
@endsection
