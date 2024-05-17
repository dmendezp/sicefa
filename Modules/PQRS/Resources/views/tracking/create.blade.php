<!-- Modal -->
<div class="modal fade" id="crearPQRS" tabindex="-1" aria-labelledby="crearPQRSLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="crearPQRSLabel">Registrar PQRS</h4>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
        <div class="container text-center">
            {!! Form::open(['url' => route('pqrs.tracking.store'),'method' => 'post']) !!}
            <div class="row">
                <div class="col-6">
                    {!! Form::label('filing_number', 'Numero Radicado') !!}
                    {!! Form::number('filing_number', null, ['class' => 'form-control']) !!}
                    @error('filing_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('nis', 'NIS') !!}
                    {!! Form::number('nis', null, ['class' => 'form-control']) !!}
                    @error('nis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('filing_date', 'Fecha Radicado') !!}
                    {!! Form::date('filing_date', null, ['class' => 'form-control']) !!}
                    @error('filing_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('type_pqrs', 'Asunto') !!}
                    {!! Form::select('type_pqrs', ['' => 'Seleccione el asunto', '1' => 'Peticion', '2' => 'Queja', '3' => 'Sugerencia'], null ,['class' => 'form-control']) !!}
                    @error('type_pqrs')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('start_date', 'Fecha ingreso PQRS') !!}
                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('end_date', 'Limite respuesta de servicio') !!}
                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('responsible', 'Funcionario') !!}
                    {!! Form::select('responsible', [], null ,['class' => 'form-control responsible', 'style' => 'width: 100%;']) !!}
                    @error('responsible')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    {!! Form::label('issue', 'Descripción') !!}
                    {!! Form::textarea('issue', null, ['class' => 'form-control', 'style' => 'height: calc(2.25rem + 2px)']) !!}
                    @error('issue')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>