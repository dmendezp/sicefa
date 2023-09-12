<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ditar.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                                                                                
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            {!! Form::label('element_id', 'Elemento.', ['class' => 'form-label']) !!}
                            {!! Form::select('element_id', $elements, null, ['class' => 'form-select', 'placeholder' => 'Seleccione elemento', 'required']) !!}
                            <div class="invalid-feedback">Por favor seleccione un elemento.</div>
                        </div>                                                     
                        @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                            {!! Form::hidden('productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                            {!! Form::hidden('person_id', '2') !!}                                                          
                        @endforeach
                        @foreach ( $inventories as $inventory )
                        {!! Form::hidden('id', $inventory->id) !!}
                        @endforeach                                                                                                                        
                        <div class="mb-3">
                            {!! Form::label('description', 'Descripcion.', ['class' => 'form-label']) !!}
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese una descripción.</div>
                        </div>
                    </div>                                            
                    <div class="col">
                        <div class="mb-3">
                            {!! Form::label('price', 'Precio.', ['class' => 'form-label']) !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Precio.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese un precio.</div>
                        </div>                                                      
                        <div class="mb-3">
                            {!! Form::label('stock', 'Disponible.', ['class' => 'form-label']) !!}
                            {!! Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad disponible.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese la cantidad disponible.</div>
                        </div>                                                       
                        <div class="mb-3">
                            {!! Form::label('expiration_date', 'Fecha de expiracion.', ['class' => 'form-label']) !!}
                            {!! Form::date('expiration_date', null, ['class' => 'form-control', 'placeholder' => 'Seleccione Fecha de vencimiento.', 'required']) !!}
                            <div class="invalid-feedback">Por favor seleccione una fecha de expiración.</div>
                        </div>                  
                    </div>
                </div>                                             
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>                                           
            </div>
        </div>
    </div>
</div>   