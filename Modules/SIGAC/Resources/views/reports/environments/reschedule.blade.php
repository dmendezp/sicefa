<div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Reasignar ambientes</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        {!! Form::hidden('program_id', null, ['id' => 'programId']) !!}
                        {!! Form::checkbox('institucional_request', 1, null, ['id' => 'institucional_request']) !!}
                        {!! Form::label('institucional_request', 'Solicitud institucional') !!}
                    </div>
                    <div class="form-applicant" style="display: none">
                        <div class="form-group">
                            {!! Form::label('applicant', 'Solicitante') !!}
                            {!! Form::select('applicant', [], ['class' => 'form-control', 'id' => 'applicant']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('reason', 'Motivo') !!}
                            {!! Form::textarea('reason', null, ['class' => 'form-control', 'style' => 'height: 10px']) !!}
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    {!! Form::label('start_time', 'Hora inicio') !!}
                                    {!! Form::time('start_time', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-6">
                                    {!! Form::label('end_time', 'Hora fin') !!}
                                    {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('change_environment', 'Cambio de ambiente') !!}
                        {!! Form::select('environment', $unprogrammedEnvironments, null, ['class' => 'form-control', 'id' => 'environment', 'placeholder' => 'Buscar ambiente']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                {!! Form::label('start_time_environment', 'Hora inicio') !!}
                                {!! Form::time('start_time_environment', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('end_time_environment', 'Hora fin') !!}
                                {!! Form::time('end_time_environment', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <br>
                    {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary', 'id' => 'standcolor']) !!}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
       
        $('.modal').on('shown.bs.modal', function () {
            var modal = $(this);
            var programId = modal.attr('id').replace('reschedule', ''); // Obtener el ID del programa desde el ID del modal

            // Inicializar Select2 para el campo de environment
            modal.find('#environment').select2({
                dropdownParent: modal,
                placeholder: 'Buscar ambiente',
            });

            // Base URL para la búsqueda AJAX
            var baseUrl = '{{ route("sigac.academic_coordination.reports.environments.search_person") }}';
            
            // Inicializar Select2 para el campo applicant
            modal.find('#applicant').select2({
                dropdownParent: modal,
                placeholder: 'Buscar persona',
                minimumInputLength: 3,
                ajax: {
                    url: baseUrl,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            applicant: params.term,
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

            // Mostrar u ocultar el campo applicant según el checkbox
            modal.find('input[name="institucional_request"]').on('change', function() {
                var institucionalRequest = $(this).is(':checked');
                
                if (institucionalRequest) {
                    modal.find('.form-applicant').show();
                } else {
                    modal.find('.form-applicant').hide();
                }
            });

        });

        // Prevenir que el modal se cierre al interactuar con Select2
        $('.modal').on('click', '.select2-selection', function (e) {
            e.stopPropagation();
        });
        

        $('#standcolor').on('click', function(event) {
            event.preventDefault(); // Prevenir el envío estándar del formulario

            // Capturar los datos del formulario
            var institucionalRequest = $('#institucional_request').is(':checked') ? 1 : 0;
            var applicant = $('#applicant').val();
            var reason = $('#reason').val();
            var date = $('#day').val();
            var startTime = $('#start_time').val();
            var endTime = $('#end_time').val();
            var programId = $('#programId').val();
            var environment = $('#environment').val();
            var startTimeEnvironment = $('#start_time_environment').val();
            var endTimeEnvironment = $('#end_time_environment').val();


            if (institucionalRequest == 1){
                if (!applicant || !reason || !date || !startTime || !endTime || !environment || !startTimeEnvironment || !endTimeEnvironment) {
                    // Mostrar alerta si algún campo está vacío
                    alert('Por favor, complete todos los campos obligatorios antes de enviar.');
                    return; // Detener la ejecución si hay campos vacíos
                }

                var formData = {
                    institucional_request: institucionalRequest,
                    applicant: applicant,
                    date: date,
                    reason: reason,
                    start_time: startTime,
                    end_time: endTime,
                    program_id: programId,
                    environment: environment,
                    start_time_environment: startTimeEnvironment,
                    end_time_environment: endTimeEnvironment,
                };

                $.ajax({
                    url: '{{ route('sigac.academic_coordination.reports.environments.institucional_request_store') }}', // La ruta a la que se enviarán los datos
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor aquí
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                        if(response.success){
                            Swal.fire({
                                icon: 'success',
                                title: response.success,
                                showConfirmButton: true,
                                timer: 1500,
                                customClass: {
                                    popup: 'my-custom-popup-class',
                                },
                            });
                        }
                        // Puedes cerrar el modal aquí si lo deseas
                        $('#rescheduleModal').modal('hide');
                    },
                    error: function(xhr) {
                        // Manejar los errores aquí
                        console.log('Error al enviar los datos:', xhr.responseText);
                    }
                });
            }else if(institucionalRequest == 0){
                if (!environment || !startTimeEnvironment || !endTimeEnvironment) {
                    // Mostrar alerta si algún campo está vacío
                    alert('Por favor, complete todos los campos obligatorios antes de enviar.');
                    return; // Detener la ejecución si hay campos vacíos
                }

                var formData = {
                    program_id: programId,
                    environment: environment,
                    start_time_environment: startTimeEnvironment,
                    end_time_environment: endTimeEnvironment,
                };

                $.ajax({
                    url: '{{ route('sigac.academic_coordination.reports.environments.institucional_request_store') }}', // La ruta a la que se enviarán los datos
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor aquí
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                        if(response.success){
                            Swal.fire({
                                icon: 'success',
                                title: response.success,
                                showConfirmButton: true,
                                timer: 1500,
                                customClass: {
                                    popup: 'my-custom-popup-class',
                                },
                            });
                        }

                        // Puedes cerrar el modal aquí si lo deseas
                        $('#rescheduleModal').modal('hide');

                    },
                    error: function(xhr) {
                        // Manejar los errores aquí
                        console.log('Error al enviar los datos:', xhr.responseText);
                    }
                });
            }
        });
    });
</script>
