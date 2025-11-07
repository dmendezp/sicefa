@extends('sigac::layouts.master')

@section('content')
    {{-- Estilos locales (no interfieren con master) --}}
    <style>
        :root {
            --primary-600: #1e40af;
            --primary-500: #3b82f6;
        }

        .card-sigac {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgba(18, 38, 63, 0.06);
        }

        .card-header-sigac {
            background: linear-gradient(90deg, var(--primary-600), var(--primary-500));
            color: #fff;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: .85rem 1rem;
            font-weight: 600;
        }

        .table thead th {
            background-color: #eef2ff;
        }

        .modal-body-adapt {
            max-height: 60vh;
            overflow: auto;
        }

        .small-muted {
            font-size: .875rem;
            color: #6b7280;
        }

        .action-btns .btn {
            min-width: 86px;
        }

        .badge-status {
            font-size: .82rem;
            padding: .35rem .6rem;
        }
    </style>

    <div class="container py-4">
        <div class="card card-sigac">
            <div class="card-header card-header-sigac d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $titleView ?? 'Historial de Permisos' }}</h5>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($permissions->isEmpty())
                    <div class="alert alert-info mb-0">
                        No hay solicitudes de permisos asignadas a tu persona como instructor.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Aprendiz</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Horario</th>
                                    <th>Razón</th>
                                    <th class="text-center">Detalle</th>
                                    <th class="text-center">Evidencia</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalAprendiz{{ $permission->id }}"
                                                class="text-decoration-none text-primary fw-semibold">
                                                {{ $permission->person->full_name ?? 'N/A' }}
                                            </a>
                                        </td>

                                        {{-- Fecha solicitud: created_at del permiso --}}
                                        <td>{{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($permission->time_start)->format('h:i A') }} -
                                            {{ \Carbon\Carbon::parse($permission->time_finish)->format('h:i A') }}
                                        </td>

                                        <td>{{ $permission->permission_reason }}</td>

                                        {{-- Detalle: abre modal adaptativo --}}
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalDetalle{{ $permission->id }}">
                                                Ver detalle
                                            </button>
                                        </td>

                                        {{-- Evidencia --}}
                                        {{-- Evidencia --}}
                                        <td class="text-center">
                                            @if ($permission->evidence_url)
                                                @php
                                                    // Ruta al controlador que sirve la evidencia
                                                    $evidenceRoute = route(
                                                        'sigac.tutor.PermissionValidation.evidence',
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



                                        {{-- Acciones: validar / cancelar --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex justify-content-center gap-2">
                                                @if ($permission->status === 'earring' || $permission->status === null)
                                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#validateModal{{ $permission->id }}">
                                                        Validar
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#cancelValidationModal{{ $permission->id }}">
                                                        Cancelar Validación
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- ========== Modal Aprendiz (info personal) ========== --}}
                                    <div class="modal fade" id="modalAprendiz{{ $permission->id }}" tabindex="-1"
                                        aria-labelledby="modalAprendizLabel{{ $permission->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Información del Aprendiz</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body modal-body-adapt">
                                                    {{-- Datos personales --}}
                                                    <h6 class="text-muted border-bottom pb-2 mb-3">Datos Personales</h6>
                                                    <dl class="row">
                                                        <dt class="col-sm-4 fw-semibold">Nombre completo:</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->person->full_name ?? 'No disponible' }}</dd>

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

                                                    {{-- Teléfonos --}}
                                                    <h6 class="text-muted border-bottom pb-2 mb-3 mt-4">Teléfonos de
                                                        Contacto</h6>
                                                    <dl class="row">
                                                        <dt class="col-sm-4 fw-semibold">Teléfono 1:</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->person->telephone1 ?? 'No registrado' }}</dd>

                                                        <dt class="col-sm-4 fw-semibold">Teléfono 2:</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->person->telephone2 ?? 'No registrado' }}</dd>

                                                        <dt class="col-sm-4 fw-semibold">Teléfono 3:</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->person->telephone3 ?? 'No registrado' }}</dd>
                                                    </dl>

                                                    {{-- Académico --}}
                                                    <h6 class="text-muted border-bottom pb-2 mb-3 mt-4">Información
                                                        Académica</h6>
                                                    <dl class="row">
                                                        <dt class="col-sm-4 fw-semibold">Ficha (Código):</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->course->code ?? 'No registrado' }}</dd>

                                                        <dt class="col-sm-4 fw-semibold">Modalidad:</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->course->deschooling ?? 'No registrada' }}</dd>

                                                        <dt class="col-sm-4 fw-semibold">Programa:</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $permission->course->program->name ?? 'No registrado' }}
                                                        </dd>
                                                    </dl>

                                                    {{-- Internado --}}
                                                    <h6 class="text-muted border-bottom pb-2 mb-3 mt-4">Información del
                                                        Internado</h6>
                                                    <dl class="row">
                                                        @if (method_exists($permission, 'hasActiveInternship') && $permission->hasActiveInternship())
                                                            <dt class="col-sm-4 fw-semibold">Estado del Internado:</dt>
                                                            <dd class="col-sm-8 text-success"><i
                                                                    class="bi bi-check-circle-fill"></i> activo</dd>

                                                            @php
                                                                $internship = $permission->person
                                                                    ->boardingSchools()
                                                                    ->whereDate('start_date', '<=', $permission->date)
                                                                    ->whereDate('end_date', '>=', $permission->date)
                                                                    ->first();
                                                            @endphp

                                                            @if ($internship)
                                                                <dt class="col-sm-4 fw-semibold">Tipo de Internado:</dt>
                                                                <dd class="col-sm-8">{{ $internship->type }}</dd>

                                                                <dt class="col-sm-4 fw-semibold">Área Asignada:</dt>
                                                                <dd class="col-sm-8">{{ $internship->area }}</dd>

                                                                <dt class="col-sm-4 fw-semibold">Supervisor Asignado:</dt>
                                                                <dd class="col-sm-8">
                                                                    {{ $internship->supervisor->full_name ?? 'No registrado' }}
                                                                </dd>

                                                                <dt class="col-sm-4 fw-semibold">Fecha de Inicio:</dt>
                                                                <dd class="col-sm-8">
                                                                    {{ \Carbon\Carbon::parse($internship->start_date)->format('d/m/Y') }}
                                                                </dd>

                                                                <dt class="col-sm-4 fw-semibold">Fecha de Fin:</dt>
                                                                <dd class="col-sm-8">
                                                                    {{ \Carbon\Carbon::parse($internship->end_date)->format('d/m/Y') }}
                                                                </dd>
                                                            @endif
                                                        @else
                                                            <dt class="col-sm-4 fw-semibold">Estado del Internado:</dt>
                                                            <dd class="col-sm-8 text-muted"><i
                                                                    class="bi bi-x-circle-fill"></i> No cuenta con
                                                                internado activo</dd>
                                                        @endif
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ========== Modal Detalle (adaptable) ========== --}}
                                    <div class="modal fade" id="modalDetalle{{ $permission->id }}" tabindex="-1"
                                        aria-labelledby="modalDetalleLabel{{ $permission->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Detalle del Permiso</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body modal-body-adapt">
                                                    <p class="mb-0">
                                                        {{ $permission->permission_detail ?? 'No se encontraron detalles adicionales.' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ========== Modal Validar (con observación condicional) ========== --}}
                                    <div class="modal fade" id="validateModal{{ $permission->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form method="POST"
                                                    action="{{ route('sigac.tutor.PermissionValidation.store') }}"
                                                    id="formValidate{{ $permission->id }}">
                                                    @csrf
                                                    <input type="hidden" name="apprentice_permission_id"
                                                        value="{{ $permission->id }}">

                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Validar Permiso</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body modal-body-adapt">
                                                        <div class="mb-3">
                                                            <label class="form-label">Resultado</label>
                                                            <select name="validation_status"
                                                                id="validation_status_{{ $permission->id }}"
                                                                class="form-select" required>
                                                                <option value="approved">Aprobar</option>
                                                                <option value="rejected">Rechazar</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3 d-none"
                                                            id="observation_container_{{ $permission->id }}">
                                                            <label class="form-label">Observaciones (obligatorio si
                                                                rechaza)</label>
                                                            <textarea name="observation" id="observation_{{ $permission->id }}" class="form-control" rows="4"></textarea>
                                                        </div>

                                                        {{-- Información del permiso dentro del modal para contexto --}}
                                                        <hr>
                                                        <h6 class="fw-semibold">Contexto del permiso</h6>
                                                        <ul class="small list-unstyled mt-2 mb-0">
                                                            <li><strong>Solicitado por:</strong>
                                                                {{ $permission->person->full_name ?? 'N/A' }}</li>
                                                            <li><strong>Fecha solicitud:</strong>
                                                                {{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/Y H:i') }}
                                                            </li>
                                                            <li><strong>Fecha permiso:</strong>
                                                                {{ \Carbon\Carbon::parse($permission->date)->format('d/m/Y') }}
                                                            </li>
                                                            <li><strong>Horario:</strong>
                                                                {{ \Carbon\Carbon::parse($permission->time_start)->format('h:i A') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($permission->time_finish)->format('h:i A') }}
                                                            </li>
                                                            <li><strong>Motivo:</strong>
                                                                {{ $permission->permission_reason }}</li>

                                                        </ul>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ========== Modal Cancelar Validación ========== --}}
                                    <div class="modal fade" id="cancelValidationModal{{ $permission->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form method="POST"
                                                    action="{{ route('sigac.instructor.PermissionValidation.cancel') }}"
                                                    id="formCancel{{ $permission->id }}">
                                                    @csrf
                                                    <input type="hidden" name="apprentice_permission_id"
                                                        value="{{ $permission->id }}">

                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">Cancelar Validación</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body modal-body-adapt">
                                                        ¿Estás seguro de que deseas cancelar esta validación? Esto devolverá
                                                        el estado del permiso a <strong>"Pendiente"</strong>.
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

    {{-- 🔹 Scripts: sin incluir externos (usa los del layout master) --}}
    <script>
        // Verifica si SweetAlert2 está disponible; si no, usa confirm() nativo
        const swalAvailable = (typeof Swal !== 'undefined');

        document.addEventListener('DOMContentLoaded', function() {

            /* ============================================================
               🔸 SECCIÓN 1: VISUALIZAR EVIDENCIA
            ============================================================ */
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

            /* ============================================================
               🔸 SECCIÓN 2: VALIDACIÓN DE PERMISOS
            ============================================================ */
            @foreach ($permissions as $permission)
                (function() {
                    const selectEl = document.getElementById('validation_status_{{ $permission->id }}');
                    const obsContainer = document.getElementById(
                    'observation_container_{{ $permission->id }}');
                    const obsField = document.getElementById('observation_{{ $permission->id }}');
                    const formValidate = document.getElementById('formValidate{{ $permission->id }}');
                    const formCancel = document.getElementById('formCancel{{ $permission->id }}');

                    // 🔹 Mostrar u ocultar campo de observación según el valor del select
                    if (selectEl) {
                        selectEl.addEventListener('change', function() {
                            if (this.value === 'rejected') {
                                obsContainer.classList.remove('d-none');
                                obsField.setAttribute('required', 'required');
                            } else {
                                obsContainer.classList.add('d-none');
                                obsField.removeAttribute('required');
                                obsField.value = '';
                            }
                        });
                    }

                    // 🔹 Confirmación al enviar formulario de validación
                    if (formValidate) {
                        formValidate.addEventListener('submit', function(e) {
                            e.preventDefault();
                            const submitAction = () => formValidate.submit();

                            if (swalAvailable) {
                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: 'Verifica tu decisión antes de continuar.',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, guardar',
                                    cancelButtonText: 'Cancelar',
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    if (result.isConfirmed) submitAction();
                                });
                            } else if (confirm('¿Estás seguro?')) {
                                submitAction();
                            }
                        });
                    }

                    // 🔹 Confirmación al cancelar validación
                    if (formCancel) {
                        formCancel.addEventListener('submit', function(e) {
                            e.preventDefault();
                            const submitCancel = () => formCancel.submit();

                            if (swalAvailable) {
                                Swal.fire({
                                    title: '¿Cancelar validación?',
                                    text: 'Esto devolverá el estado del permiso a "Pendiente".',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, cancelar',
                                    cancelButtonText: 'No, volver',
                                    confirmButtonColor: '#d33'
                                }).then((res) => {
                                    if (res.isConfirmed) submitCancel();
                                });
                            } else if (confirm('¿Cancelar validación?')) {
                                submitCancel();
                            }
                        });
                    }
                })();
            @endforeach
        });
    </script>

@endsection
