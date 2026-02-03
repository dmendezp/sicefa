@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            🧬 Detalle de la Raza
        </h3>
        <p class="text-muted">
            Información completa de la raza registrada
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">

                {{-- CABECERA --}}
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0 font-weight-bold">
                        {{ $breed->name }}
                    </h4>
                </div>

                {{-- CUERPO --}}
                <div class="card-body p-4">

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">ID</small>
                            <p class="font-weight-bold text-primary mb-0">
                                {{ $breed->id }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Nombre de la Raza</small>
                            <p class="font-weight-bold text-dark mb-0">
                                {{ $breed->name }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <small class="text-muted">Descripción</small>
                        <div class="border rounded p-3 bg-light">
                            {{ $breed->description ?: 'Sin descripción registrada' }}
                        </div>
                    </div>

                    <hr>

                    <div class="row text-muted">
                        <div class="col-md-6 mb-2">
                            <small>Fecha de creación</small>
                            <p class="mb-0">
                                {{ $breed->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <small>Última actualización</small>
                            <p class="mb-0">
                                {{ $breed->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-white d-flex justify-content-between">
                    <a href="{{ route('sg.admin.sg.razas.index') }}"
                       class="btn btn-outline-secondary">
                        ← Volver al listado
                    </a>

                    <a href="{{ route('sg.admin.sg.razas.edit', $breed) }}"
                       class="btn btn-warning text-white">
                        ✏️ Editar Raza
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
