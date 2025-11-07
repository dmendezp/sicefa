<!-- Modal -->
<div class="modal fade" id="filing{{ $p->id }}" tabindex="-1" aria-labelledby="filing{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="filing{{ $p->id }}Label">{{ trans('pqrs::tracking.filing_number_of_the') }} {{ $p->type_pqrs->name }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.answer.store')]) !!}
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    {!! Form::hidden('pqrs_id', $p->id) !!}
                    <div class="col-12">
                        {!! Form::label('filed_response', trans('pqrs::tracking.response_filing_number')) !!}
                        {!! Form::number('filed_response', null, ['class' => 'form-control', 'placeholder' => trans('pqrs::tracking.enter_the_response_file'), 'style' => 'height: 40px']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::tracking.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('pqrs::tracking.save') }}</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>