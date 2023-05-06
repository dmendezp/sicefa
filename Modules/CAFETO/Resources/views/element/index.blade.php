@extends('cafeto::layouts.master')

@push('head')
    {{-- Agrega los estilos necesarios aquí --}}
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.element.index') }}" class="text-decoration-none">Productos</a></li>
    <li class="breadcrumb-item active">Imágenes</li>
@endpush

@section('content')
    <div class="card col-12 mx-auto">
        <div class="card-body">
            <h1>Contenido de la galería de imágenes</h1>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Agrega los scripts necesarios aquí --}}
@endpush
