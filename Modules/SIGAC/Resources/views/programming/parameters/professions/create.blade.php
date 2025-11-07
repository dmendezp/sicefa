<div class="modal fade" id="addProfession" tabindex="-1" aria-labelledby="addProfession" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">{{trans('sigac::profession.Add_Profession')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.programming.profession.store', 'method' => 'POST']) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::label('name', trans('sigac::profession.Name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('level', trans('sigac::profession.Level')) !!}
                    {!! Form::select('level', ['' => trans('sigac::profession.Select'), 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo', 'Profesion' => 'Profesion', 'Especialidad' => 'Especialidad', 'Maestria' => 'Maestria', 'Doctorado' => 'Doctorado' ], null, ['class' => 'form-control', 'required']) !!}
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit(trans('sigac::profession.Add'), ['class' => 'btn btn-success','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

