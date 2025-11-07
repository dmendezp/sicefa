<div class="modal fade" id="editExternal_activity{{$e->id}}" tabindex="-1" aria-labelledby="editExternal_activity" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('sigac::programming.External_Activity_edit')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('sigac.wellbeing.programming.parameters.external_activities.update', ['id' => $e->id]),'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::hidden('id', $e->id) !!}
                    {!! Form::label('name', trans('sigac::general.T_Name')) !!}
                    {!! Form::text('name', $e->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', trans('sigac::general.T_Description')) !!}
                    {!! Form::text('description', $e->description, ['class' => 'form-control', 'required']) !!}
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Update'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>

