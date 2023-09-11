<div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="col-form-label col-form-label-sm">{{ trans('ptventa::inventory.Title_Form_Origin_Warehouse') }}</label>
                    {!! Form::text(null, $puw->warehouse->name, [
                        'class' => 'form-control form-control-sm',
                        'disabled',
                    ]) !!}
                </div>
                <div class="col-md-6">
                    <label class="col-form-label col-form-label-sm">{{ trans('ptventa::inventory.Title_Form_Reponsibility_Low') }}</label>
                    {!! Form::text(null, Auth::user()->person->full_name, [
                        'class' => 'form-control form-control-sm',
                        'disabled',
                    ]) !!}
                </div>
            </div>

            <form wire:submit.prevent="addProduct" method="POST">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label my-0">
                                <strong class="text-danger">*</strong>{{ trans('ptventa::inventory.Title_Form_Product') }}
                            </label>
                            <select class="form-select form-control-sm" name="inventory_id" id="inventory_id" wire:model="inventory_id" required>
                                <option value="">{{ trans('ptventa::inventory.Select_Form_Product') }}</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ priceFormat($product->price) }}">
                                        {{ $product->element->product_name }} - {{ $product->expiration_date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Lot_Number') }}</label>
                            {!! Form::text('product_lot_number', isset($inventory) ? $inventory->lot_number : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'id' => 'product_lot_number',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Inventory_Code') }}</label>
                            {!! Form::text('product_inventory_code', isset($inventory) ? $inventory->inventory_code : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'id' => 'product_inventory_code',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Production_Date') }}</label>
                            {!! Form::text('product_production_date', isset($inventory) ? $inventory->production_date : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'id' => 'product_production_date',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Expiration_Date') }}</label>
                            {!! Form::text('product_expiration_date', isset($inventory) ? $inventory->expiration_date : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'id' => 'product_expiration_date',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 my-auto">
                        <div class="form-group my-0">
                            <div class="form-floating">
                                {!! Form::textarea(null, null, [
                                    'class' => 'form-control',
                                    'style' => 'height: 124px',
                                    'placeholder' => 'Registre alguna observación',
                                    'wire:model.defer' => 'observation'
                                ]) !!}
                                <label>{{ trans('ptventa::inventory.Title_Form_Observation') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Price') }}</label>
                                    {!! Form::text('product_price', isset($inventory) ? $inventory->price : '', [
                                        'class' => 'form-control form-control-sm text-center',
                                        'id' => 'product_price',
                                        'readonly',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Existing_Amount') }}</label>
                                    {!! Form::text('amount', isset($inventory) ? $inventory->amount : '', [
                                        'class' => 'form-control form-control-sm text-center',
                                        'id' => 'amount',
                                        'readonly',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label my-0">
                                        <strong class="text-danger">*</strong>{{ trans('ptventa::inventory.Title_Form_Amount') }}
                                    </label>
                                    {!! Form::number('product_amount', null, [
                                        'class' => 'form-control form-control-sm text-center',
                                        'wire:model.defer' => 'product_amount',
                                        'id' => 'product_amount',
                                        'step' => 0,
                                        'min' => 0,
                                        'required',
                                        isset($inventory) ? '' : 'disabled'
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Mark') }}</label>
                                    {!! Form::text('product_mark', isset($inventory) ? $inventory->mark : '', [
                                        'class' => 'form-control form-control-sm text-center',
                                        'id' => 'product_mark',
                                        'readonly',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label my-0">{{ trans('ptventa::inventory.Title_Form_Destination') }}</label>
                                    {!! Form::text('product_destination', isset($inventory) ? $inventory->destination : '', [
                                        'class' => 'form-control form-control-sm text-center',
                                        'id' => 'product_destination',
                                        'readonly',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4 my-auto">
                                <div class="form-group my-0">
                                    <button type="submit" class="btn btn-success btn-sm form-control">{{ trans('ptventa::inventory.Btn_Add_List') }}
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Productos seleccionados -->
    <div class="row mx-1 mt-1">
        <div class="card shadow-sm">
            <div class="col-md-12 h-100">
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">{{ trans('ptventa::inventory.4T_Number') }}</th>
                                <th>{{ trans('ptventa::inventory.4T_Product') }}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.4T_Lot_Number') }}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.4T_Inventory_Code') }}</th>
                                <th class="text-center"><i class="fa-solid fa-calendar-days"></i> {{ trans('ptventa::inventory.4T_Production_Date') }}</th>
                                <th class="text-center"><i class="fa-solid fa-calendar-days"></i> {{ trans('ptventa::inventory.4T_Expiration_Date') }}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.4T_Mark') }}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.4T_Price') }}</th>
                                <th class="text-center">{{ trans('ptventa::inventory.4T_Amount') }}</th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ trans('ptventa::inventory.4T_Actions') }}">
                                    <i class="fas fa-arrow-circle-down"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selected_products as $index => $sp)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $sp['product_name'] }}</td>
                                    <td class="text-center">
                                        @if (empty($sp['product_lot_number']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            {{ $sp['product_lot_number'] }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (empty($sp['product_inventory_code']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            {{ $sp['product_inventory_code'] }}
                                        @endif
                                    </td>
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
                                        @if (empty($sp['product_mark']))
                                            <i class="fas fa-times text-danger"></i>
                                        @else
                                            {{ $sp['product_mark'] }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ priceFormat($sp['product_price']) }}</td>
                                    <td class="text-center">{{ $sp['product_amount'] }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-warning btn-sm py-0"
                                            data-toggle="tooltip" data-placement="right"
                                            title="{{ trans('ptventa::inventory.Tooltip1') }}"
                                            wire:click="editProduct({{ $index }})" wire:loading.attr="disabled"
                                            wire:target="editProduct">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm py-0"
                                            data-toggle="tooltip" data-placement="right"
                                            title="{{ trans('ptventa::inventory.Tooltip2') }}"
                                            wire:click="deleteProduct({{ $index }})"
                                            wire:loading.attr="disabled" wire:target="deleteProduct">
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

    <!-- Registro de baja -->
    <div class="d-flex justify-content-evenly">
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-danger form-control text-truncate" wire:click="registerLow" wire:loading.attr="disabled">
                    {{ trans('ptventa::inventory.Btn_Low') }} <i class="fa-solid fa-arrows-down-to-line"></i>
                </button>
            </div>
        </div>
    </div>

    @section('sripts-register-low')
        <!-- Scripts del plugin para imprimer en impresoras termicas -->
        <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
        <!-- Formateadores de datos -->
        <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
        <!-- Scripts del componente register-low -->
        <script src="{{ asset('modules/ptventa/js/inventory/low/livewire-register-low.js') }}"></script>
        <!-- Scripts para impresión en impresora pos termica -->
        <script src="{{ asset('modules/ptventa/js/pos_print/prints.js') }}"></script>
    @endsection

</div>
