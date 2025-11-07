<!-- Modal -->
<div class="modal fade" id="reasign{{ $p->id }}" tabindex="-1" aria-labelledby="reasign{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="reasign{{ $p->id }}Label">{{ trans('pqrs::answer.reasign') }} {{ $p->type_pqrs->name }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="container">
                {!! Form::open(['method' => 'post', 'url' => route('pqrs.official.answer.reasign')]) !!}
                    <div class="row">
                        <div class="col-12">
                            {!! Form::label('type', trans('pqrs::answer.type')) !!}
                            {!! Form::select('type', ['' => trans('pqrs::answer.select_the_type_of_assignment'), 'Funcionario' => trans('pqrs::answer.official'), 'Apoyo' => trans('pqrs::answer.assistant')], null ,['class' => 'form-control type', 'style' => 'width: 100%;']) !!}
                        </div>
                        <div class="col-12">
                            {!! Form::hidden('id', $p->id) !!}
                            {!! Form::label('responsible', trans('pqrs::answer.name_of_who_is_assigned')) !!}
                            {!! Form::select('responsible', [], null ,['class' => 'form-control', 'id' => 'responsible']) !!}
                            @error('responsible')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::tracking.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('pqrs::answer.save') }}</button>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>