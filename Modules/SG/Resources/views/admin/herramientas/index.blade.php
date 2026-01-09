@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Herramientas e Implementos</h3>
        <a href="{{ route('sg.admin.sg.herramientas.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Herramienta
        </a>
    </div>

    {{-- Filtros --}}
    <div class="card mb-4">
        <div class="card-body d-flex flex-wrap justify-content-between gap-2">

            <div class="btn-group mb-2">
                <a href="{{ route('sg.admin.sg.herramientas.index') }}"
                   class="btn {{ !$filter ? 'btn-success' : 'btn-outline-secondary' }}">
                    Todas ({{ $tools->total() }})
                </a>

                <a href="{{ route('sg.admin.sg.herramientas.index',['filter'=>'operational']) }}"
                   class="btn {{ $filter==='operational' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Operativas ({{ $stats['operational'] ?? 0 }})
                </a>

                <a href="{{ route('sg.admin.sg.herramientas.index',['filter'=>'maintenance']) }}"
                   class="btn {{ $filter==='maintenance' ? 'btn-warning' : 'btn-outline-warning' }}">
                    En Mantenimiento ({{ $stats['maintenance'] ?? 0 }})
                </a>

                <a href="{{ route('sg.admin.sg.herramientas.index',['filter'=>'damaged']) }}"
                   class="btn {{ $filter==='damaged' ? 'btn-danger' : 'btn-outline-danger' }}">
                    Dañadas ({{ $stats['damaged'] ?? 0 }})
                </a>
            </div>

            <form method="GET" class="form-inline">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
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
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serie</th>
                        <th>Estado</th>
                        <th>Ubicación</th>
                        <th>Adquisición</th>
                        <th>Valor</th>
                        <th>Responsable</th>
                        <th>Obs.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($tools as $tool)

                    <tr class="
                        {{ $tool->status==='DAMAGED' ? 'table-danger' : '' }}
                        {{ $tool->status==='MAINTENANCE' ? 'table-warning' : '' }}
                    ">

                        <td class="font-weight-bold text-primary">{{ $tool->code }}</td>
                        <td>{{ $tool->name }}</td>
                        <td>{{ $tool->type }}</td>
                        <td>{{ $tool->brand }}</td>
                        <td>{{ $tool->model }}</td>
                        <td>{{ $tool->serial_number }}</td>

                        <td class="text-center">
                            <span class="badge badge-pill
                                {{ $tool->status==='OPERATIONAL' ? 'badge-success' : '' }}
                                {{ $tool->status==='MAINTENANCE' ? 'badge-warning' : '' }}
                                {{ $tool->status==='DAMAGED' ? 'badge-danger' : '' }}
                                {{ $tool->status==='OUT_OF_SERVICE' ? 'badge-secondary' : '' }}">
                                {{ $tool->status_in_spanish }}
                            </span>
                        </td>

                        <td>{{ $tool->location ?? '—' }}</td>

                        <td class="text-center">
                            {{ optional($tool->acquisition_date)->format('d/m/Y') ?? '—' }}
                        </td>

                        <td class="text-right">
                            {{ $tool->purchase_value ? '$'.number_format($tool->purchase_value,2) : '—' }}
                        </td>

                        <td>{{ $tool->current_responsible ?? '—' }}</td>
                        <td>{{ Str::limit($tool->observations, 30) }}</td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.herramientas.show',$tool) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.admin.sg.herramientas.edit',$tool) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form method="POST"
                                  action="{{ route('sg.admin.sg.herramientas.destroy',$tool) }}"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Desactivar esta herramienta?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted py-5">
                            No hay herramientas registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $tools->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
