@extends('sigac::layouts.master')

@push('styles')
<style>
    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    
    .invalid-feedback.show {
        display: block;
    }
    
    .text-danger {
        color: #dc3545 !important;
    }
    
    .form-text {
        font-size: 0.875em;
        color: #6c757d;
    }
    
    .alert {
        border-radius: 0.375rem;
    }
    
    .btn {
        border-radius: 0.375rem;
    }
    
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .mb-3 {
        margin-bottom: 1rem !important;
    }
    
    #duration-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
    }
    
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-secondary:hover {
        background-color: #545b62;
        border-color: #4e555b;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Programar Actividad para el Ambiente: {{ $environment->name }}</h3>

                <!-- Alertas de validación -->
                <div id="validation-alerts" class="mb-3"></div>

                <form action="{{ route('sigac.academic_coordination.environmentcontrol.activity.store') }}" method="POST" id="activity-form">
                    @csrf
                    <input type="hidden" name="environment_id" value="{{ $environment->id }}">

                    <div class="form-group mb-3">
                        <label for="activity_name">Nombre de la Actividad: <span class="text-danger">*</span></label>
                        <input type="text" name="activity_name" id="activity_name" class="form-control" 
                               value="{{ old('activity_name') }}" required maxlength="255">
                        <div class="invalid-feedback" id="activity_name_error"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="activity_description">Descripción:</label>
                        <textarea name="activity_description" id="activity_description" class="form-control" 
                                  rows="3">{{ old('activity_description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Fecha: <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="date" class="form-control" 
                               value="{{ old('date') }}" required>
                        <div class="invalid-feedback" id="date_error"></div>
                        <small class="form-text text-muted">Solo se permiten fechas de hoy en adelante</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="start_time">Hora de Inicio: <span class="text-danger">*</span></label>
                                <input type="time" name="start_time" id="start_time" class="form-control" 
                                       value="{{ old('start_time') }}" required>
                                <div class="invalid-feedback" id="start_time_error"></div>
                                <small class="form-text text-muted">Horario permitido: 6:00 AM - 10:00 PM</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="end_time">Hora de Fin: <span class="text-danger">*</span></label>
                                <input type="time" name="end_time" id="end_time" class="form-control" 
                                       value="{{ old('end_time') }}" required>
                                <div class="invalid-feedback" id="end_time_error"></div>
                                <small class="form-text text-muted">Debe ser posterior a la hora de inicio</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="person_id">Persona Responsable: <span class="text-danger">*</span></label>
                        {!! Form::select('person_id', [], old('person_id'), [
                            'class' => 'form-control person_id',
                            'id' => 'person_id',
                            'required'
                        ]) !!}
                        <div class="invalid-feedback" id="person_id_error"></div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="alert alert-info" id="duration-info" style="display: none;">
                            <strong>Duración:</strong> <span id="duration-text"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <i class="fas fa-save"></i> Guardar Actividad
                        </button>
                        <a href="{{ route('sigac.academic_coordination.environmentcontrol.environment.report') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
<script>
   $(document).ready(function () {
        // Inicializar Select2 en campos de selección de personas
        $('select[name="person_id"]:last').select2({
            placeholder: 'Seleccione una persona',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.academic_coordination.environmentcontrol.environment.activity.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });

        // ==== Validaciones en tiempo real ====
        
        // Validar fecha (solo días anteriores, no hoy)
        $('#date').on('change', function() {
            var selectedDate = new Date($(this).val() + 'T00:00:00');
            var today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Comparar solo las fechas sin considerar la hora
            var selectedDateOnly = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate());
            var todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            
            if (selectedDateOnly < todayOnly) {
                showFieldError('date', 'La fecha debe ser hoy o posterior');
            } else {
                clearFieldError('date');
            }
        });

        // Validar horarios
        $('#start_time, #end_time').on('change', function() {
            validateTimeRange();
        });

        // Validar nombre de actividad
        $('#activity_name').on('blur', function() {
            var value = $(this).val().trim();
            if (value.length === 0) {
                showFieldError('activity_name', 'El nombre de la actividad es obligatorio');
            } else if (value.length > 255) {
                showFieldError('activity_name', 'El nombre no puede exceder 255 caracteres');
            } else {
                clearFieldError('activity_name');
            }
        });

        // Validar persona responsable
        $('#person_id').on('change', function() {
            if (!$(this).val()) {
                showFieldError('person_id', 'Debe seleccionar una persona responsable');
            } else {
                clearFieldError('person_id');
            }
        });

        // Función para validar rango de horarios
        function validateTimeRange() {
            var startTime = $('#start_time').val();
            var endTime = $('#end_time').val();
            
            if (startTime && endTime) {
                // Validar horarios de trabajo (6:00 AM - 10:00 PM)
                if (startTime < '06:00' || startTime > '22:00') {
                    showFieldError('start_time', 'La hora de inicio debe estar entre 6:00 AM y 10:00 PM');
                    return false;
                }
                
                if (endTime < '06:00' || endTime > '22:00') {
                    showFieldError('end_time', 'La hora de fin debe estar entre 6:00 AM y 10:00 PM');
                    return false;
                }
                
                // Validar que la hora de fin sea posterior a la de inicio
                if (startTime >= endTime) {
                    showFieldError('end_time', 'La hora de fin debe ser posterior a la hora de inicio');
                    return false;
                }
                
                // Validar duración máxima (8 horas)
                var start = new Date('2000-01-01 ' + startTime);
                var end = new Date('2000-01-01 ' + endTime);
                var duration = (end - start) / (1000 * 60 * 60); // en horas
                
                if (duration > 8) {
                    showFieldError('end_time', 'La duración de la actividad no puede ser mayor a 8 horas');
                    return false;
                }
                
                // Mostrar duración
                showDuration(duration);
                
                // Limpiar errores si todo está bien
                clearFieldError('start_time');
                clearFieldError('end_time');
                
                return true;
            }
            
            return false;
        }

        // Función para mostrar duración
        function showDuration(hours) {
            var hoursInt = Math.floor(hours);
            var minutes = Math.round((hours - hoursInt) * 60);
            var durationText = hoursInt + ' hora' + (hoursInt !== 1 ? 's' : '');
            if (minutes > 0) {
                durationText += ' y ' + minutes + ' minuto' + (minutes !== 1 ? 's' : '');
            }
            
            $('#duration-text').text(durationText);
            $('#duration-info').show();
        }

        // Función para mostrar error en campo
        function showFieldError(fieldId, message) {
            $('#' + fieldId).addClass('is-invalid');
            $('#' + fieldId + '_error').text(message).show();
        }

        // Función para limpiar error de campo
        function clearFieldError(fieldId) {
            $('#' + fieldId).removeClass('is-invalid');
            $('#' + fieldId + '_error').text('').hide();
        }

        // Validación antes de enviar formulario
        $('#activity-form').on('submit', function(e) {
            var isValid = true;
            
            // Validar campos obligatorios
            if (!$('#activity_name').val().trim()) {
                showFieldError('activity_name', 'El nombre de la actividad es obligatorio');
                isValid = false;
            }
            
            if (!$('#date').val()) {
                showFieldError('date', 'La fecha es obligatoria');
                isValid = false;
            }
            
            if (!$('#start_time').val()) {
                showFieldError('start_time', 'La hora de inicio es obligatoria');
                isValid = false;
            }
            
            if (!$('#end_time').val()) {
                showFieldError('end_time', 'La hora de fin es obligatoria');
                isValid = false;
            }
            
            if (!$('#person_id').val()) {
                showFieldError('person_id', 'Debe seleccionar una persona responsable');
                isValid = false;
            }
            
            // Validar rango de horarios
            if (!validateTimeRange()) {
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                showValidationAlert('Por favor, corrija los errores en el formulario antes de continuar.');
            }
        });

        // Función para mostrar alerta de validación
        function showValidationAlert(message) {
            $('#validation-alerts').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `);
        }

        // ==== SweetAlert2 para errores de validación ====
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Errores en el formulario',
                html: `
                    <ul style="text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Entendido'
            });
        @endif

        // ==== SweetAlert2 para éxito ====
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Actividad Programada!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        // ==== SweetAlert2 para errores personalizados ====
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error al Programar Actividad',
                text: '{{ session('error') }}',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#dc3545'
            });
        @endif
    });
</script>
@endpush