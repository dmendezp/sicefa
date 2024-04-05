<div class="modal fade" id="addProfession" tabindex="-1" aria-labelledby="addProfession" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Profesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.profession.store', 'method' => 'POST']) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('level', 'Nivel') !!}
                    {!! Form::select('level', ['' => '---Seleccione---', 'Operario' => 'Operario', 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo'], null, ['class' => 'form-control'],) !!}
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit(trans('agrocefa::parameters.Btn_Register_Activity'), ['class' => 'btn btn-success','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

