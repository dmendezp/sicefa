<!-- Modal -->
<div class="modal fade" id="crear_tipoPQRS" tabindex="-1" aria-labelledby="crear_tipoPQRSLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="crear_tipoPQRSLabel">{{ trans('pqrs::tracking.create_pqrs_type') }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="container">
                {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.type_pqrs_store')]) !!}
                <div class="row">
                    <div class="col-12">
                        {!! Form::label('name', trans('pqrs::tracking.name')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('pqrs::tracking.enter_name_of_the_pqrs_type'), 'style' => 'height: 40px']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::tracking.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('pqrs::tracking.save') }}</button>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>