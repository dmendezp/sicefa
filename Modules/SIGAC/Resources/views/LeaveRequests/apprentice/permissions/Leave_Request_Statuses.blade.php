@extends('sigac::layouts.master')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-primary mb-1">{{ $titlePage ?? 'Permisos' }}</h4>
                <p class="text-muted mb-0">{{ $titleView ?? 'Seguimiento de solicitudes enviadas' }}</p>
            </div>
        </div>

        {{-- Filtros --}}
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Estado</label>
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <option value="earring" {{ request('status') == 'earring' ? 'selected' : '' }}>Pendiente</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rechazado</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Desde</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control"
                    onchange="this.form.submit()">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Hasta</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control"
                    onchange="this.form.submit()">
            </div>
        </form>

        {{-- Listado --}}
        @if ($permissions->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                No tienes solicitudes registradas por el momento.
            </div>
        @else
            <div class="row g-4">
                @foreach ($permissions as $permission)
                   @php
    $validations = $permission->permissionValidations ?? collect();
    $totalValidations = $validations->count();
    $done = $validations->whereIn('validation_status', ['approved', 'rejected'])->count();
    $progress = $totalValidations > 0 ? round(($done / $totalValidations) * 100) : 0;

    // 🔹 El estado real viene de apprentice_permissions.status
    $realStatus = $permission->status;

    // 🔹 Color según estado real del permiso
    $statusColor = match ($realStatus) {
        'approved' => 'success',
        'rejected' => 'danger',
        'earring' => 'warning',
        'cancelled' => 'secondary',
        default => 'primary',
    };

    // 🔸 Traducción del estado real
    $statusLabel = match ($realStatus) {
        'approved' => 'Aprobado',
        'rejected' => 'Rechazado',
        'earring' => 'Pendiente',
        'cancelled' => 'Cancelado',
        default => 'Desconocido',
    };
@endphp



                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title text-primary fw-bold mb-0">
                                        {{ $permission->permission_reason }}
                                    </h5>
                                    <span class="badge bg-{{ $statusColor }} text-uppercase">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <p class="text-muted small mb-1">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}
                                </p>

                                <p class="text-muted small mb-3">
                                    <i class="bi bi-clock"></i> {{ $permission->time_start }} -
                                    {{ $permission->time_finish }}
                                </p>

                                <div class="progress mb-3" style="height: 8px;">
                                    <div class="progress-bar bg-{{ $statusColor }}" role="progressbar"
                                        style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#detalleModal{{ $permission->id }}">
                                            <i class="bi bi-eye"></i> Ver detalle
                                        </button>

                                        @if ($permission->evidence_url)
                                            <a href="{{ asset('storage/' . $permission->evidence_url) }}"
                                                class="btn btn-sm btn-outline-success" download>
                                                <i class="bi bi-download"></i> Evidencia
                                            </a>
                                        @endif
                                    </div>

                                    @php
                                        $createdAt = \Carbon\Carbon::parse($permission->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diffHours = $createdAt->diffInHours($now);
                                        $status = $permission->status;

                                        // ✅ Definir si se puede mostrar el botón
                                        $canShowCancelButton = false;

                                        if ($status === 'earring') {
                                            // Permiso pendiente → siempre se puede cancelar
                                            $canShowCancelButton = true;
                                        } elseif ($status === 'approved' && $diffHours < 24) {
                                            // Aprobado hace menos de 24 horas → se puede cancelar
                                            $canShowCancelButton = true;
                                        }
                                    @endphp

                                    @if ($canShowCancelButton)
                                        <form action="{{ route('sigac.apprentice.permission.cancel', $permission->id) }}"
                                            method="POST" class="d-inline cancel-form">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-sm btn-outline-danger cancel-btn">
                                                <i class="bi bi-x-circle"></i> Cancelar
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Detalle --}}
                    <div class="modal fade" id="detalleModal{{ $permission->id }}" tabindex="-1"
                        aria-labelledby="detalleModalLabel{{ $permission->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title fw-semibold">Detalle de la Solicitud</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <h6 class="fw-bold mb-2 text-primary">Información general</h6>
                                    <p><strong>Motivo:</strong> {{ $permission->permission_reason }}</p>
                                    <p><strong>Detalle:</strong> {{ $permission->permission_detail }}</p>
                                    <hr>

                                    <h6 class="fw-bold mb-2 text-primary">Validaciones reales</h6>
                                    @forelse ($validations as $validation)
                                        @php
                                            $badge = match ($validation->validation_status) {
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                'earring' => 'secondary',
                                                default => 'secondary',
                                            };
                                            $statusTranslations = [
                                                'approved' => 'Aprobado',
                                                'rejected' => 'Rechazado',
                                                'earring' => 'Pendiente',
                                            ];
                                            $translatedStatus =
                                                $statusTranslations[$validation->validation_status] ??
                                                ucfirst($validation->validation_status);
                                        @endphp
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-person-circle fs-4 text-{{ $badge }} me-3"></i>
                                            <div>
                                                <strong>{{ $validation->validator_role }}</strong><br>
                                                <span
                                                    class="badge bg-{{ $badge }}">{{ $translatedStatus }}</span><br>
                                                <small
                                                    class="text-muted">{{ $validation->validator->full_name ?? 'Sin validador' }}</small><br>
                                                @if ($validation->observation)
                                                    <small><em>“{{ $validation->observation }}”</em></small>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted fst-italic">Aún no hay validaciones registradas.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- 🔸 Confirmación de cancelación --}}
    <script>
        document.querySelectorAll('.cancel-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: '¿Cancelar solicitud?',
                    text: "Podrás volver a crear una nueva cuando lo necesites.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, cancelar',
                    cancelButtonText: 'No, volver'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
