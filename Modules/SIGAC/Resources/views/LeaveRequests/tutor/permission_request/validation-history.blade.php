@extends('sigac::layouts.master')

@section('content')
    <!-- ✅ Bootstrap & SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8fafc;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            color: white;
            font-weight: 600;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .table thead {
            background-color: #e2e8f0;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.7em;
        }

        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            align-items: center;
        }

        .filter-bar select {
            width: 200px;
        }

        .observation-field {
            width: 100%;
            min-height: 40px;
            font-size: 0.875rem;
        }

        .form-action-wrapper {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        @media (min-width: 768px) {
            .form-action-wrapper {
                flex-direction: row;
                align-items: center;
            }
        }

        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>

    <div class="container py-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $titleView ?? 'Historial de Validaciones' }}</h5>

                <form method="GET" action="{{ route('sigac.tutor.PermissionValidation.tutorValidationHistory') }}">
                    <div class="filter-bar">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">🔍 Todos</option>
                            <option value="approved" {{ $statusFilter === 'approved' ? 'selected' : '' }}>✅ Aprobados
                            </option>
                            <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>❌ Rechazados
                            </option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($permissions->isEmpty())
                    <div class="alert alert-info text-center">
                        No hay registros disponibles según el filtro seleccionado.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Aprendiz</th>
                                    <th>Motivo</th>
                                    <th>Detalle</th>
                                    <th>Evidencia</th>
                                    <th>Estado</th>
                                    <th>Observación</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $validation)
                                    @php
                                        $permission = $validation->apprenticePermission;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalAprendiz{{ $validation->id }}"
                                                class="text-decoration-none text-primary fw-semibold">
                                                {{ $permission->person->full_name ?? 'N/A' }}
                                            </a>
                                        </td>

                                        <td>{{ $permission->permission_reason }}</td>

                                        <!-- Modal Información del Aprendiz -->
                                        <div class="modal fade" id="modalAprendiz{{ $validation->id }}" tabindex="-1"
                                            aria-labelledby="modalAprendizLabel{{ $validation->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Información del Aprendiz</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Datos Personales -->
                                                        <h6 class="text-muted border-bottom pb-2 mb-3">Datos Personales</h6>
                                                        <dl class="row">
                                                            <dt class="col-sm-4 fw-semibold">Nombre completo:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->full_name ?? 'No disponible' }}
                                                            </dd>

                                                            <dt class="col-sm-4 fw-semibold">Tipo de documento:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->document_type ?? 'No registrado' }}
                                                            </dd>

                                                            <dt class="col-sm-4 fw-semibold">Número de documento:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->document_number ?? 'No registrado' }}
                                                            </dd>

                                                            <dt class="col-sm-4 fw-semibold">Correo electrónico:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->personal_email ?? 'No registrado' }}
                                                            </dd>
                                                        </dl>

                                                        <!-- Teléfonos -->
                                                        <h6 class="text-muted border-bottom pb-2 mb-3 mt-4">Teléfonos de
                                                            Contacto</h6>
                                                        <dl class="row">
                                                            <dt class="col-sm-4 fw-semibold">Teléfono 1:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->telephone1 ?? 'No registrado' }}
                                                            </dd>

                                                            <dt class="col-sm-4 fw-semibold">Teléfono 2:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->telephone2 ?? 'No registrado' }}
                                                            </dd>

                                                            <dt class="col-sm-4 fw-semibold">Teléfono 3:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->person->telephone3 ?? 'No registrado' }}
                                                            </dd>
                                                        </dl>

                                                        <!-- Información Académica -->
                                                        <h6 class="text-muted border-bottom pb-2 mb-3 mt-4">Información
                                                            Académica</h6>
                                                        <dl class="row">
                                                            <dt class="col-sm-4 fw-semibold">Ficha (Código):</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->course->code ?? 'No registrado' }}</dd>

                                                            <dt class="col-sm-4 fw-semibold">Modalidad:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->course->deschooling ?? 'No registrada' }}
                                                            </dd>

                                                            <dt class="col-sm-4 fw-semibold">Programa:</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $permission->course->program->name ?? 'No registrado' }}
                                                            </dd>
                                                        </dl>

                                                        <!-- Internado -->
                                                        <h6 class="text-muted border-bottom pb-2 mb-3 mt-4">Información del
                                                            Internado</h6>
                                                        <dl class="row">
                                                            @if (method_exists($permission, 'hasActiveInternship') && $permission->hasActiveInternship())
                                                                <dt class="col-sm-4 fw-semibold">Estado del Internado:</dt>
                                                                <dd class="col-sm-8 text-success"><i
                                                                        class="bi bi-check-circle-fill"></i> Activo</dd>

                                                                @php
                                                                    $internship = $permission->person
                                                                        ->boardingSchools()
                                                                        ->whereDate(
                                                                            'start_date',
                                                                            '<=',
                                                                            $permission->date,
                                                                        )
                                                                        ->whereDate('end_date', '>=', $permission->date)
                                                                        ->first();
                                                                @endphp

                                                                @if ($internship)
                                                                    <dt class="col-sm-4 fw-semibold">Tipo de Internado:</dt>
                                                                    <dd class="col-sm-8">{{ $internship->type }}</dd>

                                                                    <dt class="col-sm-4 fw-semibold">Área Asignada:</dt>
                                                                    <dd class="col-sm-8">{{ $internship->area }}</dd>

                                                                    <dt class="col-sm-4 fw-semibold">Supervisor:</dt>
                                                                    <dd class="col-sm-8">
                                                                        {{ $internship->supervisor->full_name ?? 'No registrado' }}
                                                                    </dd>

                                                                    <dt class="col-sm-4 fw-semibold">Inicio:</dt>
                                                                    <dd class="col-sm-8">
                                                                        {{ \Carbon\Carbon::parse($internship->start_date)->format('d/m/Y') }}
                                                                    </dd>

                                                                    <dt class="col-sm-4 fw-semibold">Fin:</dt>
                                                                    <dd class="col-sm-8">
                                                                        {{ \Carbon\Carbon::parse($internship->end_date)->format('d/m/Y') }}
                                                                    </dd>
                                                                @endif
                                                            @else
                                                                <dt class="col-sm-4 fw-semibold">Estado del Internado:</dt>
                                                                <dd class="col-sm-8 text-muted"><i
                                                                        class="bi bi-x-circle-fill"></i> No activo</dd>
                                                            @endif
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detalle Modal -->
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $validation->id }}">
                                                Ver detalle
                                            </button>

                                            <div class="modal fade" id="detailModal{{ $validation->id }}" tabindex="-1"
                                                aria-labelledby="detailModalLabel{{ $validation->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title"
                                                                id="detailModalLabel{{ $validation->id }}">
                                                                Detalle del Permiso
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $permission->permission_detail ?? 'Sin detalles' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                         <td class="text-center">
                                            @if ($permission->evidence_url)
                                                @php
                                                    $evidencePath = Str::startsWith(
                                                        $permission->evidence_url,
                                                        'storage/',
                                                    )
                                                        ? asset($permission->evidence_url)
                                                        : asset('storage/' . $permission->evidence_url);
                                                @endphp

                                                {{-- 🔍 Botón de vista previa (ojo) --}}
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary me-1 view-evidence-btn"
                                                    data-evidence="{{ $evidencePath }}" title="Ver evidencia"
                                                    data-bs-toggle="modal" data-bs-target="#evidenceModal">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                                {{-- ⬇️ Botón de descarga --}}
                                                <a href="{{ $evidencePath }}" download
                                                    class="btn btn-sm btn-outline-primary" title="Descargar evidencia">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @else
                                                <span class="text-muted fst-italic small-muted">No adjunta</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($validation->validation_status === 'approved')
                                                <span class="badge bg-success">Aprobado</span>
                                            @elseif ($validation->validation_status === 'rejected')
                                                <span class="badge bg-danger">Rechazado</span>
                                            @endif
                                        </td>

                                        <!-- Observación Modal -->
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#obsModal{{ $validation->id }}">
                                                Ver
                                            </button>

                                            <div class="modal fade" id="obsModal{{ $validation->id }}" tabindex="-1"
                                                aria-labelledby="obsModalLabel{{ $validation->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-secondary text-white">
                                                            <h5 class="modal-title"
                                                                id="obsModalLabel{{ $validation->id }}">
                                                                Observaciones
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $validation->observation ?? 'Sin observaciones registradas' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Fecha solicitud del aprendiz -->
                                        <td>
                                            @if (!empty($permission->date))
                                                <strong>{{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}</strong><br>
                                                <small class="text-muted">
                                                    {{ !empty($permission->time_start) ? \Carbon\Carbon::parse($permission->time_start)->format('H:i') : '--:--' }}
                                                    -
                                                    {{ !empty($permission->time_finish) ? \Carbon\Carbon::parse($permission->time_finish)->format('H:i') : '--:--' }}
                                                </small>
                                            @else
                                                <span class="text-danger">Sin información</span>
                                            @endif
                                        </td>

  @php
                                            // 🔹 Verificamos si otro rol distinto al Instructor ya validó este permiso
                                            $otherValidated = \Modules\SIGAC\Entities\PermissionValidation::where(
                                                'apprentice_permission_id',
                                                $validation->apprentice_permission_id,
                                            )
                                                ->where('validator_role', '!=', 'tutor')
                                                ->whereIn('validation_status', ['approved', 'rejected'])
                                                ->exists();

                                            // 🔹 Si otro ya validó, se bloquea el botón
                                            $buttonDisabled = $otherValidated;
                                        @endphp
                                        <td>
                                             @if ($buttonDisabled)
                                                <!-- Botón bloqueado -->
                                                <button type="button" class="btn btn-sm btn-secondary" disabled
                                                    title="Ya fue validado por otro rol">
                                                    <i class="bi bi-lock"></i> Bloqueado
                                                </button>
                                            <!-- Botón para abrir modal -->
                                           @else
                                                <!-- Botón activo para abrir modal -->
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#validateModal{{ $validation->id }}">
                                                    <i class="bi bi-check2-square"></i> Validar
                                                </button>

<!-- Modal de validación -->
<div class="modal fade" id="validateModal{{ $validation->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <form method="POST"
                action="{{ route('sigac.tutor.PermissionValidation.tutorUpdateValidation', $validation->id) }}"
                id="formValidate{{ $validation->id }}">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-check2-square"></i> Validar Permiso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Resultado</label>
                        <select name="validation_status" id="validation_status_{{ $validation->id }}"
                            class="form-select" required>
                            <option value="approved">✅ Aprobar</option>
                            <option value="rejected">❌ Rechazar</option>
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="observation_container_{{ $validation->id }}">
                        <label class="form-label">Observaciones (obligatorio si se rechaza)</label>
                        <textarea name="observation" id="observation_{{ $validation->id }}" class="form-control" rows="3"></textarea>
                    </div>

                    <hr>
                    <h6 class="fw-semibold">📋 Contexto del permiso</h6>
                    <ul class="small list-unstyled mt-2 mb-0">
                        <li><strong>Solicitado por:</strong> {{ $permission->person->full_name ?? 'N/A' }}</li>
                        <li><strong>Motivo:</strong> {{ $permission->permission_reason }}</li>
                        <li><strong>Detalle:</strong> {{ $permission->permission_detail ?? 'Sin detalles' }}</li>
                        <li><strong>Fecha permiso:</strong>
                            {{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}</li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
</td>

</tr>
@endforeach
</tbody>
</table>
</div>
@endif
</div>
</div>
</div>

<!-- 🔹 MODAL VISUALIZAR EVIDENCIA -->
<div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="evidenceModalLabel">Visualizar Evidencia</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <div id="evidenceContainer" class="d-flex justify-content-center align-items-center">
                    <p class="text-muted">Cargando evidencia...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 Bootstrap + SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // 🟢 Lógica para visualizar evidencia dinámica
    const evidenceModal = document.getElementById('evidenceModal');
    const evidenceContainer = document.getElementById('evidenceContainer');
    const viewButtons = document.querySelectorAll('.view-evidence-btn');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const evidenceUrl = this.getAttribute('data-evidence');
            evidenceContainer.innerHTML = '<p class="text-muted">Cargando evidencia...</p>';

            if (!evidenceUrl) {
                evidenceContainer.innerHTML = '<p class="text-danger">No se encontró la evidencia.</p>';
                return;
            }

            const extension = evidenceUrl.split('.').pop().toLowerCase();

            const showEvidence = () => {
                if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(extension)) {
                    evidenceContainer.innerHTML = `<img src="${evidenceUrl}" alt="Evidencia" class="img-fluid rounded shadow">`;
                } else if (extension === 'pdf') {
                    evidenceContainer.innerHTML = `<iframe src="${evidenceUrl}" width="100%" height="600px" style="border:none;"></iframe>`;
                } else {
                    evidenceContainer.innerHTML = `
                        <p class="text-muted">No se puede previsualizar este tipo de archivo.<br>
                        <a href="${evidenceUrl}" download class="btn btn-primary mt-2">Descargar Evidencia</a></p>`;
                }
            };

            evidenceModal.addEventListener('shown.bs.modal', showEvidence, { once: true });
        });
    });

    evidenceModal.addEventListener('hidden.bs.modal', function () {
        evidenceContainer.innerHTML = '<p class="text-muted">Cargando evidencia...</p>';
    });

    // 🧠 Lógica de validación visual para todos los formularios dinámicos
    const forms = document.querySelectorAll('form[id^="formValidate"]');

    forms.forEach(form => {
        const id = form.id.replace('formValidate', '');
        const select = document.getElementById(`validation_status_${id}`);
        const observationContainer = document.getElementById(`observation_container_${id}`);
        const observationField = document.getElementById(`observation_${id}`);

        // Cambiar visibilidad del campo según selección
        select.addEventListener('change', function() {
            if (this.value === 'rejected') {
                observationContainer.classList.remove('d-none');
                observationField.setAttribute('required', 'required');
            } else {
                observationContainer.classList.add('d-none');
                observationField.removeAttribute('required');
            }
        });

        // Confirmación antes de enviar
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Verificar observación si se rechaza
            if (select.value === 'rejected' && observationField.value.trim() === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Observación requerida',
                    text: 'Debes ingresar una observación para rechazar el permiso.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            // Confirmación general
            Swal.fire({
                title: '¿Confirmar validación?',
                text: '¿Deseas guardar los cambios realizados?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection
