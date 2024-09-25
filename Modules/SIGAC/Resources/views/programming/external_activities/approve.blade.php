<div class="modal fade" id="approve{{$programming->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Aprobar solicitud</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('sigac.academic_coordination.programming.external_activities.approved_external_activities'), 'method' => 'POST']) !!}
                @method('POST')
                @php
                    foreach($programming->instructor_program_people as $p){
                        $name = $p->person->full_name;
                    }
                @endphp
                @foreach($group as $programming)
                    {!! Form::hidden('id[]', $programming->id) !!}
                @endforeach 
                <p>Aprobar actividad externa solicitada por {{ $name }}</p>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>