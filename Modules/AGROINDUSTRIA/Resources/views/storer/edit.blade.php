<div class="modal fade" id="editModal{{$inventory->id}}" tabindex="-1" aria-labelledby="editModal{{$inventory->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Editar.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">  
                @if (isset($inventory))
                {!! Form::hidden('id', $inventory->id) !!}
                @endif
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            {!! Form::label('element_id', 'Elemento.', ['class' => 'form-label']) !!}
                            {!! Form::select('new_element_id', $elements, isset($inventory) ? $inventory->element_id : null, ['class' => 'form-select', 'placeholder' => 'Seleccione elemento', 'required']) !!}
                            <div class="invalid-feedback">Por favor seleccione un elemento.</div>
                        </div>                     
                        @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                            {!! Form::hidden('new_productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                            {!! Form::hidden('new_person_id', '2') !!}
                            
                        @endforeach            
                        <div class="mb-3">
                            {!! Form::label('description', 'Descripcion.', ['class' => 'form-label']) !!}
                            {!! Form::text('new_description', isset($inventory) ? $inventory->description : null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese una descripción.</div>
                        </div>
                    </div>           
                    <div class="col">
                        <div class="mb-3">
                            {!! Form::label('price', 'Precio.', ['class' => 'form-label']) !!}
                            {!! Form::number('new_price', isset($inventory) ? $inventory->price : null, ['class' => 'form-control', 'placeholder' => 'Ingrese Precio.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese un precio.</div>
                        </div>
                        
                        <div class="mb-3">
                            {!! Form::label('stock', 'Disponible.', ['class' => 'form-label']) !!}
                            {!! Form::number('new_stock', isset($inventory) ? $inventory->amount : null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad disponible.', 'required']) !!}
                            <div class="invalid-feedback">Por favor ingrese la cantidad disponible.</div>
                        </div>
                        
                        <div class="mb-3">
                            {!! Form::label('expiration_date', 'Fecha de expiracion.', ['class' => 'form-label']) !!}
                            {!! Form::date('new_expiration_date', isset($inventory) ? $inventory->expiration_date : null, ['class' => 'form-control', 'placeholder' => 'Seleccione Fecha de vencimiento.', 'required']) !!}
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