<div class="modal fade" id="improvement{{$apprentice_noveltie->id}}" tabindex="-1" aria-labelledby="improvement" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Plan de Mejoramiento')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Encargado del Plan de Mejoramiento</h5>
                @foreach($apprentice_noveltie->evaluation_committees as $evaluation_committee)
                    @foreach($evaluation_committee->committee_staffs as $committee_staff)
                    @if ($committee_staff->role == 'Plan Mejoramiento')
                    <p>
                        {{ $committee_staff->person->first_name }} {{ $committee_staff->person->first_last_name }} {{ $committee_staff->person->second_last_name }}
                    </p>
                    @endif
                   
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>  
</div>