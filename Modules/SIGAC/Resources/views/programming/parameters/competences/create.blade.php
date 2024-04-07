<div class="modal fade" id="addCompetence" tabindex="-1" aria-labelledby="addCompetence" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Competencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.competences.store', 'method' => 'POST']) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::label('program_id', 'Programa') !!}
                    {!! Form::select('program_id', $programs, null, ['class' => 'form-control', 'required']) !!}
                </div>
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
                    {!! Form::text('type', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code', 'Codigo') !!}
                    {!! Form::number('code', null, ['class' => 'form-control', 'required']) !!}
                </div>
                
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit(('Registrar Competencia'), ['class' => 'btn btn-success','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>