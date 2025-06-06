<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Eliminar programación</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => route('sigac.academic_coordination.programming.management.destroy'), 'method' => 'post']) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::hidden('person_id', null, ['id' => 'person_id']) !!}
                    {!! Form::label('code_course', 'Curso') !!}
                    {!! Form::number('code_course', null, ['class' => 'form-control', 'id' => 'code_course', 'placeholder' => 'Ingrese el codigo de la ficha']) !!}
                    <span id="program_name" style="display: none"></span>
                </div>
                <div class="form-group">
                    {!! Form::label('quarter', 'Trimestre') !!}
                    {!! Form::select('quarter', $quarter, null, ['class' => 'form-control','placeholder' => 'Ingrese el trimestre']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('days', 'Dias') !!}
                    {!! Form::select('days', $days, null, ['class' => 'form-control', 'id' => 'days', 'placeholder' => 'Seleccione un dia']) !!}
                </div>
                {!! Form::submit('Eliminar', ['class' => 'btn btn-primary',]) !!}
                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>  |
</div>
