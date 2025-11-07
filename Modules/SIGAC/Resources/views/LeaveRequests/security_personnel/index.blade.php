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
    <h5 class="mb-0">{{ $titleView ?? 'Historial de Permisos Aprobados' }}</h5>

    <form method="GET" action="{{ route('sigac.security.personnel.permission.index') }}">
        <div class="filter-bar">
            <select name="filter" class="form-select" onchange="this.form.submit()">
                <option value="">🔍 Todos</option>
                <option value="today" {{ $filter === 'today' ? 'selected' : '' }}>📅 Hoy</option>
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
                                    <th>Documento</th>
                                    <th>Programa</th>
                                    <th>ficha</th>
                                    <th>Fecha Solicitud</th>
                                    <th class="text-center">Validaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $validation)
                                    @php
                                        $permission = $validation->apprenticePermission;
                                    @endphp
                                    <tr>
                                        <td>

                                            {{ $permission->person->full_name ?? 'N/A' }}
                                        </td>

                                        <td>{{ $permission->person->document_number }}</td>

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
                                            {{ $permission->course->program->name ?? 'No registrado' }}
                                        </td>
                                           <td>
                                            {{ $permission->course->code ?? 'No registrado' }}</dd>
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



                                        <!-- Observación Modal -->
                                     
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

            // 🔹 Verificamos si el Coordinador Académico ya validó este permiso
            $coordinatorValidated = \Modules\SIGAC\Entities\PermissionValidation::where(
                'apprentice_permission_id',
                $validation->apprentice_permission_id,
            )
                ->where('validator_role', 'Coordinador Académico')
                ->whereIn('validation_status', ['approved', 'rejected'])
                ->exists();

            // 🔹 Si el Coordinador ya validó, se bloquea el botón
            $buttonDisabled = $coordinatorValidated;
        @endphp


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
                                            <th>Observación</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission->permissionValidations as $v)
                                            <tr>
                                                <td>{{ $v->validator->full_name ?? 'No disponible' }}</td>
                                                <td>{{ $v->validator_role ?? 'Sin rol' }}</td>
                                                <td>{{ $v->observation ?? 'Sin observación' }}</td>

                                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if ($v->validation_status === 'approved')
                                                        <span class="badge bg-success">Aprobado</span>
                                                    @elseif ($v->validation_status === 'rejected')
                                                        <span class="badge bg-danger">Rechazado</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                                    @endif
                                                </td>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona todos los formularios de validación
            const forms = document.querySelectorAll('form[id^="formValidate"]');

            forms.forEach(form => {
                const id = form.id.replace('formValidate', '');
                const observationContainer = document.getElementById(`observation_container_${id}`);
                const observationField = document.getElementById(`observation_${id}`);
                const select = document.getElementById(`validation_status_${id}`);

                // ✅ Mostrar el campo de observación SIEMPRE y hacerlo obligatorio
                observationContainer.classList.remove('d-none');
                observationField.setAttribute('required', 'required');

                // Cambia el texto de la etiqueta según la opción seleccionada (opcional)
                select.addEventListener('change', () => {
                    const label = observationContainer.querySelector('label');
                    if (select.value === 'approved') {
                        label.textContent = 'Observaciones (obligatorio al aprobar)';
                    } else if (select.value === 'rejected') {
                        label.textContent = 'Observaciones (obligatorio al rechazar)';
                    }
                });

                // Confirmación con SweetAlert al enviar
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
