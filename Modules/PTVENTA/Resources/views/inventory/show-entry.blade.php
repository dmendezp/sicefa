@extends('ptventa::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.index') }}"
            class="text-decoration-none">{{ trans('ptventa::inventory.Breadcrumb_Movement_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.Breadcrumb_Active_Movement_Inventory_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="ribbon-wrapper ribbon-xl">
                    <div class="ribbon bg-olive">
                        {{ trans('ptventa::inventory.Form_Title_Number_Voucher') }} {{ $movement->voucher_number }}
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Warehouse_Origin') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->warehouse_movements->where('role', 'Entrega')->first()->productive_unit_warehouse->warehouse->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Responsible_Delivery') }}</label>
                        <input type="text" class="form-control"
                            value="{{ $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name }}"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Date_Execution') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->registration_date }}" readonly>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Receiving_Warehouse') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->warehouse_movements->where('role', 'Recibe')->first()->productive_unit_warehouse->warehouse->name }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Responsible_Receiving') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_responsibilities->where('role', 'RECIBE')->first()->person->full_name }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Movement_Type') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_type->name }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.5T_Number') }}</th>
                                <th scope="col">{{ trans('ptventa::inventory.5T_Product') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.5T_Amount') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.5T_Subtotal') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.5T_Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movement->movement_details as $md)
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $md->inventory->element->product_name }}</td>
                                    <td class="text-center">{{ $md->amount }}</td>
                                    <td class="text-center fw-bold">{{ priceFormat($md->price) }}</td>
                                    <td class="text-center fw-bold">{{ priceFormat($md->price * $md->amount) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right fw-bold">{{ trans('ptventa::inventory.5T_Total:') }}</td>
                                <td class="text-center fw-bold">{{ priceFormat($movement->price) }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Observación:</th>
                                <td colspan="4">{{ $movement->observation }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-success" onclick="printTicket()" id="printButton">{{ trans('ptventa::inventory.Btn_Generate_Ticket') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('ptventa::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    <!-- Scripts del plugin para imprimer en impresoras termicas -->
    <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
    <!-- Scripts para impresión en impresora pos termica -->
    <script src="{{ asset('modules/ptventa/js/pos_print/prints.js') }}"></script>

    <script>
        async function printTicket() {
            const printButton = document.getElementById("printButton");
            try {
                printButton.disabled = true; // Deshabilita el botón antes de la acción asíncrona
                var movement = {!! $movement !!};
                respuesta = await print_entry_inventory(movement); // Imprimir factura de entrada de inventario
                if(respuesta){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Factura generada correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            } catch (error) {
                /* Lanzar notificación toastr */
                toastr.options.timeOut = 0;
                toastr.options.closeButton = true;
                toastr.error('Es posible que no este en ejecución el plugin_impresora_termica en el equipo.', 'Error de impresión');
            } finally {
                printButton.disabled = false; // Habilita el botón nuevamente después de la acción asíncrona
            }
        }
    </script>
@endpush
