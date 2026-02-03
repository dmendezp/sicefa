@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            🩺 Tratamientos Aplicados
        </h3>

        <a href="{{ route('sg.liderDeUnidad.sg.treatments.create') }}"
           class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle"></i> Nuevo Tratamiento
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="form-row align-items-end">

                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Historia Clínica</label>
                    <select name="health_record_id" class="form-control">
                        <option value="">Todas</option>
                        @foreach($healthRecords as $hr)
                            <option value="{{ $hr->id }}" {{ $healthRecordId == $hr->id ? 'selected' : '' }}>
                                {{ $hr->animal->id }} - {{ $hr->record_date->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Desde</label>
                    <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Hasta</label>
                    <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control">
                </div>

                <div class="form-group col-md-2 text-right">
                    <button class="btn btn-primary btn-block">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light text-center">
                    <tr>
                        <th>Bovino / Diagnóstico</th>
                        <th>Fecha</th>
                        <th>Medicamento</th>
                        <th>Dosis / Vía</th>
                        <th>Frecuencia</th>
                        <th>Observaciones</th>
                        <th style="width:140px">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($treatments as $treatment)
                    <tr>
                        <td>
                            <span class="font-weight-bold text-primary">
                                {{ $treatment->healthRecord->animal->id }}
                            </span>
                            <br>
                            <small class="text-muted">
                                {{ Str::limit($treatment->healthRecord->diagnosis, 50) }}
                            </small>
                        </td>

                        <td class="text-center">
                            {{ $treatment->treatment_date->format('d/m/Y') }}
                        </td>

                        <td class="font-weight-bold">
                            {{ $treatment->medicine_name }}
                        </td>

                        <td>
                            {{ $treatment->dose ?: '-' }}
                            @if($treatment->administration_route)
                                <span class="badge badge-info ml-1">
                                    {{ $treatment->administration_route }}
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $treatment->frequency ?: '-' }}
                        </td>

                        <td>
                            {{ Str::limit($treatment->observations, 40) ?: '—' }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('sg.liderDeUnidad.sg.treatments.show', $treatment) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.liderDeUnidad.sg.treatments.edit', $treatment) }}"
                               class="btn btn-sm btn-outline-warning"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('sg.liderDeUnidad.sg.treatments.destroy', $treatment) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar este tratamiento?')"
                                        title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            No hay tratamientos registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $treatments->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
