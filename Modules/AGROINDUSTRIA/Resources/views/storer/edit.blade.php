<div class="modal fade" id="editModal{{$inventory->id}}" tabindex="-1" aria-labelledby="editModal{{$inventory->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">{{trans('agroindustria::menu.Edit')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">  
                @if (isset($inventory))
                {!! Form::hidden('id', $inventory->id) !!}
                @endif
                            {!! Form::label('element_id', trans('agroindustria::menu.Element'), ['class' => 'form-label']) !!}
                            {!! Form::select('new_element_id', $elements, isset($inventory) ? $inventory->element_id : null, ['class' => 'form-select', 'placeholder' => 'Seleccione elemento', 'required']) !!}
                            <div class="invalid-feedback">{{trans('agroindustria::menu.Select an item')}}</div>                                          
                        @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                            {!! Form::hidden('new_productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                            {!! Form::hidden('new_person_id', '2') !!}
                            {!! Form::hidden('new_stock', '10') !!}                          
                        @endforeach                                              
                            {!! Form::label('expiration_date',trans('agroindustria::menu.Expiration date'), ['class' => 'form-label']) !!}
                            {!! Form::date('new_expiration_date', isset($inventory) ? $inventory->expiration_date : null, ['class' => 'form-control', 'placeholder' => 'Seleccione Fecha de vencimiento.', 'required']) !!}
                            {!! Form::label('price',trans('agroindustria::menu.Price'), ['class' => 'form-label']) !!}
                            {!! Form::number('new_price', isset($inventory) ? $inventory->price : null, ['class' => 'form-control', 'placeholder' => 'Ingrese Precio.', 'required']) !!}
                            {!! Form::label('amount',trans('agroindustria::menu.Stock'), ['class' => 'form-label']) !!}
                            {!! Form::number('new_amount', isset($inventory) ? $inventory->amount : null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad disponible.', 'required']) !!}
                            {!! Form::label('description',  trans('agroindustria::menu.Description'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('new_description', isset($inventory) ? $inventory->description : null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion.','style'=> 'width: 100%; height: 100px; resize: none; overflow-y: auto;','required']) !!}
                <div class="modal-footer">
                    {!! Form::submit(trans('agroindustria::menu.Save'), ['class' => 'btn btn-primary']) !!}
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('agroindustria::menu.Close')}}</button>
                </div>                    
            </div>
        </div>
    </div>
</div>   