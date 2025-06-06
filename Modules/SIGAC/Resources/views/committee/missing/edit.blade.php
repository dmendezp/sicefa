<div class="modal fade" id="editfault{{$missing->id}}" tabindex="-1" aria-labelledby="editfault" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Editar Falta Cometida')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('sigac.academic_coordination.committee.missing.update'),'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::hidden('id', $missing->id) !!}
                    {!! Form::label('name', trans('sigac::general.T_Name')) !!}
                    {!! Form::text('name', $missing->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Tipo') !!}
                    {!! Form::select('type', ['Leve' => 'Leve', 'Grave' => 'Grave', 'Gravisima' => 'Gravisima'], $missing->type, [
                        'class' => 'form-control',
                        'placeholder' => 'Seleccione el tipo',
                        'id' => 'type',
                        'height' => '50px',
                    ]) !!}
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Update'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>

