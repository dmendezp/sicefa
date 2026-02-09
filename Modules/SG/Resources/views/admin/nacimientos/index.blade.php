@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            🐄 Registro de Partos
        </h3>

        <a href="{{ route('sg.admin.sg.nacimientos.create') }}"
           class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle"></i> Registrar Parto
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET">
                <div class="form-row align-items-end">

                    <div class="col-md-4 mb-2">
                        <label class="font-weight-bold">Madre</label>
                        <select name="animal_id" class="form-control">
                            <option value="">Todas las madres</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}" {{ $animalId == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label class="font-weight-bold">Desde</label>
                        <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-2">
                        <label class="font-weight-bold">Hasta</label>
                        <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control">
                    </div>

                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Madre</th>
                            <th>Fecha de Parto</th>
                            <th class="text-center">Cría</th>
                            <th class="text-center">Sexo</th>
                            <th class="text-center">Inseminación</th>
                            <th class="text-center">Toro</th>
                            <th class="text-center">Gestación</th>
                            <th>Observaciones</th>
                            <th class="text-center" style="width:180px">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($births as $birth)
                            <tr>
                                <td>
                                    <strong class="text-primary">{{ $birth->mother->plate }}</strong><br>
                                    <small class="text-muted">{{ $birth->mother->name ?: 'Sin nombre' }}</small>
                                </td>

                                <td>{{ $birth->birth_date->format('d/m/Y') }}</td>

                                <td class="text-center">
                                    @if($birth->calf)
                                        <span class="badge badge-success">
                                            {{ $birth->calf->id }}
                                        </span>
                                    @else
                                        <span class="text-muted">No vinculada</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($birth->calf_sex)
                                        @if($birth->calf_sex === 'MALE')
                                            <span class="badge badge-info px-3 py-2">
                                                ♂ Macho
                                            </span>
                                        @else
                                            <span class="badge badge-pink px-3 py-2">
                                                ♀ Hembra
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ $birth->insemination_date ? $birth->insemination_date->format('d/m/Y') : '-' }}
                                </td>

                                <td class="text-center">
                                    @if($birth->bull)
                                        <strong class="text-primary">{{ $birth->bull->id }}</strong>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($birth->real_gestation_days)
                                        <span class="badge badge-secondary">
                                            {{ $birth->real_gestation_days }} días
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    {{ $birth->observations ?: '-' }}
                                </td>

                                {{-- ACCIONES --}}
                            <td class="text-center">
                                <a href="{{ route('sg.admin.sg.nacimientos.show', $birth) }}"
                                   class="btn btn-sm btn-outline-primary action-btn"
                                   data-toggle="tooltip" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('sg.admin.sg.nacimientos.edit', $birth) }}"
                                   class="btn btn-sm btn-outline-warning action-btn"
                                   data-toggle="tooltip" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('sg.admin.sg.nacimientos.destroy', $birth) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este registro de parto?')">
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
                                <td colspan="9" class="text-center py-5 text-muted">
                                    No hay partos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- PAGINACIÓN --}}
        <div class="card-footer">
            {{ $births->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
