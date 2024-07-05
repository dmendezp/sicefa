<div class="modal fade" id="editResult{{$l->id}}" tabindex="-1" aria-labelledby="editCompetence" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Resultado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'url' => route('sigac.academic_coordination.programming.learning_outcome.update', ['id' => $l->id])]) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::label('competencie_id', 'Competencia') !!}
                    {!! Form::select('competencie_id', $competencies, $l->competencie_id, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::hidden('id', $l->id) !!}
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', $l->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('hour', 'Horas') !!}
                    {!! Form::number('hour', $l->hour, ['class' => 'form-control', 'required']) !!}
                </div>
                
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

