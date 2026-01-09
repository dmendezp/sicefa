@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Insumos Ganaderos</h3>
        <a href="{{ route('sg.admin.sg.insumos.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Insumo
        </a>
    </div>

    {{-- Filtros --}}
    <div class="card mb-4">
        <div class="card-body d-flex flex-wrap justify-content-between gap-2">

            <div class="btn-group mb-2">
                <a href="{{ route('sg.admin.sg.insumos.index') }}"
                   class="btn {{ !$filter ? 'btn-success' : 'btn-outline-secondary' }}">
                    Todos ({{ $supplies->total() }})
                </a>

                <a href="{{ route('sg.admin.sg.insumos.index', ['filter'=>'low_stock']) }}"
                   class="btn {{ $filter==='low_stock' ? 'btn-danger' : 'btn-outline-danger' }}">
                    Stock Bajo ({{ $stats['lowStock'] ?? 0 }})
                </a>

                <a href="{{ route('sg.admin.sg.insumos.index', ['filter'=>'near_expiration']) }}"
                   class="btn {{ $filter==='near_expiration' ? 'btn-warning' : 'btn-outline-warning' }}">
                    Próx. a vencer ({{ $stats['near_expiration'] ?? 0 }})
                </a>

                <a href="{{ route('sg.admin.sg.insumos.index', ['filter'=>'expired']) }}"
                   class="btn {{ $filter==='expired' ? 'btn-dark' : 'btn-outline-dark' }}">
                    Vencidos ({{ $stats['expired'] ?? 0 }})
                </a>
            </div>

            <form method="GET" class="form-inline">
                <input type="text" name="search" value="{{ $search }}"
                       class="form-control mr-2"
                       placeholder="Buscar por nombre o código">
                <button class="btn btn-outline-primary">Buscar</button>
            </form>

        </div>
    </div>

    {{-- Tabla --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light text-center">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Unidad</th>
                        <th>Presentación</th>
                        <th>Proveedor</th>
                        <th>Stock</th>
                        <th>Mínimo</th>
                        <th>Precio</th>
                        <th>Vencimiento</th>
                        <th>Lote</th>
                        <th>Obs.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($supplies as $supply)

                    <tr class="
                        {{ $supply->current_stock <= $supply->minimum_stock ? 'table-danger' : '' }}
                        {{ $supply->expiration_date && $supply->expiration_date < now()->addDays(30) ? 'table-warning' : '' }}
                    ">

                        <td class="font-weight-bold text-primary">{{ $supply->code }}</td>
                        <td>{{ $supply->name }}</td>

                        <td class="text-center">
                            <span class="badge badge-pill
                                {{ $supply->type==='MEDICINE' ? 'badge-danger' : '' }}
                                {{ $supply->type==='VACCINE' ? 'badge-info' : '' }}
                                {{ $supply->type==='FEED' ? 'badge-success' : '' }}
                                {{ $supply->type==='SUPPLEMENT' ? 'badge-purple' : '' }}
                                {{ $supply->type==='OTHER' ? 'badge-secondary' : '' }}">
                                {{ $supply->type }}
                            </span>
                        </td>

                        <td>{{ $supply->unit }}</td>
                        <td>{{ $supply->presentation ?? 'N/A' }}</td>
                        <td>{{ $supply->supplier ?? 'N/A' }}</td>

                        <td class="text-center font-weight-bold {{ $supply->current_stock <= $supply->minimum_stock ? 'text-danger' : '' }}">
                            {{ number_format($supply->current_stock, 2) }}
                        </td>

                        <td class="text-center">{{ number_format($supply->minimum_stock, 2) }}</td>

                        <td class="text-right">
                            {{ $supply->unit_price ? '$'.number_format($supply->unit_price,2) : '—' }}
                        </td>

                        <td class="text-center">
                            @if($supply->expiration_date)
                                <span class="{{ $supply->expiration_date < now() ? 'text-danger font-weight-bold' : '' }}">
                                    {{ $supply->expiration_date->format('d/m/Y') }}
                                </span>
                            @else
                                —
                            @endif
                        </td>

                        <td>{{ $supply->batch_number ?? '—' }}</td>
                        <td>{{ Str::limit($supply->observations, 30) }}</td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.insumos.show',$supply->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.admin.sg.insumos.edit',$supply->id) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form method="POST"
                                  action="{{ route('sg.admin.sg.insumos.destroy',$supply->id) }}"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Desactivar este insumo?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted py-5">
                            No hay insumos registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $supplies->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
