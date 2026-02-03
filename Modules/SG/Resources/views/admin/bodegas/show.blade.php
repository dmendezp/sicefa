@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-warehouse text-indigo-600"></i>
                Detalle de Bodega
            </h3>
            <small class="text-muted">
                {{ $warehouse->code }} · {{ $warehouse->name }}
            </small>
        </div>

        <div>
            <a href="{{ route('sg.admin.sg.bodegas.index') }}" class="btn btn-secondary mr-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('sg.admin.sg.bodegas.edit', $warehouse) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                {{-- HEADER CARD --}}
                <div class="card-header bg-indigo-600 text-white">
                    <h5 class="mb-0">{{ $warehouse->name }}</h5>
                </div>

                {{-- BODY --}}
                <div class="card-body">
                    <div class="row">

                        {{-- Información General --}}
                        <div class="col-md-6 mb-4">
                            <h6 class="font-weight-bold mb-3 text-indigo-600">
                                Información General
                            </h6>

                            <p>
                                <strong>Código:</strong>
                                <span class="badge badge-primary">{{ $warehouse->code }}</span>
                            </p>

                            <p>
                                <strong>Estado:</strong>
                                <span class="badge badge-pill 
                                    {{ $warehouse->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $warehouse->is_active ? 'Activa' : 'Inactiva' }}
                                </span>
                            </p>
                        </div>

                        {{-- Ubicación --}}
                        <div class="col-md-6 mb-4">
                            <h6 class="font-weight-bold mb-3 text-indigo-600">
                                Ubicación
                            </h6>

                            <p>
                                {{ $warehouse->location ?: 'No especificada' }}
                            </p>
                        </div>

                        {{-- Descripción --}}
                        <div class="col-md-12 mb-4">
                            <h6 class="font-weight-bold mb-3 text-indigo-600">
                                Descripción
                            </h6>

                            <p class="text-muted">
                                {{ $warehouse->description ?: 'No disponible' }}
                            </p>
                        </div>

                        {{-- Fechas --}}
                        <div class="col-md-6">
                            <p>
                                <strong>Creado:</strong><br>
                                {{ $warehouse->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p>
                                <strong>Última actualización:</strong><br>
                                {{ $warehouse->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('sg.admin.sg.bodegas.index') }}" class="btn btn-outline-secondary mr-2">
                        Volver
                    </a>
                    <a href="{{ route('sg.admin.sg.bodegas.edit', $warehouse) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar Bodega
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
