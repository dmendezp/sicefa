<div class="modal" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vacancyTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            Descripción General:
                        </div>
                        <p id="vacancyDescription"></p>
                        <div class="card-header">
                            Requisitos:
                        </div>
                        <ul id="vacancyRequirements" class="list-unstyled">
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="{{ route('inscription') }}" class="btn btn-primary">Inscripción</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal inscripcion a vacante disponible -->
