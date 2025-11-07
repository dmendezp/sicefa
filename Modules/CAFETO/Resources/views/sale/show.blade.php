@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.movements.index') }}"
            class="text-decoration-none">{{ trans('cafeto::sales.Breadcrumb_Show_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::sales.Breadcrumb_Active_Show_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="ribbon-wrapper ribbon-xl">
                    <div class="ribbon bg-olive">
                        {{ trans('cafeto::sales.Form_Title_Voucher') }} {{ $movement->voucher_number }}
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-2">
                        <label class="form-label">{{ trans('cafeto::sales.Form_Title_Date') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->registration_date }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ trans('cafeto::sales.Form_Title_Customer') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_responsibilities->where('role', 'VENDEDOR')->first()->person->full_name }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('cafeto::sales.Form_Title_Client') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_responsibilities->where('role', 'CLIENTE')->first()->person->full_name }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('cafeto::sales.Form_Title_Movement_Type') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_type->name }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">{{ trans('cafeto::sales.3T_Number') }}</th>
                                <th scope="col">{{ trans('cafeto::sales.3T_Product') }}</th>
                                <th scope="col" class="text-center">{{ trans('cafeto::sales.3T_Amount') }}</th>
                                <th scope="col" class="text-center">{{ trans('cafeto::sales.3T_Subtotal') }}</th>
                                <th scope="col" class="text-center">{{ trans('cafeto::sales.3T_Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $processed_elements = [];
                                $iteration_group = 0;
                            @endphp
                            @foreach ($movement->movement_details as $md)
                                @php
                                    $element_id = $md->inventory->element_id;
                                @endphp
                                {{-- Comprobar si ya hemos procesado este elemento --}}
                                @if (!in_array($element_id, $processed_elements))
                                    {{-- Marcar el elemento como procesado --}}
                                    @php
                                        $processed_elements[] = $element_id;
                                        $iteration_group ++;
                                    @endphp
                                    {{-- Calcular la cantidad total para este elemento --}}
                                    @php
                                        $total_amount = 0;
                                        foreach ($movement->movement_details as $aux_md) {
                                            if ($aux_md->inventory->element_id === $element_id) {
                                                $total_amount += $aux_md->amount;
                                            }
                                        }
                                    @endphp
                                    {{-- Renderizar la fila para el elemento --}}
                                    <tr>
                                        <th scope="row" class="text-center">{{ $iteration_group }}</th>
                                        <td>{{ $md->inventory->element->product_name }}</td>
                                        <td class="text-center">{{ $total_amount }}</td>
                                        <td class="text-center">{{ priceFormat($md->price) }}</td>
                                        <td class="text-center fw-bold">{{ priceFormat($md->price * $total_amount) }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-center fw-bold">Total:</td>
                                <td class="text-center fw-bold">{{ priceFormat($movement->price) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-success" onclick="printTicket()" id="printButton">{{ trans('cafeto::sales.Btn_Generate_Ticket') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('cafeto::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    <!-- Scripts del plugin para imprimer en impresoras termicas -->
    <script src="{{ asset('modules/cafeto/js/sale/conector_javascript_POS80C.js') }}"></script>
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/cafeto/js/data-formats.js') }}"></script>
    <!-- Scripts para impresión en impresora pos termica -->
    <script src="{{ asset('modules/cafeto/js/pos_print/prints.js') }}"></script>

    <script>
        async function printTicket() {
            const printButton = document.getElementById("printButton");
            try {
                printButton.disabled = true; // Deshabilita el botón antes de la acción asíncrona
                var movement = {!! $movement !!};
                respuesta = await print_sale(movement); // Imprimir factura de venta realizada
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
