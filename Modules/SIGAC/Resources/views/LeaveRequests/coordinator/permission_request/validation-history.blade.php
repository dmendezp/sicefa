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

                <form method="GET"
                    action="{{ route('sigac.academic_coordination.PermissionValidation.academicCoordinationValidationHistory') }}">
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
                                    <th>Fecha Solicitud</th>
                                    <th>Estado</th>
                                    <th>Observación</th>
                                    <th class="text-center">Validaciones</th>
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



                                        {{-- Evidencia --}}
                                        <td class="text-center">
                                            @if ($permission->evidence_url)
                                                @php
                                                    // Ruta al controlador que sirve la evidencia
                                                    $evidenceRoute = route(
                                                        'sigac.coordinador.PermissionValidation.evidence',
                                                        $permission->id,
                                                    );

                                                    // Extensión del archivo, tomada de lo que hay en BD (para el JS)
                                                    $evidenceExt = pathinfo(
                                                        $permission->evidence_url,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                {{-- 🔍 Botón de vista previa (ojo) --}}
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary me-1 view-evidence-btn"
                                                    data-evidence="{{ $evidenceRoute }}"
                                                    data-ext="{{ strtolower($evidenceExt) }}" title="Ver evidencia"
                                                    data-bs-toggle="modal" data-bs-target="#evidenceModal">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                                {{-- ⬇️ Botón de descarga (usa la misma ruta, el navegador decide) --}}
                                                <a href="{{ $evidenceRoute }}" class="btn btn-sm btn-outline-primary"
                                                    title="Descargar evidencia">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @else
                                                <span class="text-muted fst-italic small-muted">No adjunta</span>
                                            @endif
                                        </td>
                                        <!-- Fecha solicitud del aprendiz -->
                                        <td>
                                            {{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}
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
                                                        <!-- ✅ Nueva columna de validaciones -->
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalValidaciones{{ $permission->id }}">
                                                <i class="bi bi-eye"></i> Ver
                                            </button>
                                        </td>

                    </div>
            </div>
        </div>
        </td>


        @php
            $validation = $validation ?? $validation->fresh(); // Aseguramos que tenemos la instancia más reciente

            // Convertimos la fecha de validación a un objeto Carbon
            $validatedAt = \Carbon\Carbon::parse($validation->validated_at);

            // Verificamos si la fecha de validación es anterior a la medianoche de hoy
            $buttonDisabled = $validatedAt->isBefore(now()->startOfDay());
        @endphp


        <td>
            @if ($buttonDisabled)
                <button type="button" class="btn btn-sm btn-secondary" disabled
                    title="Ya fue validado por el Coordinador Académico">
                    <i class="bi bi-lock"></i> Bloqueado
                </button>
            @else
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#validateModal{{ $validation->id }}">
                    <i class="bi bi-check2-square"></i> Validar
                </button>






                <!-- Modal de validación -->
                <div class="modal fade" id="validateModal{{ $validation->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST"
                                action="{{ route('sigac.academic_coordination.PermissionValidation.academicCoordinationUpdateValidation', $validation->id) }}"
                                id="formValidate{{ $validation->id }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Validar Permiso</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body modal-body-adapt">
                                    <div class="mb-3">
                                        <label class="form-label">Resultado</label>
                                        <select name="validation_status" id="validation_status_{{ $validation->id }}"
                                            class="form-select" required>
                                            <option value="approved">Aprobar</option>
                                            <option value="rejected">Rechazar</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 d-none" id="observation_container_{{ $validation->id }}">
                                        <label class="form-label">Observaciones (obligatorio si
                                            se rechaza)</label>
                                        <textarea name="observation" id="observation_{{ $validation->id }}" class="form-control" rows="3"></textarea>
                                    </div>

                                    <hr>
                                    <h6 class="fw-semibold">Contexto del permiso</h6>
                                    <ul class="small list-unstyled mt-2 mb-0">
                                        <li><strong>Solicitado por:</strong>
                                            {{ $permission->person->full_name ?? 'N/A' }}</li>
                                        <li><strong>Motivo:</strong>
                                            {{ $permission->permission_reason }}</li>
                                        <li><strong>Detalle:</strong>
                                            {{ $permission->permission_detail ?? 'Sin detalles' }}
                                        </li>
                                        <li><strong>Fecha permiso:</strong>
                                            {{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
            @endif
    </div>
    </div>
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
    @foreach ($permissions as $validation)
        @php
            $permission = $validation->apprenticePermission;
        @endphp

        {{-- tu fila de tabla aquí --}}

        <!-- ✅ Modal de validaciones (mover aquí dentro del foreach) -->
        <div class="modal fade" id="modalValidaciones{{ $permission->id }}" tabindex="-1"
            aria-labelledby="modalValidacionesLabel{{ $permission->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalValidacionesLabel{{ $permission->id }}">
                            <i class="bi bi-people-fill"></i> Validaciones del permiso #{{ $permission->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if ($permission->permissionValidations->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-striped align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Validador</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Observación</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission->permissionValidations as $v)
                                            <tr>
                                                <td>{{ $v->validator->full_name ?? 'No disponible' }}</td>
                                                <td>{{ $v->validator_role ?? 'Sin rol' }}</td>
                                                <td>
                                                    @if ($v->validation_status === 'approved')
                                                        <span class="badge bg-success">Aprobado</span>
                                                    @elseif ($v->validation_status === 'rejected')
                                                        <span class="badge bg-danger">Rechazado</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                                    @endif
                                                </td>
                                                <td>{{ $v->observation ?? 'Sin observación' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="bi bi-info-circle"></i> Aún no hay validaciones registradas.
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- ====================== MODAL EVIDENCIA ====================== -->
    <div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="evidenceModalLabel">Visualizar Evidencia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="evidenceContainer" class="d-flex justify-content-center align-items-center"
                        style="min-height: 400px;">
                        <p class="text-muted">Cargando evidencia...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====================== SCRIPT ====================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==================== MODAL DE EVIDENCIA ====================
            const evidenceButtons = document.querySelectorAll('.view-evidence-btn');
            const evidenceModal = document.getElementById('evidenceModal');
            const evidenceContainer = document.getElementById('evidenceContainer');

            if (evidenceButtons && evidenceModal && evidenceContainer) {
                evidenceButtons.forEach(btn => {
                    btn.addEventListener('click', function() {

                        const evidenceUrl = this.getAttribute(
                            'data-evidence'); // ruta al controlador
                        const ext = (this.getAttribute('data-ext') || '').toLowerCase();

                        if (!evidenceUrl) {
                            if (swalAvailable) {
                                Swal.fire('Error', 'No se encontró la URL de la evidencia.',
                                    'error');
                            } else {
                                alert('No se encontró la URL de la evidencia.');
                            }
                            return;
                        }

                        // Limpia contenido previo y muestra estado de carga
                        evidenceContainer.innerHTML =
                            '<p class="text-muted">Cargando evidencia...</p>';

                        setTimeout(() => {
                            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(
                                    ext)) {
                                // 🖼️ Mostrar imagen (el src sigue siendo la ruta al controlador, que sirve la imagen)
                                evidenceContainer.innerHTML = `
                        <img src="${evidenceUrl}" alt="Evidencia"
                            class="img-fluid rounded shadow-sm"
                            style="max-height: 80vh; object-fit: contain;">
                    `;
                            } else if (ext === 'pdf') {
                                // 📄 Mostrar PDF
                                evidenceContainer.innerHTML = `
                        <iframe src="${evidenceUrl}" width="100%" height="600px"
                            class="border rounded shadow-sm" style="border:none;">
                        </iframe>
                    `;
                            } else {
                                // ❓ Otro tipo de archivo
                                evidenceContainer.innerHTML = `
                        <div class="text-center">
                            <i class="bi bi-file-earmark-text fs-1 text-secondary"></i>
                            <p class="mt-2">Tipo de archivo no soportado para vista previa.</p>
                            <a href="${evidenceUrl}" target="_blank"
                                class="btn btn-primary btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> Abrir archivo
                            </a>
                        </div>
                    `;
                            }
                        }, 300);
                    });
                });

                evidenceModal.addEventListener('hidden.bs.modal', () => {
                    evidenceContainer.innerHTML = '<p class="text-muted">Cargando evidencia...</p>';
                });
            }

            // Al cerrar el modal, limpiar contenido
            evidenceModal.addEventListener('hidden.bs.modal', function() {
                evidenceContainer.innerHTML = '<p class="text-muted">Cargando evidencia...</p>';
            });

            // ==================== VALIDACIÓN DE FORMULARIOS ====================
            const forms = document.querySelectorAll('form[id^="formValidate"]');

            forms.forEach(form => {
                const id = form.id.replace('formValidate', '');
                const observationContainer = document.getElementById(`observation_container_${id}`);
                const observationField = document.getElementById(`observation_${id}`);
                const select = document.getElementById(`validation_status_${id}`);

                // Oculta el campo de observación por defecto
                observationContainer.classList.add('d-none');
                observationField.removeAttribute('required');

                // Mostrar/ocultar observación según la selección
                select.addEventListener('change', () => {
                    if (select.value === 'rejected') {
                        observationContainer.classList.remove('d-none');
                        observationField.setAttribute('required', 'required');
                    } else {
                        observationContainer.classList.add('d-none');
                        observationField.removeAttribute('required');
                        observationField.value = '';
                    }
                });

                // Confirmación con SweetAlert
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Confirmar acción?',
                        text: '¿Deseas guardar esta validación?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#2563eb'
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
