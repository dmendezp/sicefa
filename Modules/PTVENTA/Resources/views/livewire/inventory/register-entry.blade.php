<div>

    <!-- Seleccionar y agregar producto -->
    <div class="row mx-3">
        <!-- Responsables y bodegas -->
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header text-center py-1">
                    <strong>{{ trans('ptventa::inventory.TitleCard2')}}</strong>
                </div>
                <div class="card-body tex-center pt-0">
                    <label class="form-label my-0 mt-1">{{ trans('ptventa::inventory.SubTitleCard2')}}</label>
                    <select class="form-select form-select-sm mb-2" id="dpu_id" wire:model="dpu_id">
                        <option value="">{{ trans('ptventa::inventory.SubTextCard2')}}</option>
                        @foreach ($productive_units as $pw)
                            <option value="{{ $pw->id }}">{{ $pw->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-select form-select-sm" wire:model="dpuw_id" @if(empty($puwarehouses)) disabled @endif>
                        <option value="" data-name="">{{ trans('ptventa::inventory.SubTextCard3')}}</option>
                        @if (!empty($puwarehouses))
                            @foreach ($puwarehouses as $puwarehouse)
                                <option value="{{ $puwarehouse->id }}">{{ $puwarehouse->warehouse->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label class="form-label my-0">{{ trans('ptventa::inventory.SubTitleCard3')}}</label>
                    {!! Form::text(null, $delivery_person ? $delivery_person->full_name : null, [
                        'class'=>'form-control form-control-sm',
                        'readonly'
                    ])!!}
                    <hr class="mb-1">
                    <label class="form-label my-0">{{ trans('ptventa::inventory.SubTitleCard4')}}</label>
                    {!! Form::text(null, $puw->warehouse->name, [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                    <label class="form-label my-0">{{ trans('ptventa::inventory.SubTitleCard5')}}</label>
                    {!! Form::text(null, Auth::user()->person->full_name, [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                </div>
            </div>
        </div>

        <!-- Datos de inventario para el producto -->
        <div class="col-md-9 h-100">
            <form wire:submit.prevent="addProduct" method="POST">
                <div class="row mx-3 align-items-end">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label><strong class="text-danger">* </strong>{{ trans('ptventa::inventory.TitleForm1')}}</label>
                            <select class="form-select" name="product_element_id" id="product_element_id" wire:model.defer="product_element_id" required>
                                <option value="" data-price="">-- Selecciona --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ priceFormat($product->price) }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ trans('ptventa::inventory.TitleForm2')}}</label>
                            {!! Form::text('product_price', $product_price, [
                                'class'=>'form-control text-center',
                                'wire:model'=>'product_price',
                                'id'=>'product_price',
                                'readonly',
                                'required'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label><strong class="text-danger">* </strong>{{ trans('ptventa::inventory.TitleForm3')}}</label>
                            {!! Form::number('product_amount', $product_amount, [
                                'class'=>'form-control text-center',
                                'wire:model.defer'=>'product_amount',
                                'id'=>'product_amount',
                                'required'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>{{ trans('ptventa::inventory.TitleForm4')}}</label>
                            {!! Form::date(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_production_date'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>{{ trans('ptventa::inventory.TitleForm5')}}</label>
                            {!! Form::date(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_expiration_date'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>{{ trans('ptventa::inventory.TitleForm6')}}</label>
                            {!! Form::number(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_lot_number'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>{{ trans('ptventa::inventory.TitleForm7')}}</label>
                            {!! Form::number(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_inventory_code'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group my-0">
                            <div class="form-floating">
                                {!! Form::textarea(null, null, [
                                    'class'=>'form-control',
                                    'style'=>'height: 124px',
                                    'placeholder'=>'Registre alguna observación',
                                    'wire:model.defer'=>'product_description'
                                ]) !!}
                                <label>{{ trans('ptventa::inventory.TitleForm8')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ trans('ptventa::inventory.TitleForm9')}}</label>
                                    {!! Form::text(null, null, [
                                        'class'=>'form-control',
                                        'wire:model.defer'=>'product_mark'
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label><strong class="text-danger">* </strong>{{ trans('ptventa::inventory.TitleForm10')}}</label>
                                    {!! Form::select(null, $destinations, 'null', [
                                        'class'=>'form-select',
                                        'placeholder'=>'-- Selecciona --',
                                        'wire:model.defer'=>'product_destination',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mx-auto">
                            <button type="submit" class="btn btn-success form-control text-truncate">{{ trans('ptventa::inventory.Btn3')}} <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Productos seleccionados -->
    <div class="row mx-3 mt-1">
        <div class="card shadow-sm">
            <div class="col-md-12 h-100">
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">{{ trans('ptventa::inventory.2T1')}}</th>
                                <th>{{ trans('ptventa::inventory.2T2')}}</th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ trans('ptventa::inventory.2T8')}}">
                                    <i class="fas fa-barcode"></i>
                                </th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ trans('ptventa::inventory.2T9')}}">
                                    <i class="far fa-file-alt"></i>
                                </th>
                                <th class="text-center">{{ trans('ptventa::inventory.2T3')}}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.2T4')}}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.2T5')}}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.2T6')}}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.2T7')}}</th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ trans('ptventa::inventory.2T12')}}"><i class="fas fa-arrow-circle-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selected_products as $index =>  $sp)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $sp['product_name'] }}</td>
                                    <td class="text-center">
                                        @if (empty($sp['product_inventory_code']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            <i class="fas fa-check text-success"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (empty($sp['product_description']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            <i class="fas fa-check text-success"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ priceFormat($sp['product_price']) }}</td>
                                    <td class="text-center">{{ $sp['product_amount'] }}</td>
                                    <td class="text-center">
                                        @if (empty($sp['product_production_date']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            {{ $sp['product_production_date'] }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (empty($sp['product_expiration_date']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            {{ $sp['product_expiration_date'] }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (empty($sp['product_lot_number']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            {{ $sp['product_lot_number'] }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip" data-placement="right" title="{{ trans('ptventa::inventory.Tooltip1')}}"
                                            wire:click="editProduct({{ $index }})" wire:loading.attr="disabled" wire:target="editProduct">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip" data-placement="right" title="{{ trans('ptventa::inventory.Tooltip2')}}"
                                            wire:click="deleteProduct({{ $index }})" wire:loading.attr="disabled" wire:target="deleteProduct">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Registro de entrada -->
    <div class="d-flex justify-content-evenly">
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-success form-control text-truncate" wire:click="registerEntry" wire:loading.attr="disabled" wire:targer="registerEntry">
                    {{ trans('ptventa::inventory.Btn4')}} <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
    </div>

    @section('sripts-register-entry')
        <!-- Scripts del plugin para imprimer en impresoras termicas -->
        <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
        <!-- Formateadores de datos -->
        <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
        <!-- Scripts del componente register-entry -->
        <script src="{{ asset('modules/ptventa/js/inventory/entry/livewire-register-entry.js') }}"></script>
    @endsection

</div>
