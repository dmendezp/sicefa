<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('agroindustria::forms.New element') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                                                                                
            
                            {!! Form::label('element_id', trans('agroindustria::menu.Element'), ['class' => 'form-label']) !!}
                            {!! Form::select('element_id', $elements, null, ['class' => 'form-select', 'placeholder' => trans('agroindustria::forms.Select an item'), 'required']) !!}
                          @foreach ($productiveunitwarehouses as $productiveunitwarehouse)
                             {!! Form::hidden('productive_unit_warehouse_id', $productiveunitwarehouse->id) !!}
                             {!! Form::hidden('person_id', '2') !!} 
                             {!! Form::hidden('stock', '10') !!}                                                         
                            @endforeach
                            @foreach ( $inventories as $inventory )
                            {!! Form::hidden('id', $inventory->id) !!}
                            @endforeach    
                            {!! Form::label('expiration_date', trans('agroindustria::menu.Expiration date'), ['class' => 'form-label']) !!}
                            {!! Form::date('expiration_date', null, ['class' => 'form-control', 'placeholder' => trans('agroindustria::forms.select an expiration date'), 'required']) !!}
                            {!! Form::label('price', trans('agroindustria::menu.Price'), ['class' => 'form-label']) !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => trans('agroindustria::forms.Enter a price'), 'required']) !!}
                            {!! Form::label('amount', trans('agroindustria::menu.Stock'), ['class' => 'form-label']) !!}
                            {!! Form::number('amount', null, ['class' => 'form-control', 'placeholder' => trans('agroindustria::forms.Enter the quantity available'), 'required']) !!}
                            {!! Form::label('description', trans('agroindustria::menu.Description'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('agroindustria::forms.Enter a description'), 'style'=> 'width: 100%; height: 100px; resize: none; overflow-y: auto;', 'required']) !!}
                <div class="modal-footer">
                    {!! Form::submit(trans('agroindustria::menu.Save'), ['class' => 'btn btn-primary']) !!}
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('agroindustria::menu.Close')}}</button>
                </div>                                           
            </div>
        </div>
    </div>
</div>   