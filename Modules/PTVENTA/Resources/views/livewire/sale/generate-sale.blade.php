<div>

    <!-- Seleccionar y agregar producto -->
    <div class="row mx-3">
        <div class="col-4">
            <div class="form-group">
                <label>{{ trans('ptventa::sales.Title_Product') }}</label>
                <select id='product_id' class="form-select" wire:model="product_id">
                    <option value="">{{ trans('ptventa::sales.Select_Product') }}</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->product_name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>{{ trans('ptventa::sales.Title_Stock') }}</label>
                {!! Form::text('product_total_amount', $product_total_amount, [
                    'class' => 'form-control text-center',
                    'disabled',
                ]) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>{{ trans('ptventa::sales.Title_Price') }}</label>
                {!! Form::text('product_price', $product_price, ['class' => 'form-control text-center', 'disabled']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>{{ trans('ptventa::sales.Title_Amount') }}</label>
                {!! Form::number('product_amount', null, [
                    'class' => 'form-control text-center',
                    'id' => 'product_amount',
                    'disabled',
                    'wire:model.defer' => 'product_amount',
                    'wire:keydown.enter' => 'addProduct',
                ]) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>{{ trans('ptventa::sales.Title_Subtotal') }}</label>
                {!! Form::text('product_subtotal', null, [
                    'class' => 'form-control text-center',
                    'id' => 'product_subtotal',
                    'disabled',
                    'wire:model' => 'product_subtotal',
                ]) !!}
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
                                    <th class="text-center">{{ trans('ptventa::sales.2T_Number') }}</th>
                                    <th>{{ trans('ptventa::sales.2T_Product') }}</th>
                                    <th class="text-center">{{ trans('ptventa::sales.2T_Amount') }}</th>
                                    <th class="text-center">{{ trans('ptventa::sales.2T_Value') }}</th>
                                    <th class="text-center">{{ trans('ptventa::sales.2T_Total') }}</th>
                                    <th class="text-center">{{ trans('ptventa::sales.2T_Actions') }}</th>
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
                                            <strong>{{ priceFormat($sp['product_subtotal']) }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip" data-placement="top" title="{{ trans('ptventa::sales.Tooltip1') }}" wire:click="editProduct({{ $sp['product_element_id'] }})">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip" data-placement="top" title="{{ trans('ptventa::sales.Tooltip2') }}" wire:click="deleteProduct({{ $sp['product_element_id'] }})">
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
                    <strong>{{ trans('ptventa::sales.Title_Sales_Data') }}</strong>
                </div>
                <div class="card-body py-1 pb-2">

                    <label class="form-label my-0 mt-1">{{ trans('ptventa::sales.Text_Identification') }}</label>
                    <div class="row">
                        <div class="col-5 pe-1">
                            {!! Form::number('document_number', $customer_document_number, [
                                'class' => 'form-control form-control-sm',
                                'wire:model.defer' => 'customer_document_number',
                                'wire:keydown.enter' => 'consultCustomer',
                                'wire:loading.attr' => 'disabled',
                                'wire:target' => 'consultCustomer',
                            ]) !!}
                        </div>
                        <div class="col ps-1">
                            {!! Form::text('document_type', $customer_document_type, [
                                'class' => 'form-control form-control-sm',
                                'disabled',
                            ]) !!}
                        </div>
                    </div>
                    <label class="form-label my-0">{{ trans('ptventa::sales.Text_Name') }}</label>
                    {!! Form::text('person_id', $customer_full_name, [
                        'class' => 'form-control form-control-sm',
                        'disabled',
                    ]) !!}
                    <hr>

                    <ul class="list-group list-group-flush text-center px-5 rounded-3 fs-5">
                        <li class="list-group-item list-group-item-primary py-0 px-0">
                            {!! Form::text('total', $total ? $total : '$0', [
                                'class' => 'form-control form-control-lg text-center mx-0',
                                'id' => 'total',
                                'style' => 'background-color: #d1e2ff',
                                'disabled',
                            ]) !!}
                        </li>
                        <li class="list-group-item py-1 px-0">
                            {!! Form::text('payment_value', $payment_value ? $payment_value : '$0', [
                                'class' => 'form-control form-control-lg text-center mx-0 price-format',
                                'id' => 'payment_value',
                                $input_payment_value ? '' : 'disabled',
                            ]) !!}
                        </li>
                        <li class="list-group-item list-group-item-dark py-0 px-0">
                            {!! Form::text('total', $change_value ? $change_value : '$0', [
                                'class' => 'form-control form-control-lg text-center mx-0 text-success fw-bold',
                                'id' => 'change_value',
                                'style' => 'background-color: #ced4da',
                                'disabled',
                            ]) !!}
                        </li>
                    </ul>

                    <div class="text-center mt-2">
                        @if (Auth::user()->havePermission('ptventa.admin-cashier.generate.sale'))
                            <button class="btn btn-sm btn-success" id="sale_button"
                                wire:click="registerSale($('#change_value').val())" wire:loading.attr="disabled"
                                wire:target="registerSale" disabled>
                                <i class="far fa-plus-square"></i>
                                {{ trans('ptventa::sales.Btn_Register_Sale') }}
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para registro rápido de cliente -->
    <div class="modal fade" id="registerCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="registerCustomerLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h1 class="modal-title fs-5" id="registerCustomerLabel">{{ trans('ptventa::sales.Title_Modal') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFormRegisterCustomer"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="registerCustomer">
                        <div class="alert alert-danger py-1" role="alert">
                            <strong style="font-size: 12px">{{ trans('ptventa::sales.Alert_Modal') }}</strong>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('ptventa::sales.Title_Modal_Identification') }}</label>
                            <div class="row">
                                <div class="col-6 pe-1">
                                    {{ Form::select('person_document_type', $document_types, $person_document_type, [
                                        'placeholder' => trans('ptventa::sales.Placeholder_Identification'),
                                        'class' => 'form-select form-select-sm',
                                        'wire:model.defer' => 'person_document_type',
                                    ]) }}
                                    @error('person_document_type')
                                        <span class="error text-danger" style="font-size: 10px">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 ps-1">
                                    {{ Form::number('person_document_number', $person_document_number, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => trans('ptventa::sales.Placeholder_Number_Identification'),
                                        'wire:model.defer' => 'person_document_number',
                                    ]) }}
                                    @error('person_document_number')
                                        <span class="error text-danger" style="font-size: 10px">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('ptventa::sales.Title_Modal_Name') }}</label>
                            {{ Form::text('person_first_name', $person_first_name, [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => trans('ptventa::sales.Placeholder_Name'),
                                'wire:model.defer' => 'person_first_name',
                            ]) }}
                            @error('person_first_name')
                                <span class="error text-danger" style="font-size: 10px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('ptventa::sales.Title_Modal_Last_Name') }}</label>
                            <div class="row">
                                <div class="col-6">
                                    {{ Form::text('person_first_last_name', $person_first_last_name, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => trans('ptventa::sales.Placeholder_First_Last_Name'),
                                        'wire:model.defer' => 'person_first_last_name',
                                    ]) }}
                                    @error('person_first_last_name')
                                        <span class="error text-danger"
                                            style="font-size: 10px">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    {{ Form::text('person_second_last_name', $person_second_last_name, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => trans('ptventa::sales.Placeholder_Second_Last_Name'),
                                        'wire:model.defer' => 'person_second_last_name',
                                    ]) }}
                                    @error('person_second_last_name')
                                        <span class="error text-danger"
                                            style="font-size: 10px">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="btn btn-sm btn-success py-0 float-end">{{ trans('ptventa::sales.Btn_Register_Client') }}</button>
                        <button type="button" class="btn btn-sm btn-secondary py-0 me-1 float-end"
                            data-bs-dismiss="modal"
                            wire:click="resetFormRegisterCustomer">{{ trans('ptventa::sales.Btn_Cancel_Register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('sripts-generate-sale')
        <!-- Scripts del plugin para imprimer en impresoras termicas -->
        <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
        <!-- Recursos para los formatedores de datos -->
        <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
        <!-- Formateadores de datos -->
        <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
        <!-- Scripts del componente register-sale -->
        <script src="{{ asset('modules/ptventa/js/sale/register/livewire-register-sale.js') }}"></script>
        <!-- Scripts para impresión en impresora pos termica -->
        <script src="{{ asset('modules/ptventa/js/pos_print/prints.js') }}"></script>
        <!-- Scripts del de la internacionalizacion del alert que confirma la venta -->
        <script>
            window.translations = @json([
                'alertChangeOf' => __('ptventa::sales.Alert_Change_Of'),
                'btnAccept' => __('ptventa::sales.Btn_Accept'),
            ]);
        </script>
    @endsection
</div>
