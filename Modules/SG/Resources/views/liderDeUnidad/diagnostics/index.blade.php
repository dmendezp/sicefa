@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Pruebas y Diagnósticos</h3>
        <a href="{{ route('sg.liderDeUnidad.sg.diagnostics.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Prueba
        </a>
    </div>

    {{-- Filtros --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="form-row align-items-end">

                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Bovino</label>
                    <select name="animal_id" class="form-control">
                        <option value="">Todos</option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}" {{ $animalId == $animal->id ? 'selected' : '' }}>
                                {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Tipo de prueba</label>
                    <select name="test_type" class="form-control">
                        <option value="">Todos</option>
                        @foreach($testTypes as $type)
                            <option value="{{ $type }}" {{ $testType === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
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
                        <th>Bovino</th>
                        <th>Fecha</th>
                        <th>Tipo de Prueba</th>
                        <th>Resultado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($tests as $test)
                    <tr>
                        <td>
                            <span class="font-weight-bold text-primary">{{ $test->animal->id }}</span>
                            - {{ $test->animal->name ?: 'Sin nombre' }}
                        </td>

                        <td class="text-center">
                            {{ $test->test_date->format('d/m/Y') }}
                        </td>

                        <td>{{ $test->test_type }}</td>

                        <td class="text-center">
                            @if($test->result)
                                <span class="badge badge-pill
                                    {{ str_contains(strtolower($test->result), 'negativo') ? 'badge-danger' : '' }}
                                    {{ str_contains(strtolower($test->result), 'positivo') ? 'badge-success' : '' }}">
                                    {{ $test->result }}
                                </span>
                            @else
                                <span class="badge badge-secondary">Pendiente</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('sg.liderDeUnidad.sg.diagnostics.show', $test) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.liderDeUnidad.sg.diagnostics.edit', $test) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('sg.liderDeUnidad.sg.diagnostics.destroy', $test) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar esta prueba diagnóstica?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            No hay pruebas diagnósticas registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{ $tests->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
