@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 animate-fade">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-id-card text-success"></i> Ficha del Bovino
            </h3>
            <small class="text-muted">
                Código: <strong>{{ $animal->id }}</strong>
            </small>
        </div>

        <div>
            <a href="{{ route('sg.admin.sg.animales.edit', $animal) }}"
               class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('sg.admin.sg.animales.index') }}"
               class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg border-0 animate-slide">

        <div class="card-body p-5">

            {{-- CABECERA --}}
            <div class="row align-items-center mb-5">

                {{-- FOTO --}}
                <div class="col-md-3 text-center">
                    <div class="photo-box mb-3">
                        <img src="{{ $animal->photo_url }}"
                             alt="Bovino {{ $animal->id }}">
                    </div>
                </div>

                {{-- INFO GENERAL --}}
                <div class="col-md-9">
                    <h2 class="font-weight-bold mb-1">
                        {{ $animal->id }}
                        <small class="text-muted">
                            {{ $animal->name ? "- {$animal->name}" : '' }}
                        </small>
                    </h2>

                    <div class="mt-2">
                        <span class="badge badge-success mr-2 px-3 py-2">
                            {{ $animal->breed?->name }}
                        </span>
                        <span class="badge badge-info mr-2 px-3 py-2">
                            {{ $animal->sex === 'FEMALE' ? 'Vaca' : 'Toro' }}
                        </span>
                        <span class="badge badge-secondary px-3 py-2">
                            {{ $animal->age_text }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <span class="badge badge-pill badge-primary px-4 py-2">
                            Etapa: {{ $animal->production_stage }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- BLOQUES DE INFORMACIÓN --}}
            <div class="row">

                {{-- INFORMACIÓN BÁSICA --}}
                <div class="col-md-4 mb-4">
                    <div class="card info-card h-100">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">
                                📋 Información Básica
                            </h5>
                            <p><strong>Raza:</strong> {{ $animal->breed?->name }}</p>
                            <p><strong>Sexo:</strong> {{ $animal->sex === 'FEMALE' ? 'Hembra' : 'Macho' }}</p>
                            <p><strong>Edad:</strong> {{ $animal->age_text }}</p>
                            <p><strong>Lote / Corral:</strong> {{ $animal->lot ?: 'Sin asignar' }}</p>
                        </div>
                    </div>
                </div>

                {{-- DATOS FÍSICOS --}}
                <div class="col-md-4 mb-4">
                    <div class="card info-card bg-light h-100">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">
                                ⚖️ Datos Físicos
                            </h5>
                            <p>
                                <strong>Peso actual:</strong>
                                {{ $animal->weight_kg ? $animal->weight_kg.' kg' : 'No registrado' }}
                            </p>
                            <p>
                                <strong>Condición corporal:</strong>
                                {{ $animal->body_condition ?: 'No evaluada' }}
                            </p>
                            <p>
                                <strong>Ingreso:</strong>
                                {{ $animal->entry_date?->format('d/m/Y') ?? 'No registrado' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- PRODUCCIÓN --}}
                <div class="col-md-4 mb-4">
                    <div class="card info-card bg-success text-white h-100">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">
                                🥛 Producción
                            </h5>
                            <p>
                                <strong>Producción hoy:</strong><br>
                                <span class="display-4">
                                    {{
                                        $animal->milkProductions()
                                            ->whereDate('production_date', today())
                                            ->sum('liters')
                                    }}
                                </span> L
                            </p>
                            <hr class="bg-white">
                            <p>
                                <strong>Total histórico:</strong>
                                {{ $animal->milkProductions()->sum('liters') }} L
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ESTILOS --}}
<style>
.photo-box {
    width:200px;
    height:200px;
    border-radius:16px;
    overflow:hidden;
    border:4px solid #e9ecef;
    transition: transform .3s ease, box-shadow .3s ease;
}
.photo-box:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 25px rgba(0,0,0,.2);
}
.photo-box img {
    width:100%;
    height:100%;
    object-fit:cover;
}

.info-card {
    border:0;
    box-shadow: 0 6px 18px rgba(0,0,0,.08);
    transition: transform .25s ease;
}
.info-card:hover {
    transform: translateY(-6px);
}

.animate-fade {
    animation: fadeIn .6s ease;
}
.animate-slide {
    animation: slideUp .6s ease;
}

@keyframes fadeIn {
    from { opacity:0; }
    to { opacity:1; }
}
@keyframes slideUp {
    from { opacity:0; transform:translateY(20px); }
    to { opacity:1; transform:translateY(0); }
}
</style>
@endsection
