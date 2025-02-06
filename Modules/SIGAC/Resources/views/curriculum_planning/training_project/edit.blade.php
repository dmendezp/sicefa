<div class="modal fade" id="editproyecto{{$t->id}}" tabindex="-1" aria-labelledby="editproyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Actualizar Proyecto Formativo')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.curriculum_planning.training_project.update', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::hidden('id', $t->id) !!}
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', $t->name, ['class' => 'form-control','placeholder' => 'Ingrese el nombre', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code', 'Codigo') !!}
                    {!! Form::number('code', $t->code, ['class' => 'form-control','placeholder' => 'Ingrese el codigo', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('execution_time', 'Tiempo de ejecucion (Meses)') !!}
                    {!! Form::number('execution_time', $t->execution_time, ['class' => 'form-control','placeholder' => 'Ingrese el número de meses de ejecucion', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('objective', trans('Objetivo')) !!}
                    {!! Form::textarea('objective', $t->objective, [
                        'class' => 'form-control',
                        'style' => 'max-height: 100px;',
                    ]) !!}
                </div>
                <br>
                {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>

