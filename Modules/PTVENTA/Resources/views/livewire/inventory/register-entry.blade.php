<div>

    <!-- Seleccionar y agregar producto -->
    <div class="row mx-3">
        <!-- Responsables y bodegas -->
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header text-center py-1">
                    <strong>Responsables y bodegas</strong>
                </div>
                <div class="card-body tex-center pt-0">
                    <label class="form-label my-0 mt-1">Entrega:</label>
                    <div class="row mb-1">
                        <div class="col-5 pe-1">
                            {!! Form::number(null, null, [
                                'class'=>'form-control form-control-sm',
                                'wire:model.defer'=>'delivery_document_number',
                                'wire:keydown.enter'=>'consultPersonDelivery',
                                'wire:loading.attr'=>'disabled',
                                'wire:target'=>'consultPersonDelivery'
                            ])!!}
                        </div>
                        <div class="col ps-1">
                            {!! Form::text(null, $delivery_person ? $delivery_person->document_type : '------------------', [
                                'class'=>'form-control form-control-sm',
                                'disabled'
                            ])!!}
                        </div>
                    </div>
                    {!! Form::text(null, $delivery_person ? $delivery_person->full_name : '------------------', [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                    <label class="form-label my-0">Bodega de origen:</label>
                    <select class="form-select form-select-sm" wire:model='delivery_warehouse_id'>
                        <option value="">-- Selecciona --</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                    <hr class="mb-1">
                    <label class="form-label my-0">Recibe:</label>
                    {!! Form::text(null, Auth::user()->person->full_name, [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                    <label class="form-label my-0">Bodega de destino:</label>
                    {!! Form::text(null, $warehouse->name, [
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
                            <label><strong class="text-danger">* </strong>Producto:</label>
                            <select class="form-select" name="product_element_id" wire:model="product_element_id" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Precio:</label>
                            {!! Form::text('product_price', $product_price, [
                                'class'=>'form-control text-center',
                                'wire:model.defer'=>'product_price',
                                'disabled'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label><strong class="text-danger">* </strong>Cantidad:</label>
                            {!! Form::number('product_amount', $product_amount, [
                                'class'=>'form-control text-center',
                                'wire:model.defer'=>'product_amount',
                                'required'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Fecha de Producción:</label>
                            {!! Form::date(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_production_date'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Fecha de Vencimiento:</label>
                            {!! Form::date(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_expiration_date'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Número de lote:</label>
                            {!! Form::number(null, null, [
                                'class'=>'form-control',
                                'wire:model.defer'=>'product_lot_number'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Código de Inventario:</label>
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
                                <label>Descripción:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Marca:</label>
                                    {!! Form::text(null, null, [
                                        'class'=>'form-control',
                                        'wire:model.defer'=>'product_mark'
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label><strong class="text-danger">* </strong>Destino:</label>
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
                            <button type="submit" class="btn btn-success form-control text-truncate">Agregar Producto <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Productos seleccionados -->
    <div class="row mx-3">
        <div class="card shadow-sm">
            <div class="col-md-12 h-100">
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Marca (Producto)</th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Código de Inventario">
                                    <i class="fas fa-barcode"></i>
                                </th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Descripción">
                                    <i class="far fa-file-alt"></i>
                                </th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Fecha Producción</th>
                                <th class="text-center">Fecha Vencimiento</th>
                                <th class="text-center">Núm Lote</th>
                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Acciones"><i class="fas fa-arrow-circle-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selected_products as $sp)
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
                                    <td class="text-center">{{ $sp['product_price'] }}</td>
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
                                        <button type="button" class="btn btn-outline-warning btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Editar producto">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Eliminar producto">
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
                <button type="button" class="btn btn-success form-control text-truncate">Registrar entrada <i class="fas fa-save"></i></button>
            </div>
        </div>
    </div>

    @section('sripts-register-entry')
        <!-- Scripts del componente register-entry -->
        <script src="{{ asset('modules/ptventa/js/inventory/entry/livewire-register-entry.js') }}"></script>
    @endsection

</div>
