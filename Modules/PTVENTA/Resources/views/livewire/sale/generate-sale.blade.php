<div>

    <!-- Seleccionar y agregar producto -->
    <div class="row mx-3">
        <div class="col-4">
            <div class="form-group">
                <label>Producto:</label>
                <select id='product_id' class="form-select" wire:model="product_id">
                    <option value="">-- Seleccionar producto --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Existencias:</label>
                {!! Form::text('product_total_amount', $product_total_amount, ['class'=>'form-control text-center', 'disabled']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Precio:</label>
                {!! Form::text('product_price', $product_price, ['class'=>'form-control text-center', 'disabled']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Cantidad:</label>
                {!! Form::number('product_amount', null, ['class'=>'form-control text-center', 'id'=>'product_amount', 'disabled',
                    'wire:model.defer'=>'product_amount', 'wire:keydown.enter'=>'addProduct']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Subtotal:</label>
                {!! Form::text('product_subtotal', null, ['class'=>'form-control text-center', 'id'=>'product_subtotal', 'disabled',
                    'wire:model'=>'product_subtotal']) !!}
            </div>
        </div>
    </div>

    <!-- Productos seleccionados -->
    <div class="row mx-3">
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 500px">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selected_products as $sp)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $sp['product_name'] }}</td>
                                        <td class="text-center">
                                            <strong>{{ $sp['product_amount'] }}</strong>
                                        </td>
                                        <td class="text-center">{{ $sp['product_price'] }}</td>
                                        <td class="text-center">
                                            <strong>{{ $sp['product_subtotal'] }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip" data-placement="top" title="Actualizar producto"
                                                    wire:click="editProduct({{ $sp['product_element_id'] }})">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip" data-placement="top" title="Eliminar producto"
                                                    wire:click="deleteProduct({{ $sp['product_element_id'] }})">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Datos de la venta -->
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header text-center">
                    <strong>Venta</strong>
                </div>
                <div class="card-body tex-center py-1 pb-2">

                    <label class="form-label my-0 mt-1">Identificación:</label>
                    <div class="row">
                        <div class="col-5 pe-1">
                            {!! Form::number('document_number', $customer_document_number, [
                                'class'=>'form-control form-control-sm',
                                'wire:model.defer' => 'customer_document_number',
                                'wire:keydown.enter' => 'consultCustomer',
                                'wire:loading.attr' => 'disabled',
                                'wire:target' => 'consultCustomer'])
                            !!}
                        </div>
                        <div class="col ps-1">
                            {!! Form::text('document_type', $customer_document_type, [
                                'class'=>'form-control form-control-sm',
                                'disabled'])
                            !!}
                        </div>
                    </div>
                    <label class="form-label my-0">Nombre:</label>
                    {!! Form::text('person_id', $customer_full_name, [
                        'class'=>'form-control form-control-sm',
                        'disabled'])
                    !!}
                    <hr>

                    <ul class="list-group list-group-flush text-center px-5 rounded-3 fs-5">
                        <li class="list-group-item list-group-item-primary py-0 px-0">
                            {!! Form::number('total', $total ? $total : 0, [
                                'class'=>'form-control form-control-lg text-center mx-0',
                                'id'=>'total',
                                'style' => 'background-color: #d1e2ff',
                                'disabled'])
                            !!}
                        </li>
                        <li class="list-group-item py-1 px-0">
                            {!! Form::number('payment_value', $payment_value ? $payment_value : 0, [
                                'class'=>'form-control form-control-lg text-center mx-0',
                                'id'=>'payment_value',
                                $input_payment_value ? '' : 'disabled'])
                            !!}
                        </li>
                        <li class="list-group-item list-group-item-dark py-0 px-0">
                            {!! Form::number('total', $change_value ? $change_value : 0, [
                                'class'=>'form-control form-control-lg text-center mx-0 text-success fw-bold',
                                'id'=>'change_value',
                                'style' => 'background-color: #ced4da',
                                'disabled'])
                            !!}
                        </li>
                    </ul>

                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-success" id="sale_button" wire:click="registerSale($('#change_value').val())" wire:loading.attr="disabled" wire:target="registerSale" disabled>
                            <i class="far fa-plus-square"></i>
                            Registrar Venta
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para registro rápido de cliente -->
    <div class="modal fade" id="registerCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerCustomerLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h1 class="modal-title fs-5" id="registerCustomerLabel">Registro de cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetFormRegisterCustomer"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="registerCustomer">
                        <div class="alert alert-danger py-1" role="alert">
                            <strong style="font-size: 12px">La persona consultada no se encuentra registrado.</strong>
                        </div>
                        <div class="form-group">
                            <label>Identificación</label>
                            <div class="row">
                                <div class="col-6 pe-1">
                                    {{ Form::select('person_document_type', $document_types, $person_document_type, [
                                        'placeholder' => '-- Seleccionar --',
                                        'class' => 'form-select form-select-sm',
                                        'wire:model.defer' => 'person_document_type'])
                                    }}
                                    @error('person_document_type') <span class="error text-danger" style="font-size: 10px">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-6 ps-1">
                                    {{ Form::number('person_document_number', $person_document_number, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Número',
                                        'wire:model.defer' => 'person_document_number'])
                                    }}
                                    @error('person_document_number') <span class="error text-danger" style="font-size: 10px">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nombres</label>
                            {{ Form::text('person_first_name', $person_first_name, [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => 'Primer y segundo nombre',
                                'wire:model.defer' => 'person_first_name'])
                            }}
                            @error('person_first_name') <span class="error text-danger" style="font-size: 10px">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <div class="row">
                                <div class="col-6">
                                    {{ Form::text('person_first_last_name', $person_first_last_name, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Primer apellido',
                                        'wire:model.defer' => 'person_first_last_name'])
                                    }}
                                    @error('person_first_last_name') <span class="error text-danger" style="font-size: 10px">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-6">
                                    {{ Form::text('person_second_last_name', $person_second_last_name, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Segundo apellido',
                                        'wire:model.defer' => 'person_second_last_name'])
                                    }}
                                    @error('person_second_last_name') <span class="error text-danger" style="font-size: 10px">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success py-0 float-end">Registrar</button>
                        <button type="button" class="btn btn-sm btn-secondary py-0 me-1 float-end" data-bs-dismiss="modal" wire:click="resetFormRegisterCustomer">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('sripts-generate-sale')
        <!-- Scripts del componente register-sale -->
        <script src="{{ asset('modules/ptventa/js/sale/register/livewire-register-sale.js') }}"></script>
    @endsection
</div>
