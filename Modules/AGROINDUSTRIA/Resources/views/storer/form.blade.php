<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('agroindustria::forms.New element') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                                                                                
            
                            {!! Form::label('element_id', 'Elemento.', ['class' => 'form-label']) !!}
                            {!! Form::select('element_id', $elements, null, ['class' => 'form-select', 'placeholder' => trans('agroindustria::forms.Select an item'), 'required']) !!}
q                            @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                             {!! Form::hidden('productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                             {!! Form::hidden('person_id', '2') !!} 
                             {!! Form::hidden('stock', '10') !!}                                                         
                            @endforeach
                            @foreach ( $inventories as $inventory )
                            {!! Form::hidden('id', $inventory->id) !!}
                            @endforeach    
                            {!! Form::label('expiration_date', 'Fecha de expiracion.', ['class' => 'form-label']) !!}
                            {!! Form::date('expiration_date', null, ['class' => 'form-control', 'placeholder' => 'Seleccione Fecha de vencimiento.', 'required']) !!}
                            <div class="invalid-feedback">Por favor seleccione una fecha de expiración.</div>     
                            {!! Form::label('price', 'Precio.', ['class' => 'form-label']) !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Precio.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese un precio.</div>
                            {!! Form::label('amount', 'Disponible.', ['class' => 'form-label']) !!}
                            {!! Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad disponible.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese la cantidad disponible.</div>      
                            {!! Form::label('description', 'Descripcion.', ['class' => 'form-label']) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion.', 'style'=> 'width: 100%; height: 100px; resize: none; overflow-y: auto;', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese una descripción.</div>                        
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>                                           
            </div>
        </div>
    </div>
</div>   