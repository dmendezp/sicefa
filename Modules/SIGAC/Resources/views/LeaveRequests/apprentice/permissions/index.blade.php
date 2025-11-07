@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* --- NUEVO ESTILO MODERNO --- */
        /* NO aplicar display:flex al body */
        body {
            min-height: 100vh;
            background: transparent;
            /* deja que el master muestre su fondo */
        }

        /* Nuevo contenedor para centrar el formulario dentro del content */
        .form-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 120px);
            /* ajusta al espacio restante sin romper el layout */
            padding: 2rem;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem 2.5rem;
            width: 100%;
            max-width: 650px;
            transition: transform 0.2s ease;
        }

        .glass-card:hover {
            transform: scale(1.01);
        }

        /* Resto de tu estilo igual */
        .form-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e40af;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: 600;
            color: #374151;
        }

        textarea,
        input[type="text"],
        input[type="file"],
        input[type="date"],
        input[type="time"],
        select {
            border-radius: 10px !important;
            border: 1px solid #cbd5e1 !important;
            transition: all 0.2s;
        }

        textarea:focus,
        input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.4rem 0.8rem;
            border-radius: 10px;
            background: #f9fafb;
            cursor: pointer;
            transition: background 0.2s;
        }

        .radio-option:hover {
            background: #f1f5f9;
        }

        .submit-btn {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: background 0.3s ease, transform 0.2s;
            width: 100%;
        }

        .submit-btn:hover {
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
            transform: scale(1.03);
        }

        .section-divider {
            height: 2px;
            background: #e5e7eb;
            margin: 1.5rem 0;
        }
    </style>
@endpush

@section('content')
    <div class="form-wrapper">
        <div class="glass-card">
            <h2 class="form-title">Solicitud de Permiso</h2>

            <form id="permissionForm" method="POST" action="{{ route('sigac.apprentice.permission.store') }}"
                enctype="multipart/form-data" x-data="{ opcion: '' }">
                @csrf

                <!-- Campos ocultos -->
                <input type="hidden" value="{{ $rol->name }}" readonly />
                <input type="hidden"
                    value="{{ $user->person->first_name }} {{ $user->person->first_last_name }} {{ $user->person->second_last_name }}" />
                <input type="hidden" value="{{ $user->person->document_type }}" />
                <input type="hidden" value="{{ $user->person->document_number }}" />
                <input type="hidden" name="course_id" value="{{ $apprentice->course->id }}" />
                <input type="hidden" value="{{ $apprentice->course->program->name ?? 'Sin programa' }}" />

                <!-- Razón del permiso -->
                <fieldset class="mb-4">
                    <legend class="block text-sm font-semibold text-gray-700 mb-2">Razón del Permiso</legend>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <label class="radio-option">
                            <input id="opcion-1" type="radio" name="razon" value="Cita Médica" x-model="opcion"
                                required>
                            Cita Médica
                        </label>

                        <label class="radio-option">
                            <input id="opcion-2" type="radio" name="razon" value="Calamidad" x-model="opcion" required>
                            Calamidad
                        </label>

                        <label class="radio-option">
                            <input id="opcion-3" type="radio" name="razon" value="Enfermedad" x-model="opcion"
                                required>
                            Enfermedad
                        </label>

                        <label class="radio-option">
                            <input id="opcion-4" type="radio" name="razon" value="Diligencia personal" x-model="opcion"
                                required>
                            Diligencia personal
                        </label>

                        <label class="radio-option">
                            <input id="opcion-otro" type="radio" name="razon" value="Otro" x-model="opcion" required>
                            Otro
                        </label>
                    </div>

                    <!-- Campos dinámicos -->
                    <div x-show="opcion === 'Cita Médica'" x-transition class="mt-3">
                        <label class="block text-sm text-gray-700">Detalles de la cita</label>
                        <textarea name="detail_citation" class="w-full border p-2" rows="3"
                            placeholder="Describe los detalles de tu cita médica"></textarea>
                    </div>

                    <div x-show="opcion === 'Calamidad'" x-transition class="mt-3">
                        <label class="block text-sm text-gray-700">Detalles de la calamidad</label>
                        <textarea name="detail_calamity" class="w-full border p-2" rows="3" placeholder="Explica brevemente la situación"></textarea>
                    </div>

                    <div x-show="opcion === 'Enfermedad'" x-transition class="mt-3">
                        <label class="block text-sm text-gray-700">Detalles de la enfermedad</label>
                        <textarea name="disease_detail" class="w-full border p-2" rows="3"
                            placeholder="Indica el tipo de enfermedad o síntoma"></textarea>
                    </div>

                    <div x-show="opcion === 'Diligencia personal'" x-transition class="mt-3">
                        <label class="block text-sm text-gray-700">Detalles de la diligencia</label>
                        <textarea name="detail_diligence" class="w-full border p-2" rows="3"
                            placeholder="Describe el trámite o actividad que realizarás"></textarea>
                    </div>

                    <div x-show="opcion === 'Otro'" x-transition class="mt-3">
                        <label class="block text-sm text-gray-700">Especifica la razón</label>
                        <textarea name="detail_other" class="w-full border p-2" rows="3"
                            placeholder="Indica claramente el motivo de tu solicitud"></textarea>
                    </div>

                    <input type="hidden" name="reason" :value="opcion">
                </fieldset>

                <div class="section-divider"></div>

                <!-- Evidencia -->
                <label class="block mb-2 text-sm font-medium text-gray-900">
    Cargar evidencia
    <span class="text-gray-500">(solo si seleccionas Cita Médica)</span>
</label>

<input 
    type="file" 
    name="evidence_url" 
    id="evidence_url" 
    class="w-full mb-3"
    x-bind:required="opcion === 'Cita Médica'" 
    x-show="opcion === 'Cita Médica'"
    accept=".pdf, image/*, .doc, .docx"
/>

@error('evidence_url')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror


                <div class="section-divider"></div>
                <!-- Fecha y horas -->
                <!-- Fecha, horas e instructor -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Fecha del Permiso</label>
                        <input type="date" name="date"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Hora Desde</label>
                        <input type="time" id="start-time" name="time_start"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            min="07:15" max="15:15" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Hora Hasta</label>
                        <input type="time" id="end-time" name="time_finish"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            min="07:15" max="16:15" required>

                        <!-- Instructor asignado -->
                    </div>
                    <div id="instructor-name-container" class="mt-3 hidden">
                        <label id="instructor-label"
                            class="block mb-1 text-sm font-medium text-gray-900">Asignado</label>
                        <input type="text" id="instructor-name" readonly
                            class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2.5 text-sm text-gray-800" />
                        <input type="hidden" name="instructor_id" id="instructor-id" />
                    </div>
                </div><br>


                <!-- Botón de envío -->
                <button type="submit" class="submit-btn mt-6">Enviar solicitud</button>
            </form>
        </div>
    </div>

    <script>
        // 🧠 Confirmación antes del envío
        document.getElementById('permissionForm').addEventListener('submit', function(e) {
            e.preventDefault(); // prevenir envío inmediato
            Swal.fire({
                title: '¿Confirmar solicitud?',
                text: "Verifica que toda la información sea correcta antes de enviar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit(); // solo envía si el usuario confirma
                }
            });
        });

        // 🧩 Tu lógica original conservada
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('input[name="date"]');
            const startTimeInput = document.getElementById('start-time');
            const instructorContainer = document.getElementById('instructor-name-container');
            const instructorInput = document.getElementById('instructor-name');
            const instructorIdHidden = document.getElementById('instructor-id');
            const instructorLabel = document.getElementById('instructor-label');

            let debounceTimer = null;
            let currentAbortController = null;
            const cache = {};

            function formatDateToISO(dateStr) {
                const parts = dateStr.split('/');
                if (parts.length === 3) {
                    return `${parts[2]}-${parts[1]}-${parts[0]}`;
                }
                return dateStr;
            }

            async function fetchInstructor() {
                const rawDate = dateInput.value;
                const date = formatDateToISO(rawDate);
                const start = startTimeInput.value;

                if (!date || !start) return;

                const cacheKey = `${date}_${start}`;
                if (cache[cacheKey]) {
                    updateInstructorUI(cache[cacheKey]);
                    return;
                }

                if (currentAbortController) currentAbortController.abort();
                currentAbortController = new AbortController();

                try {
                    const response = await fetch(
                        `/sigac/aprendices/get-instructor?date=${date}&start=${start}`, {
                            signal: currentAbortController.signal
                        });
                    const data = await response.json();

                    cache[cacheKey] = data;
                    updateInstructorUI(data);
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('❌ Error al consultar instructor:', error);
                        showErrorUI();
                    }
                }
            }

            function updateInstructorUI(data) {
                instructorContainer.classList.remove('hidden');
                if (data.name && data.id) {
                    if (data.role === 'instructor') {
                        instructorLabel.textContent = 'Instructor asignado';
                        instructorLabel.className = 'block mb-1 text-sm font-medium text-blue-700';
                    } else if (data.role === 'supervisor') {
                        instructorLabel.textContent = 'Supervisor encargado';
                        instructorLabel.className = 'block mb-1 text-sm font-medium text-green-700';
                    } else {
                        instructorLabel.textContent = 'Asignado';
                        instructorLabel.className = 'block mb-1 text-sm font-medium text-gray-700';
                    }
                    instructorInput.value = data.name;
                    instructorIdHidden.value = data.id;
                } else {
                    instructorLabel.textContent = 'Sin asignar';
                    instructorInput.value = 'No hay instructor o supervisor disponible';
                    instructorIdHidden.value = '';
                }
            }

            function showErrorUI() {
                instructorContainer.classList.remove('hidden');
                instructorLabel.textContent = 'Error en la consulta';
                instructorInput.value = 'No se pudo obtener información';
                instructorIdHidden.value = '';
            }

            function debounceFetch() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(fetchInstructor, 400);
            }

            [dateInput, startTimeInput].forEach(input => {
                input.addEventListener('change', debounceFetch);
                input.addEventListener('keyup', debounceFetch);
                input.addEventListener('blur', debounceFetch);
            });
        });

        // 🟢 Mensaje de éxito del backend
        @if (session('success'))
            Swal.fire({
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#2563eb'
            });
        @endif
    </script>
@endsection
