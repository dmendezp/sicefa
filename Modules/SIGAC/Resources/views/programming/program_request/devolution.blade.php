<div class="modal fade" id="devolution{{$prom->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">{{ trans('Devolución de la solicitud')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.programming.parameters.special_program.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('observation', trans('agrocefa::labor.Observation')) !!}
                    {!! Form::textarea('observation', old('observation'), [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el motivo',
                        'style' => 'max-height: 100px;',
                    ]) !!}
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>
