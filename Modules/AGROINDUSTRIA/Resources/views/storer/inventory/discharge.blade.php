<!-- Modal -->
<div class="modal fade" id="dischargeModal{{$item['inventory_id']}}" tabindex="-1" aria-labelledby="dischargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="dischargeModalLabel">{{trans('agroindustria::deliveries.discharge')}} {{$item['element_name']}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['method' => 'post', 'url' => route('agroindustria.admin.units.remove.create')]) !!}
        <div class="modal-body">
            {!! Form::hidden('warehouse', $wId, ['id' => 'warehouse']) !!}
            {!! Form::hidden('element', $item['inventory_id'], ['id' => 'element']) !!}
            {!! Form::hidden('amount', $item['amount'], ['id' => 'amount']) !!}
            {!! Form::hidden('price', $item['price'], ['id' => 'price']) !!}
            <div class="col-md-12">
                {{--{!! Form::hidden('productiveUnitWarehouse', $productiveUnitWarehouse, ['id' => 'productiveUnitWarehouse']) !!}--}}
                {{--{!! Form::hidden('warehouseId', $warehouseId, ['id' => 'warehouseId']) !!}--}}
                {!! Form::label('date', trans('agroindustria::deliveries.dateTime')) !!}
                {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
            </div>
            <div class="col-md-12">
                {!! Form::label('observation', trans('agroindustria::deliveries.observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea'] ) !!}
                @error('observation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('agroindustria::deliveries.close')}}</button>
            {!! Form::submit(trans('agroindustria::deliveries.Register deregistration'),['class' => 'baja btn btn-success', 'name' => 'baja']) !!}
        </div>
        {!! Form:: close() !!}
      </div>
    </div>
</div>