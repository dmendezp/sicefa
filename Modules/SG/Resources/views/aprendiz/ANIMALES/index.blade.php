@extends('sg::layouts.masterAprendiz')

@section('content')
<br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-cow text-success"></i> Bovinos Registrados
            </h3>
            <small class="text-muted">Gestión y control del hato ganadero</small>
        </div>

        <a href="{{ route('sg.aprendiz.sg.ANIMALES.create') }}"
           class="btn btn-success btn-lg shadow-sm animate-btn">
            <i class="fas fa-plus-circle"></i> Registrar Bovino
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-lg border-0 animate-fade">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Placa</th>
                            <th>Nombre</th>
                            <th>Raza</th>
                            <th>Sexo</th>
                            <th>Nacimiento</th>
                            <th>Ingreso</th>
                            <th>Peso</th>
                            <th>Lote</th>
                            <th>Edad</th>
                            <th>Etapa</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($animals as $animal)
                        <tr class="row-hover">

                            <td class="font-weight-bold text-primary">{{ $animal->id }}</td>

                            <td>{{ $animal->plate ?: 'Sin placa' }}</td>

                            <td>{{ $animal->name ?: 'Sin nombre' }}</td>

                            <td>{{ $animal->breed?->name ?: '—' }}</td>

                            {{-- SEXO --}}
                            <td>
                                <span class="badge badge-pill 
                                    {{ $animal->sex === 'FEMALE' ? 'badge-danger' : 'badge-primary' }}">
                                    {{ $animal->sex === 'FEMALE' ? 'Vaca' : 'Toro' }}
                                </span>
                            </td>

                            <td>{{ optional($animal->birth_date)->format('d/m/Y') }}</td>
                            <td>{{ optional($animal->entry_date)->format('d/m/Y') }}</td>

                            {{-- PESO --}}
                            <td>
                                <span class="badge badge-info">
                                    {{ $animal->weight_kg }} kg
                                </span>
                            </td>

                            <td>{{ $animal->lot ?: '—' }}</td>
                            <td>{{ $animal->age_text }}</td>

                            {{-- ETAPA --}}
                            <td>
                                <span class="badge badge-pill
                                    {{ $animal->production_stage === 'MILKING' ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $animal->production_stage === 'MILKING' ? 'Producción' : 'Otro' }}
                                </span>
                            </td>

                            {{-- ACCIONES --}}
                            <td class="text-center">
                                <a href="{{ route('sg.aprendiz.sg.ANIMALES.show', $animal) }}"
                                   class="btn btn-sm btn-outline-primary action-btn"
                                   data-toggle="tooltip" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('sg.aprendiz.sg.ANIMALES.edit', $animal) }}"
                                   class="btn btn-sm btn-outline-warning action-btn"
                                   data-toggle="tooltip" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('sg.aprendiz.sg.ANIMALES.destroy', $animal) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este bovino?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger action-btn"
                                            data-toggle="tooltip" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        {{-- PAGINACIÓN --}}
        <div class="card-footer bg-white">
            {{ $animals->links() }}
        </div>
    </div>
</div>

{{-- ESTILOS --}}
<style>
.animate-fade {
    animation: fadeIn .6s ease-in-out;
}

.animate-btn {
    transition: transform .2s ease;
}
.animate-btn:hover {
    transform: scale(1.05);
}

.row-hover:hover {
    background-color: #f9fafb;
    transition: background-color .2s;
}

.action-btn {
    transition: all .2s ease;
}
.action-btn:hover {
    transform: scale(1.15);
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

@endsection
