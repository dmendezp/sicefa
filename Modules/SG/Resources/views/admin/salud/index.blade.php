@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Historias Clínicas</h3>

        <a href="{{ route('sg.admin.sg.salud.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Historia Clínica
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="card mb-4">
        <div class="card-body d-flex flex-wrap align-items-end gap-3">

            <form method="GET" class="form-inline flex-wrap">

                <div class="form-group mr-3 mb-2">
                    <label class="mr-2 font-weight-bold">Bovino</label>
                    <select name="animal_id" class="form-control">
                        <option value="">Todos</option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}" {{ $animalId == $animal->id ? 'selected' : '' }}>
                                {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mr-3 mb-2">
                    <label class="mr-2 font-weight-bold">Desde</label>
                    <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control">
                </div>

                <div class="form-group mr-3 mb-2">
                    <label class="mr-2 font-weight-bold">Hasta</label>
                    <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control">
                </div>

                <button class="btn btn-outline-primary mb-2">
                    <i class="fas fa-filter"></i> Filtrar
                </button>

            </form>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light text-center">
                <tr>
                    <th>Bovino</th>
                    <th>Fecha</th>
                    <th>Síntomas</th>
                    <th>Temp. (°C)</th>
                    <th>FC</th>
                    <th>FR</th>
                    <th>Ruminal</th>
                    <th>Heces</th>
                    <th>Orina</th>
                    <th>Diagnóstico</th>
                    <th>Veterinario</th>
                    <th>Responsable</th>
                    <th>Obs.</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse($records as $record)
                    <tr>

                        <td class="font-weight-bold text-primary">
                            {{ $record->animal->plate }}
                            <div class="text-muted small">
                                {{ $record->animal->name ?: 'Sin nombre' }}
                            </div>
                        </td>

                        <td class="text-center">
                            {{ $record->record_date->format('d/m/Y') }}
                        </td>

                        <td>{{ Str::limit($record->symptoms ?? '—', 40) }}</td>

                        <td class="text-center">{{ $record->temperature ?? '—' }}</td>
                        <td class="text-center">{{ $record->heart_rate ?? '—' }}</td>
                        <td class="text-center">{{ $record->respiratory_rate ?? '—' }}</td>
                        <td class="text-center">{{ $record->ruminal_movements ?? '—' }}</td>
                        <td>{{ $record->fecal_consistency ?? '—' }}</td>
                        <td>{{ Str::limit($record->urine_description ?? '—', 30) }}</td>

                        <td>{{ Str::limit($record->diagnosis ?? 'Sin diagnóstico', 40) }}</td>

                        <td>{{ $record->veterinarian ?: '—' }}</td>
                        <td>{{ $record->responsible ?: '—' }}</td>
                        <td>{{ Str::limit($record->observations ?? '—', 30) }}</td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.salud.show', $record) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.admin.sg.salud.edit', $record) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form method="POST"
                                  action="{{ route('sg.admin.sg.salud.destroy', $record) }}"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar esta historia clínica?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center text-muted py-5">
                            No hay historias clínicas registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="card-footer">
            {{ $records->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
