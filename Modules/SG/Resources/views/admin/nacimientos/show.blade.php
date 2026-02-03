@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            🐄 Detalle de Parto
        </h3>

        <a href="{{ route('sg.admin.sg.nacimientos.index') }}"
           class="btn btn-secondary">
            ← Volver al listado
        </a>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg">

        {{-- CABECERA --}}
        <div class="card-header bg-info text-white text-center">
            <h4 class="mb-0 font-weight-bold">
                Parto registrado el {{ $birth->birth_date->format('d/m/Y') }}
            </h4>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- MADRE --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-primary mb-3">
                                🐄 Madre
                            </h5>

                            <p><strong>ID:</strong>
                                <span class="text-primary">{{ $birth->mother->id }}</span>
                            </p>
                            <p><strong>Nombre:</strong>
                                {{ $birth->mother->name ?: 'Sin nombre' }}
                            </p>
                            <p><strong>Raza:</strong>
                                {{ $birth->mother->breed?->name ?: '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- CRÍA --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-success">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-success mb-3">
                                🐮 Cría
                            </h5>

                            <p><strong>ID Cría:</strong>
                                @if($birth->calf)
                                    <span class="text-success font-weight-bold">
                                        {{ $birth->calf->id }}
                                    </span>
                                @else
                                    <span class="text-muted">No vinculada</span>
                                @endif
                            </p>

                            <p><strong>Sexo:</strong>
                                @if($birth->calf_sex)
                                    <span class="badge badge-pill
                                        {{ $birth->calf_sex === 'MALE' ? 'badge-primary' : 'badge-danger' }}">
                                        {{ $birth->calf_sex === 'MALE' ? 'Macho' : 'Hembra' }}
                                    </span>
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN DEL PARTO --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-warning">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-warning mb-3">
                                📅 Información del Parto
                            </h5>

                            <p><strong>Fecha del Parto:</strong>
                                {{ $birth->birth_date->format('d/m/Y') }}
                            </p>

                            <p><strong>Días de Gestación:</strong>
                                {{ $birth->real_gestation_days ? $birth->real_gestation_days . ' días' : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- INSEMINACIÓN --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-secondary">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-secondary mb-3">
                                🧬 Inseminación
                            </h5>

                            <p><strong>Fecha:</strong>
                                {{ $birth->insemination_date ? $birth->insemination_date->format('d/m/Y') : '-' }}
                            </p>

                            <p><strong>Toro:</strong>
                                @if($birth->bull)
                                    <span class="font-weight-bold text-secondary">
                                        {{ $birth->bull->id }}
                                    </span>
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- OBSERVACIONES --}}
                <div class="col-md-12">
                    <div class="card border-left-info">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-info mb-3">
                                📝 Observaciones
                            </h5>

                            <p class="mb-0">
                                {{ $birth->observations ?: 'Sin observaciones registradas.' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ACCIONES --}}
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('sg.admin.sg.nacimientos.edit', $birth) }}"
                   class="btn btn-warning btn-lg mr-3">
                    ✏️ Editar
                </a>

                <form action="{{ route('sg.admin.sg.nacimientos.destroy', $birth) }}"
                      method="POST"
                      onsubmit="return confirm('¿Eliminar este registro de parto?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-lg">
                        🗑 Eliminar
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection
