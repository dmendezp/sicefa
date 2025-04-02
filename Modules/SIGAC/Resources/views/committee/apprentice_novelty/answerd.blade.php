<div class="modal fade" id="answerd{{$apprentice_noveltie->id}}" tabindex="-1" aria-labelledby="answerd" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Respuesta')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($apprentice_noveltie->evaluation_committees as $evaluation_committee)
                    <p>
                        {{ $evaluation_committee->answer}}
                    </p>
                @endforeach
            </div>
        </div>
    </div>  
</div>