{{-- Modal Actividad --}}
<div class="modal fade" id="crearactividad" tabindex="-1" aria-labelledby="crearactividad" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Actividad Externa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.wellbeing.programming.parameters.external_activities.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', trans('agrocefa::parameters.Modal_Name_Activity')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', trans('agrocefa::parameters.Modal_Description')) !!}
                    {!! Form::text('description', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <br>
                {!! Form::submit(trans('Registrar Actividad Externa'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>