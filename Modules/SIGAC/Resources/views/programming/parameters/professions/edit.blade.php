<div class="modal fade" id="editProfession{{$p->id}}" tabindex="-1" aria-labelledby="editProfession" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Profesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'url' => route('sigac.academic_coordination.profession.update', ['id' => $p->id])]) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::hidden('id', $p->id) !!}
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', $p->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('level', 'Nivel') !!}
                    {!! Form::select('level', ['' => '---Seleccione---', 'Operario' => 'Operario', 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo'],$p->level, ['class' => 'form-control'],
                    ) !!}
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Guardar', ['class' => 'btn btn-success','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

