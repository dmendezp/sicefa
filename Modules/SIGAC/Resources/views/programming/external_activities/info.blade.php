<div class="modal fade" id="info{{$programming->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Tituladas</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach($group as $programming)
                        <li>{{ $programming->course->code . ' - ' . $programming->course->program->name }}</li>
                    @endforeach 
                </ul>
            </div>
        </div>
    </div>  
</div>