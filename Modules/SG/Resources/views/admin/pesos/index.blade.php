@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            ⚖️ Registros de Peso
        </h3>

        <a href="{{ route('sg.admin.sg.pesos.create') }}"
           class="btn btn-primary btn-lg">
            ➕ Nuevo Pesaje
        </a>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg">

        {{-- FILTROS --}}
        <div class="card-body border-bottom bg-light">
            <form method="GET">
                <div class="form-row align-items-end">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Animal</label>
                        <select name="animal_id" class="form-control">
                            <option value="">Todos los animales</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}"
                                    {{ $animalId == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="font-weight-bold">Desde</label>
                        <input type="date" name="date_from"
                               value="{{ $dateFrom }}"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="font-weight-bold">Hasta</label>
                        <input type="date" name="date_to"
                               value="{{ $dateTo }}"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <button class="btn btn-success btn-block">
                            🔍 Filtrar
                        </button>
                    </div>

                </div>
            </form>
        </div>

        {{-- TABLA --}}
        <div class="table-responsive">
            <table class="table table-hover mb-0">

                <thead class="thead-dark">
                    <tr>
                        <th>Animal</th>
                        <th>Fecha</th>
                        <th class="text-center">Peso (kg)</th>
                        <th class="text-center">Condición Corporal</th>
                        <th>Observaciones</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($records as $record)
                        <tr>

                            <td>
                                <span class="font-weight-bold text-primary">
                                    {{ $record->animal->id }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    {{ $record->animal->name ?: 'Sin nombre' }}
                                </small>
                            </td>

                            <td>
                                {{ $record->weigh_date->format('d/m/Y') }}
                            </td>

                            <td class="text-center font-weight-bold">
                                {{ $record->weight_kg }} kg
                            </td>

                            <td class="text-center">
                                @if($record->body_condition_score)
                                    <span class="badge badge-pill badge-info">
                                        {{ $record->body_condition_score }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                {{ $record->observations ?: '-' }}
                            </td>

                            {{-- ACCIONES --}}
                            <td class="text-center">
                                <a href="{{ route('sg.admin.sg.pesos.show', $record) }}"
                                   class="btn btn-sm btn-outline-primary action-btn"
                                   data-toggle="tooltip" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('sg.admin.sg.pesos.edit', $record) }}"
                                   class="btn btn-sm btn-outline-warning action-btn"
                                   data-toggle="tooltip" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('sg.admin.sg.pesos.destroy', $record) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este registro de peso?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger action-btn"
                                            data-toggle="tooltip" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No hay registros de peso
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="card-footer bg-white">
            {{ $records->appends(request()->query())->links() }}
        </div>

    </div>

</div>
@endsection
