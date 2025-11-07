<!-- Modal Aprobar-->
<div class="modal fade" id="delete{{$f->id}}" tabindex="-1" aria-labelledby="aprobarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="aprobarLabel">{{trans('agroindustria::formulations.Delete')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('agroindustria.instructor.units.formulations.delete', ['id' => $f->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                {{ Form::hidden('id', $f->id)}}
                <div class="form-group">
                    <p id="delete_receipe">¿{{trans('agroindustria::formulations.You want to remove the recipe from')}} {{$f->element->name}}?</p>
                </div>                
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">{{trans('agroindustria::formulations.Delete')}}</button>
        </form>
        </div>
      </div>
    </div>
  </div>