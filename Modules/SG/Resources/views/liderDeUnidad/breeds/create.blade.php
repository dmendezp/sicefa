@extends('sg::layouts.masterLiderDeUnidad')

@section('title', 'Nueva Raza - Ganadería')

@section('content')
<br>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h1 class="h3 mb-0">Nueva Raza de Ganado</h1>
                    <p class="text-muted mb-0">Registra una nueva raza en el sistema con toda la información relevante.</p>
                </div>
                <div class="text-right">
                    <a href="{{ route('sg.liderDeUnidad.sg.breeds.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Datos de la Raza</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('sg.liderDeUnidad.sg.breeds.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre de la Raza <span class="text-danger">*</span></label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                class="form-control @error('name') is-invalid @enderror" placeholder="Ej: Angus, Brahman, Holstein">
                            <small class="form-text text-muted">Nombre único y descriptivo de la raza. Máx. 100 caracteres.</small>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" rows="5" class="form-control" placeholder="Características principales, origen, aptitudes productivas, clima recomendado...">{{ old('description') }}</textarea>
                            <small class="form-text text-muted">Información detallada que ayudará a los usuarios a identificar la raza.</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('sg.liderDeUnidad.sg.breeds.index') }}" class="btn btn-link">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Raza</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h5 class="card-title mb-0">Consejos para Unidad Ganadera</h5>
                </div>
                <div class="card-body">
                    <ul class="small text-muted pl-3">
                        <li>Use nombres claros y estandarizados por finca.</li>
                        <li>Incluya la aptitud productiva (leche / carne / doble propósito).</li>
                        <li>Agregue notas sobre clima y manejo recomendado.</li>
                        <li>Verifique que no exista una raza con el mismo nombre.</li>
                    </ul>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-tractor fa-2x text-warning mb-2"></i>
                    <p class="small text-muted mb-0">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
</svg>
</button>
</div>
</form>
</div>
</div>

<!-- Footer hint -->
<div class="mt-8 text-center text-sm text-gray-500">
    Los campos marcados con <span class="text-red-600">*</span> son obligatorios.
</div>
</div>
</div>
@endsection

@push('styles')
<style>
    /* Pequeño toque extra para que el foco sea más bonito en navegadores modernos */
    input:focus,
    textarea:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }
</style>
@endpush