@extends('sigac::layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Filtros --}}
                <div class="mb-3">
                    <div class="form-inline">

                        {{-- Filtro por ambiente --}}
                        <div class="form-group mr-2">
                            <select name="environment_id" id="environment_filter" class="form-control select2-environment">
                                <option value="">-- Todos los ambientes --</option>
                                @foreach($environments as $id => $name)
                                    <option value="{{ $id }}" {{ request('environment_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Filtro por estado --}}
                        <div class="form-group mr-2">
                            <select name="state" id="state_filter" class="form-control">
                                <option value="">-- Todos los estados --</option>
                                <option value="pendiente" {{ request('state') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="solucionada" {{ request('state') == 'solucionada' ? 'selected' : '' }}>Solucionada</option>
                            </select>
                        </div>

                        {{-- Buscador --}}
                        <div class="form-group mr-2">
                            <input type="text" name="search" id="search_input" class="form-control"
                                placeholder="Buscar..." value="{{ request('search') }}" oninput="debounceSearch()">
                        </div>

                        <a href="{{ route(Route::currentRouteName()) }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </div>

                @if ($novelties->isEmpty())
                    <div class="alert alert-info">No hay novedades pendientes.</div>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Elemento</th>
                                    <th>Ambiente</th>
                                    <th>Observación</th>
                                    <th>Estado</th>
                                    <th>Solución</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($novelties as $novelty)
                                    <tr>
                                        <td>{{ $novelty->environment_check->date }}</td>
                                        <td>{{ $novelty->inventory->element->name ?? 'Sin elemento' }}</td>
                                        <td>{{ $novelty->environment_check->environment->name ?? 'Sin ambiente' }}</td>
                                        <td>{{ $novelty->observation }}</td>
                                        <td>
                                            @if ($novelty->state === 'No')
                                                <span class="badge badge-danger">Pendiente</span>
                                            @else
                                                <span class="badge badge-success">Solucionada</span>
                                            @endif
                                        </td>
                                        <td>{{ $novelty->solution ?? 'Sin solución aún' }}</td>
                                        <td>
                                            @if ($novelty->state === 'No')
                                                <!-- Botón para abrir modal -->
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#resolveModal-{{ $novelty->id }}">
                                                    Resolver
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="resolveModal-{{ $novelty->id }}" tabindex="-1"
                                                    role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <form method="POST"
                                                            action="{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.environmentcontrol.novelty.resolve', $novelty->id) }}">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Resolver Novedad</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Elemento:</strong>
                                                                        {{ $novelty->inventory->element->name ?? 'Sin elemento' }}</p>
                                                                    <p><strong>Observación:</strong>
                                                                        {{ $novelty->observation }}</p>

                                                                    <div class="form-group">
                                                                        <label>Solución</label>
                                                                        <textarea name="solution" class="form-control" rows="3" required>{{ old('solution') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Marcar
                                                                        como Solucionada</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-success">Resuelta</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Mostrando {{ $novelties->firstItem() }} - {{ $novelties->lastItem() }} de {{ $novelties->total() }} resultados
                        </div>
                        
                        <div>
                            @if ($novelties->hasPages())
                                <nav aria-label="Paginación de novedades">
                                    <ul class="pagination pagination-sm mb-0">
                                        {{-- Botón Anterior --}}
                                        @if ($novelties->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">Anterior</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $novelties->previousPageUrl() }}&environment_id={{ request('environment_id') }}&search={{ request('search') }}">Anterior</a>
                                            </li>
                                        @endif

                                        {{-- Números de página --}}
                                        @php
                                            $start = max($novelties->currentPage() - 2, 1);
                                            $end = min($start + 4, $novelties->lastPage());
                                            $start = max($end - 4, 1);
                                        @endphp

                                        @if($start > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $novelties->url(1) }}&environment_id={{ request('environment_id') }}&search={{ request('search') }}">1</a>
                                            </li>
                                            @if($start > 2)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif

                                        @for ($page = $start; $page <= $end; $page++)
                                            @if ($page == $novelties->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $novelties->url($page) }}&environment_id={{ request('environment_id') }}&search={{ request('search') }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endfor

                                        @if($end < $novelties->lastPage())
                                            @if($end < $novelties->lastPage() - 1)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $novelties->url($novelties->lastPage()) }}&environment_id={{ request('environment_id') }}&search={{ request('search') }}">{{ $novelties->lastPage() }}</a>
                                            </li>
                                        @endif

                                        {{-- Botón Siguiente --}}
                                        @if ($novelties->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $novelties->nextPageUrl() }}&environment_id={{ request('environment_id') }}&search={{ request('search') }}">Siguiente</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">Siguiente</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let searchTimeout;

        // Función para aplicar filtros automáticamente
        function applyFilters() {
        const environmentId = document.getElementById('environment_filter').value;
        const stateValue = document.getElementById('state_filter').value;
        const searchValue = document.getElementById('search_input').value;

        const url = new URL(window.location.href);
        url.searchParams.delete('page'); 
        if (environmentId) {
            url.searchParams.set('environment_id', environmentId);
        } else {
            url.searchParams.delete('environment_id');
        }

        if (stateValue) {
            url.searchParams.set('state', stateValue);
        } else {
            url.searchParams.delete('state');
        }

        if (searchValue) {
            url.searchParams.set('search', searchValue);
        } else {
            url.searchParams.delete('search');
        }

        window.location.href = url.toString();
    }

        // Filtro por estado
        document.getElementById('state_filter').addEventListener('change', applyFilters);
        
        // Función con debounce para el buscador
        function debounceSearch() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                applyFilters();
            }, 800);
        }
        
        // Inicializar Select2 para el select de ambientes
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select2-environment').select2({
                    width: '100%',
                    placeholder: '-- Todos los ambientes --',
                    allowClear: true
                });
                
                $('.select2-environment').on('select2:select select2:clear', function (e) {
                    setTimeout(applyFilters, 100);
                });
            } else {
                // Si no hay Select2, usar evento change normal
                document.getElementById('environment_filter').addEventListener('change', applyFilters);
            }
        });
    </script>
@endsection