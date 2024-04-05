<div class="modal fade" id="deleteProfession{{$p->id}}" tabindex="-1" aria-labelledby="deleteProfession" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Eliminar Profesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'url' => route('sigac.academic_coordination.profession.destroy', ['id' => $p->id])]) !!}
                @csrf
                @method('POST')
                <div class="form-group">
                    {!! Form::hidden('id', $p->id) !!}
                    <p>¿Estás seguro de eliminar esta profesión?</p>
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Si, eliminar', ['class' => 'btn btn-success','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>