<div class="modal fade" id="informationproyecto{{$prom->id}}" tabindex="-1" aria-labelledby="informationproyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"><b>{{ trans('Informacion del Solicitante')}}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5><b>Empresa</b></h5>
                <p>{{ $prom->empresa }}</p>
                <h5><b>Dirección</b></h5>
                <p>{{ $prom->address }}</p>
                <h5><b>Nombre</b></h5>
                <p>{{ $prom->applicant }}</p>
                <h5><b>Correo</b></h5>
                <p>{{ $prom->email }}</p>
                <h5><b>Telefono</b></h5>
                <p>{{ $prom->telephone }}</p>
            </div>
        </div>
    </div>  
</div>