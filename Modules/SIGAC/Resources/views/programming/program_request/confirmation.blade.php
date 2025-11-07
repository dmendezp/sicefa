<div class="modal fade" id="characterization{{$prom->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">{{ trans('Caracterizar')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('sigac.support.programming.program_request.characterization.store', ['id' => $prom->id]), 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('code_empresa', trans('Codigo de la empresa')) !!}
                    {!! Form::number('code_empresa', null, ['class' => 'form-control','placeholder' => 'Ingrese el codigo de la empresa', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code_course', trans('No. Ficha')) !!}
                    {!! Form::number('code_course', null, ['class' => 'form-control','placeholder' => 'Ingrese el codigo de la ficha', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('date_inscription', trans('Fecha de inscripción del curso')) !!}
                    {!! Form::date('date_inscription', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>
