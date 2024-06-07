<!-- Modal -->
<div class="modal fade" id="answer{{ $p->id }}" tabindex="-1" aria-labelledby="answer{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="answer{{ $p->id }}Label">Responder PQRS</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          <div class="container">
            {!! Form::open(['method' => 'post', 'url' => route('pqrs.official.answer.store')]) !!}
                <div class="row">
                    {!! Form::hidden('pqrs_id', $p->id) !!}
                    <div class="col-12">
                        {!! Form::label('answer', 'Respuesta') !!}
                        {!! Form::textarea('answer', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su respuesta', 'style' => 'height: 40px']) !!}
                        @error('answer')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6">
                      {!! Form::label('type_answer', 'Tipo de respuesta') !!}
                      {!! Form::select('type_answer', ['' => 'Seleccione el tipo de respuesta', 'RESPUESTA GENERADA' => 'Respuesta generada', 'RESPUESTA PARCIAL' => 'Respuesta parcial'], null, ['class' => 'form-control']) !!}
                      @error('type_answer')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="col-6">
                        {!! Form::label('response_date', 'Fecha Respuesta') !!}
                        {!! Form::date('response_date', now()->format('Y-m-d'), ['class' => 'form-control']) !!}
                        @error('response_date')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>