<!-- Modal -->
<div class="modal fade" id="eliminar{{ $tp->id }}" tabindex="-1" aria-labelledby="eliminar{{ $tp->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="eliminar{{ $tp->id }}">{{ trans('pqrs::tracking.delete_pqrs_type') }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="container">
                {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.type_pqrs_delete', ['id' => $tp->id])]) !!}
                @csrf
                @method('DELETE')
                <div class="row">
                    <div class="col-12">
                        <p>{{ trans('pqrs::tracking.do_you_want_to_delete_the_registration_of') }} <strong>{{ $tp->name }}</strong>?</p>                    
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::tracking.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('pqrs::tracking.yes_delete') }}</button>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>