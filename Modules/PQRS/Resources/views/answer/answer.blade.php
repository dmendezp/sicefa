<!-- Modal -->
<div class="modal fade" id="info{{ $p->id }}" tabindex="-1" aria-labelledby="info{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="info{{ $p->id }}Label">{{ trans('pqrs::answer.answer') }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><span class="modal_answer">{{ trans('pqrs::answer.response_date') }}:</span> {{ $p->response_date }}</p>
                    </div>
                    <div class="col-12">
                        <p><span class="modal_answer">{{ trans('pqrs::answer.answer') }}:</span> 
                            @if (isset($p->answer))
                                {{ $p->answer }}
                            @else
                                Sin observaciones.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::answer.close') }}</button>
        </div>
      </div>
    </div>
</div>