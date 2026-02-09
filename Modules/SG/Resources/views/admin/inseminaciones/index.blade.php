@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Inseminaciones Realizadas</h3>
        <a href="{{ route('sg.admin.sg.inseminaciones.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Inseminación
        </a>
    </div>

    {{-- Filtros --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="form-row align-items-end">

                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Vaca</label>
                    <select name="animal_id" class="form-control">
                        <option value="">Todas</option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}" {{ $animalId == $animal->id ? 'selected' : '' }}>
                                {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Estado</label>
                    <select name="status" class="form-control">
                        <option value="">Todos</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="positive" {{ $status === 'positive' ? 'selected' : '' }}>Preñada</option>
                        <option value="negative" {{ $status === 'negative' ? 'selected' : '' }}>No preñada</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label class="font-weight-bold">Desde</label>
                    <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control">
                </div>

                <div class="form-group col-md-2">
                    <label class="font-weight-bold">Hasta</label>
                    <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control">
                </div>

                <div class="form-group col-md-2">
                    <button class="btn btn-outline-primary btn-block">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light text-center">
                    <tr>
                        <th>Vaca</th>
                        <th>Fecha</th>
                        <th>Toro</th>
                        <th>Pajuela</th>
                        <th>Estado</th>
                        <th>Técnico</th>
                        <th>Método</th>
                        <th>Obs.</th>
                        <th>Parto Est.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($inseminations as $ins)
                    <tr>

                        <td>
                            <span class="font-weight-bold text-primary">{{ $ins->animal->plate }}</span>
                            - {{ $ins->animal->name ?: 'Sin nombre' }}
                        </td>

                        <td class="text-center">
                            {{ $ins->insemination_date->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $ins->bull_name ?: '—' }}
                        </td>

                        <td>
                            {{ $ins->straw_code ?: '—' }}
                        </td>

                        <td class="text-center">
                            <span class="badge badge-pill
                                {{ $ins->palpation_result === 'POSITIVE' ? 'badge-success' : '' }}
                                {{ $ins->palpation_result === 'NEGATIVE' ? 'badge-danger' : '' }}
                                {{ $ins->palpation_result === 'PENDING' ? 'badge-warning' : '' }}">
                                {{ $ins->gestation_status }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ $ins->technician ?: '—' }}
                        </td>

                        <td class="text-center">
                            {{ $ins->method ?: '—' }}
                        </td>

                        <td>
                            {{ Str::limit($ins->observations, 25) ?: '—' }}
                        </td>

                        <td class="text-center">
                            {{ $ins->expected_birth_date ? $ins->expected_birth_date->format('d/m/Y') : '—' }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.inseminaciones.show', $ins) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.admin.sg.inseminaciones.edit', $ins) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('sg.admin.sg.inseminaciones.destroy', $ins) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar esta inseminación?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            No hay inseminaciones registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{ $inseminations->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
