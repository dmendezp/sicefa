<div class="modal fade" id="reschedule{{$programs->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Subir documentos faltantes</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    {!! Form::checkbox('institucional_request', false) !!}
                    {!! Form::label('institucional_request', 'Solicitud institucional') !!}
                </div>
                <div class="form-applicant" style="display: none">
                    <div class="form-group">
                        {!! Form::label('applicant', 'Solicitante') !!}
                        {!! Form::select('applicant', [], ['class' => 'form-control', 'id' => 'applicant']) !!}
                        <div id="applicant-list" class="list-group"></div>                    
                    </div>
                    <div class="form-group">
                        <div class="row">      
                            <div class="col-6">
                                {!! Form::label('start_time', 'Hora inicio') !!}
                                {!! Form::time('start_time', null, ['class' => 'form-control']) !!}</div>
                            <div class="col-6">
                                {!! Form::label('end_time', 'Hora fin') !!}
                                {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @php              
                    use Modules\SICA\Entities\Environment;
     
                    $programmedEnvironmentIds = $programs->environment_instructor_programs->pluck('environment_id')->toArray();

                    // Obtener los ambientes que NO están programados
                    $unprogrammedEnvironments = Environment::whereNotIn('id', $programmedEnvironmentIds)->pluck('name', 'id');
                @endphp
                <div class="form-group">
                    {!! Form::label('change_environment', 'Cambio de ambiente') !!}
                    {!! Form::select('environment', $unprogrammedEnvironments, null, ['class' => 'form-control', 'id' => 'environment', 'placeholder' => 'Buscar ambiente']) !!}
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
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
    });
</script>
