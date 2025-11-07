<div class="modal fade" id="editSpecialprogram{{$special->id}}" tabindex="-1" aria-labelledby="editSpecialprogram" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('sigac::programming.Special_Program_edit')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('sigac.academic_coordination.programming.parameters.special_program.update', ['id' => $special->id]),'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::hidden('id', $special->id) !!}
                    {!! Form::label('name', trans('sigac::general.T_Name')) !!}
                    {!! Form::text('name', $special->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Update'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>

