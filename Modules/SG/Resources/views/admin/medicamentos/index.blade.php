@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">
            <i class="fas fa-pills text-primary"></i> Medicamentos
        </h3>

        <a href="{{ route('sg.admin.sg.medicamentos.create') }}"
           class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Medicamento
        </a>
    </div>

    {{-- FILTROS RÁPIDOS --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex flex-wrap align-items-center gap-2">

            <span class="font-weight-bold mr-2 text-muted">
                Filtros rápidos:
            </span>

            <a href="{{ route('sg.admin.sg.medicamentos.index') }}"
               class="btn {{ !request('filter') ? 'btn-primary' : 'btn-outline-primary' }}">
                Todos
            </a>

            <a href="{{ route('sg.admin.sg.medicamentos.index',['filter'=>'low_stock']) }}"
               class="btn {{ request('filter')==='low_stock' ? 'btn-danger' : 'btn-outline-danger' }}">
                <i class="fas fa-exclamation-triangle"></i>
                Stock Bajo
                <span class="badge badge-light ml-1">{{ $lowStockCount ?? 0 }}</span>
            </a>

            <a href="{{ route('sg.admin.sg.medicamentos.index',['filter'=>'near_expiration']) }}"
               class="btn {{ request('filter')==='near_expiration' ? 'btn-warning' : 'btn-outline-warning' }}">
                <i class="fas fa-clock"></i>
                Próximos a vencer
                <span class="badge badge-light ml-1">{{ $nearExpirationCount ?? 0 }}</span>
            </a>

            <a href="{{ route('sg.admin.sg.medicamentos.index',['filter'=>'expired']) }}"
               class="btn {{ request('filter')==='expired' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                <i class="fas fa-ban"></i>
                Vencidos
                <span class="badge badge-light ml-1">{{ $expiredCount ?? 0 }}</span>
            </a>
        </div>
    </div>

    {{-- ALERTA --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- TABLA --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">

                <thead class="thead-light text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Principio Activo</th>
                    <th>Presentación</th>
                    <th>Dosis</th>
                    <th>Laboratorio</th>
                    <th>Lote</th>
                    <th>Vence</th>
                    <th>Stock</th>
                    <th>Mínimo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse($medicines as $medicine)

                    <tr class="
                        {{ $medicine->stock <= $medicine->minimum_stock ? 'table-danger' : '' }}
                        {{ $medicine->expiration_date < now()->addDays(30) && $medicine->expiration_date >= now() ? 'table-warning' : '' }}
                    ">

                        <td class="font-weight-bold text-primary">
                            {{ $medicine->name }}
                        </td>

                        <td>{{ $medicine->active_principle }}</td>
                        <td>{{ $medicine->presentation }}</td>
                        <td>{{ $medicine->dose_unit }}</td>
                        <td>{{ $medicine->manufacturer ?? '—' }}</td>
                        <td>{{ $medicine->batch ?? '—' }}</td>

                        <td class="text-center">
                            {{ $medicine->expiration_date->format('d/m/Y') }}
                        </td>

                        <td class="text-center font-weight-bold">
                            {{ $medicine->stock }}
                        </td>

                        <td class="text-center">
                            {{ $medicine->minimum_stock }}
                        </td>

                        <td class="text-center">
                            @if($medicine->expiration_date < now())
                                <span class="badge badge-danger">Vencido</span>
                            @elseif($medicine->expiration_date < now()->addDays(30))
                                <span class="badge badge-warning">Próximo</span>
                            @elseif($medicine->stock <= $medicine->minimum_stock)
                                <span class="badge badge-danger">Stock Bajo</span>
                            @else
                                <span class="badge badge-success">Vigente</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.medicamentos.show',$medicine) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.admin.sg.medicamentos.edit',$medicine) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('sg.admin.sg.medicamentos.destroy',$medicine) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar medicamento?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-5">
                            No hay medicamentos registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{ $medicines->links() }}
        </div>
    </div>

</div>
@endsection
