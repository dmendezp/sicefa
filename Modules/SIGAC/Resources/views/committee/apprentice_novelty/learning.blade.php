<div class="modal fade" id="learning{{$apprentice_noveltie->id}}" tabindex="-1" aria-labelledby="learning" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Resultados de Aprendizaje')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Resultados de Aprendizaje</h5>
                @foreach($apprentice_noveltie->learningoutcomecommittees as $learningoutcomecommittee)
                <p>
                    - {{ $learningoutcomecommittee->learning_outcome->name }}
                </p>
                @endforeach
            </div>
        </div>
    </div>  
</div>