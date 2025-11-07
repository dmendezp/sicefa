<div class="modal fade" id="editCompetence{{$c->id}}" tabindex="-1" aria-labelledby="editCompetence" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Competencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'url' => route('sigac.academic_coordination.programming.competence.update', ['id' => $c->id])]) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::label('program_id', 'Programa') !!}
                    {!! Form::select('program_id', $programs, $c->program_id, ['class' => 'form-control', 'id' =>'program','required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::hidden('id', $c->id) !!}
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', $c->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('hour', 'Horas') !!}
                    {!! Form::number('hour', $c->hour, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Tipo') !!}
                    {!! Form::select('type', ['' => trans('Seleccione el tipo'), 'Técnico' => 'Técnico', 'Transversal' => 'Transversal', 'Bilingüismo' => 'Bilingüismo'], $c->type, ['class' => 'form-control', 'required']) !!}
                    
                </div>
                <div class="form-group">
                    {!! Form::label('code', 'Codigo') !!}
                    {!! Form::number('code', $c->code, ['class' => 'form-control', 'required']) !!}
                </div>
                
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#program').select2();
    });
</script>

