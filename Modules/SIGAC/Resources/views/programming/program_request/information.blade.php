<div class="modal fade" id="informationproyecto{{$prom->id}}" tabindex="-1" aria-labelledby="informationproyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Informacion del Solicitante')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Empresa</h5>
                <p>{{ $prom->empresa }}</p>
                <h5>Nombre</h5>
                <p>{{ $prom->applicant }}</p>
                <h5>Correo</h5>
                <p>{{ $prom->email }}</p>
                <h5>Telefono</h5>
                <p>{{ $prom->telephone }}</p>
            </div>
        </div>
    </div>  
</div>