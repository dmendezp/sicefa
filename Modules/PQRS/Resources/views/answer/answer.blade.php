<!-- Modal -->
<div class="modal fade" id="info{{ $p->id }}" tabindex="-1" aria-labelledby="info{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="info{{ $p->id }}Label">Respuesta</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <p><span class="modal_answer"># Radicado:</span> {{ $p->filed_response }}</p>
                    </div>
                    <div class="col-6">
                        <p><span class="modal_answer">Fecha respuesta:</span> {{ $p->response_date }}</p>
                    </div>
                    <div class="col-12">
                        <p><span class="modal_answer">Respuesta:</span> {{ $p->answer }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>