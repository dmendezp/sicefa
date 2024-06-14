<!-- Modal -->
<div class="modal fade" id="answer{{ $p->id }}" tabindex="-1" aria-labelledby="answer{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="answer{{ $p->id }}Label">{{ trans('pqrs::answer.reply_pqrs') }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          <div class="container">
            {!! Form::open(['method' => 'post', 'url' => route('pqrs.official.answer.store')]) !!}
                <div class="row">
                    {!! Form::hidden('pqrs_id', $p->id) !!}
                    <div class="col-12">
                        {!! Form::label('answer', trans('pqrs::answer.answer')) !!}
                        {!! Form::textarea('answer', null, ['class' => 'form-control', 'placeholder' => trans('pqrs::answer.enter_your_answer'), 'style' => 'height: 40px']) !!}
                        @error('answer')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6">
                      {!! Form::label('type_answer', trans('pqrs::answer.type_of_answer')) !!}
                      {!! Form::select('type_answer', ['' => trans('pqrs::answer.select_the_type_of_answer'), 'RESPUESTA GENERADA' => trans('pqrs::answer.generated_response'), 'RESPUESTA PARCIAL' => trans('pqrs::answer.partial_answer')], null, ['class' => 'form-control']) !!}
                      @error('type_answer')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="col-6">
                        {!! Form::label('response_date', trans('pqrs::answer.response_date')) !!}
                        {!! Form::date('response_date', now()->format('Y-m-d'), ['class' => 'form-control']) !!}
                        @error('response_date')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::answer.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('pqrs::answer.save') }}</button>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>