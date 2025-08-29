<div class="card">
    <div class="card-header">
        Resultado
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Fin</th>
                        <th>Verificacion</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($environmentchecks as $environmentcheck)
                        <tr>
                            <td>{{ $environmentcheck->date }}</td>
                            <td>{{ $environmentcheck->start_time }}</td>
                            <td>{{ $environmentcheck->end_time ?? 'N/A' }}</td>
                            <td>{{ $environmentcheck->state }}</td>
                            <td>
                                @if ($environmentcheck->approved)
                                    <span class="badge badge-success">Aprobado</span>
                                @elseif (!$environmentcheck->approved && $environmentcheck->state === 'Novedad')
                                    <span class="badge badge-danger">Novedad</span>
                                @else
                                    <span class="badge badge-warning">Pendiente</span>
                                @endif
                            </td>

                            <td>
                                <!-- Botón para ver detalles -->
                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-{{ $environmentcheck->id }}">
                                    Ver Detalles
                                </button>

                                <!-- Modal Detalles -->
                                <div class="modal fade" id="detailsModal-{{ $environmentcheck->id }}" tabindex="-1"
                                    role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalles del Checkeo del
                                                    {{ $environmentcheck->date }}</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                @php
                                                    $groupedInventories = [];
                                                    foreach ($environmentcheck->inventories as $inventory) {
                                                        $name = $inventory->element->name;
                                                        $status = $inventory->is_checked ? 'checked' : 'unchecked';

                                                        if (!isset($groupedInventories[$name][$status])) {
                                                            $groupedInventories[$name][$status] = [
                                                                'total_amount' => 0,
                                                                'observations' => [],
                                                            ];
                                                        }

                                                        $groupedInventories[$name][$status]['total_amount'] +=
                                                            $inventory->amount;

                                                        if (!$inventory->is_checked && $inventory->observation) {
                                                            $groupedInventories[$name][$status]['observations'][] =
                                                                $inventory->observation;
                                                        }
                                                    }
                                                @endphp

                                                <div class="form-check">
                                                    @forelse ($groupedInventories as $name => $statuses)
                                                        @foreach ($statuses as $status => $data)
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    @if ($status === 'checked')
                                                                        <span class="text-success">✔️</span>
                                                                    @else
                                                                        <span class="text-danger">✔️</span>
                                                                    @endif
                                                                    {{ $data['total_amount'] }} {{ $name }}
                                                                </div>
                                                                @if ($status === 'unchecked' && !empty($data['observations']))
                                                                    <div class="col-6">
                                                                        <span>Observación:
                                                                            {{ implode(', ', $data['observations']) }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @empty
                                                        <p>No hay inventarios registrados para este chequeo.</p>
                                                    @endforelse
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                @if (checkRol('sigac.security') && Route::is('sigac.security.*'))
                                                    @if (!$environmentcheck->approved && $environmentcheck->state !== 'Novedad')
                                                        <!-- Si está pendiente: mostrar Aprobar y Reportar Novedad -->
                                                        <form
                                                            action="{{ route('sigac.security.environmentcontrol.check.aprrove') }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="environment_check_id"
                                                                value="{{ $environmentcheck->id }}">
                                                            <button type="submit" class="btn btn-success">Aprobar
                                                                Chequeo</button>
                                                        </form>

                                                        <button type="button" class="btn btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#reportNoveltyModal-{{ $environmentcheck->id }}">
                                                            Reportar Novedad
                                                        </button>
                                                    @elseif (!$environmentcheck->approved && $environmentcheck->state === 'Novedad')
                                                        <!-- Si tiene novedad: mostrar info (opcional) -->
                                                        <span class="badge badge-danger">Novedad reportada</span>
                                                    @endif
                                                @endif

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @if (checkRol('sigac.security') && Route::is('sigac.security.*'))
                                    <!-- Modal Reportar Novedad -->
                                    <div class="modal fade" id="reportNoveltyModal-{{ $environmentcheck->id }}"
                                        tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <form
                                                action="{{ route('sigac.security.environmentcontrol.check.novelty') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="environment_check_id"
                                                    value="{{ $environmentcheck->id }}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reportar Novedad</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Seleccione elementos:</p>
                                                        @foreach ($environmentcheck->inventories as $inventory)
                                                            <div class="form-check mb-2">
                                                                <input type="checkbox" name="inventories[]"
                                                                    value="{{ $inventory->id }}"
                                                                    class="form-check-input">
                                                                <label class="form-check-label">
                                                                    {{ $inventory->element->name }}
                                                                    ({{ $inventory->amount }})
                                                                </label>
                                                                <input type="text"
                                                                    name="observations[{{ $inventory->id }}]"
                                                                    class="form-control mt-1"
                                                                    placeholder="Observación (opcional)">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Guardar
                                                            Novedad</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Fin modal -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
