<div class="modal fade" id="observation{{$apprentice_noveltie->id}}" tabindex="-1" aria-labelledby="reason" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Observación')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $apprentice_noveltie->observation }}</p>
            </div>
        </div>
    </div>  
</div>