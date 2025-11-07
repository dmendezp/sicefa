<div class="modal fade" id="addCompetence" tabindex="-1" aria-labelledby="addCompetence" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Competencia</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.programming.competence.store', 'method' => 'POST']) !!}
                @csrf
                @method('POST')
                {!! Form::hidden('program_id', $program_id ) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('hour', 'Horas') !!}
                    {!! Form::number('hour', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Tipo') !!}
                    {!! Form::select('type', ['' => trans('Seleccione el tipo'), 'Técnico' => 'Técnico', 'Transversal' => 'Transversal', 'Bilingüismo' => 'Bilingüismo'], null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code', 'Codigo') !!}
                    {!! Form::number('code', null, ['class' => 'form-control', 'required']) !!}
                </div>
                
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit(('Guardar'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>