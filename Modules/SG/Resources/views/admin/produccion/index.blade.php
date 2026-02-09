@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">Control de Producción Lechera</h3>
            <small class="text-muted">Seguimiento diario por animal y turno</small>
        </div>
        <a href="{{ route('sg.admin.sg.produccion.create') }}" class="btn btn-success btn-lg shadow-sm">
            <i class="fas fa-cow"></i> Registrar Ordeño
        </a>
    </div>

    {{-- KPIs --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h6>Total del Día</h6>
                    <h3 class="font-weight-bold">{{ number_format($stats['totalLiters'],2) }} L</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h6>Mañana</h6>
                    <h3>{{ number_format($stats['morning'],2) }} L</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body">
                    <h6>Tarde</h6>
                    <h3>{{ number_format($stats['afternoon'],2) }} L</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-dark text-white shadow-sm">
                <div class="card-body">
                    <h6>Noche</h6>
                    <h3>{{ number_format($stats['night'],2) }} L</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtros --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" class="form-row align-items-end">

                <div class="col-md-3">
                    <label>Fecha</label>
                    <input type="date" name="date" value="{{ $date }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Turno</label>
                    <select name="shift" class="form-control">
                        <option value="">Todos</option>
                        <option value="MORNING" {{ $shift==='MORNING'?'selected':'' }}>Mañana</option>
                        <option value="AFTERNOON" {{ $shift==='AFTERNOON'?'selected':'' }}>Tarde</option>
                        <option value="NIGHT" {{ $shift==='NIGHT'?'selected':'' }}>Noche</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Vaca</label>
                    <select name="animal_id" class="form-control">
                        <option value="">Todas</option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}" {{ $animalId==$animal->id?'selected':'' }}>
                                #{{ $animal->id }} - {{ $animal->name ?? 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-block">
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
                        <th>Turno</th>
                        <th>Litros</th>
                        <th>Calidad</th>
                        <th>Temp.</th>
                        <th>Responsable</th>
                        <th>Obs.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($productions as $prod)
                    <tr>

                        <td>
                            <strong class="text-primary">{{ $prod->animal->plate }}</strong><br>
                            <small class="text-muted">{{ $prod->animal->name ?? 'Sin nombre' }}</small>
                        </td>

                        <td class="text-center">
                            {{ $prod->production_date->format('d/m/Y') }}
                        </td>

                        <td class="text-center">
                            <span class="badge badge-pill
                                {{ $prod->shift==='MORNING'?'badge-primary':'' }}
                                {{ $prod->shift==='AFTERNOON'?'badge-warning':'' }}
                                {{ $prod->shift==='NIGHT'?'badge-dark':'' }}">
                                {{ $prod->shift_in_spanish }}
                            </span>
                        </td>

                        <td class="text-center font-weight-bold text-success">
                            {{ number_format($prod->liters,2) }} L
                        </td>

                        <td class="text-center">
                            <span class="badge
                                {{ $prod->quality==='HIGH'?'badge-success':'' }}
                                {{ $prod->quality==='MEDIUM'?'badge-warning':'' }}
                                {{ $prod->quality==='LOW'?'badge-danger':'' }}">
                                {{ $prod->quality_in_spanish }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ $prod->milk_temperature ? $prod->milk_temperature.'°C' : '—' }}
                        </td>

                        <td class="text-center">
                            {{ $prod->responsible ?? '—' }}
                        </td>

                        <td>{{ Str::limit($prod->observations,30) }}</td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.produccion.show',$prod) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('sg.admin.sg.produccion.edit',$prod) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('sg.admin.sg.produccion.destroy',$prod) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar registro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            No hay registros para los filtros seleccionados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $productions->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
