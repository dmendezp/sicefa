@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-warehouse text-indigo-600"></i>
                Bodegas e Inventarios
            </h3>
            <small class="text-muted">
                Administración de bodegas del sistema
            </small>
        </div>

        <a href="{{ route('sg.admin.sg.bodegas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Bodega
        </a>
    </div>

    {{-- MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    {{-- CARD LISTADO --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($warehouses as $warehouse)
                            <tr class="{{ !$warehouse->is_active ? 'table-secondary' : '' }}">

                                <td class="font-mono font-weight-bold text-indigo-600">
                                    {{ $warehouse->code }}
                                </td>

                                <td class="font-weight-bold">
                                    {{ $warehouse->name }}
                                </td>

                                <td>
                                    {{ $warehouse->location ?: '—' }}
                                </td>

                                <td class="text-muted">
                                    {{ Str::limit($warehouse->description, 50) ?: '—' }}
                                </td>

                                <td>
                                    <span class="badge badge-pill
                                        {{ $warehouse->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $warehouse->is_active ? 'Activa' : 'Inactiva' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('sg.admin.sg.bodegas.show', $warehouse) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('sg.admin.sg.bodegas.edit', $warehouse) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('sg.admin.sg.bodegas.destroy', $warehouse) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Eliminar esta bodega?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                    No hay bodegas registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        {{-- PAGINACIÓN --}}
        @if($warehouses->hasPages())
            <div class="card-footer">
                {{ $warehouses->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
