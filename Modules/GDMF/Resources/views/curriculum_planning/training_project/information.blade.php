<div class="modal fade" id="informationproyecto{{$t->id}}" tabindex="-1" aria-labelledby="informationproyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Informacion Proyecto Formativo')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2>Objetivo</h2>
                <p>{{ $t->objective }}</p>
            </div>
        </div>
    </div>  
</div>