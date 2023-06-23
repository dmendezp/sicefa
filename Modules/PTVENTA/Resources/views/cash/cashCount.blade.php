@extends('ptventa::layouts.master')

@push('head')
    <link href="{{asset('libs/AOS-2.3.1/dist/aos.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('modules/ptventa/css/custom_styles.css')}}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cashCount.index') }}" class="text-decoration-none">{{ trans('ptventa::cash.Cash') }}</a>
    <li class="breadcrumb-item active">{{ trans('ptventa::cash.Cash Control') }}</li>
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="zoom-in-down">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h4 class="text-center">{{ trans('ptventa::cash.Cash Closing') }}</h4>
                        <div class="mt-3">
                          @if(!Modules\PTVENTA\Entities\CashCount::where('state', 'Abierta')->exists())
                            {!! Form::open(['route' => 'ptventa.cashCount.store', 'class' => 'form-row']) !!}
                            <button type="submit" class="btn btn-success btn-block w-auto">
                              <i class="fas fa-check"></i> {{ trans('ptventa::cash.Open cash') }}
                            </button>
                            {!! Form::close() !!}
                          @endif
                        </div>
                      </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableCashCount">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">{{ trans('ptventa::cash.Opening manager') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Opening date') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Initial balance') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.State') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashCounts as $cashCount)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $cashCount->person->full_name }}</td>
                                        <td>{{ $cashCount->opening_date }}</td>
                                        <td>{{ priceFormat($cashCount->initial_balance) }}</td>
                                        <td>{{ $cashCount->state }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-cash-count-id="{{ $cashCount->id }}"
                                                data-initial-balance="{{ $cashCount->initial_balance }}"
                                                data-date="{{ $cashCount->opening_date }}">
                                                <i class="fas fa-store-slash"></i>
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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="zoom-in-up">
                <div class="card-body">
                    <h4 class="text-center">{{ trans('ptventa::cash.Cash History') }}</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableCashCountAll">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">{{ trans('ptventa::cash.Opening manager') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Opening date') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Initial balance') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Final balance') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Closing date') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.State') }}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Warehouse') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashCounts as $cashCount)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $cashCount->person->full_name }}</td>
                                        <td>{{ $cashCount->opening_date }}</td>
                                        <td>{{ priceFormat($cashCount->initial_balance) }}</td>
                                        <td>{{ $cashCount->final_balance !== null ? priceFormat($cashCount->final_balance) : 'N/A' }}</td>
                                        <td>{{ $cashCount->closing_date ?: 'N/A' }}</td>
                                        <td>{{ $cashCount->state }}</td>
                                        <td>{{ $cashCount->warehouse->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('ptventa::cash.Perform cash closing') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'ptventa.cashCount.close1', 'id' => 'cierre-caja-form', 'class' => 'form-row']) !!}
                    <!-- Campos del formulario -->
                    <div class="form-group col-md-4">
                        {{ Form::label('person_name', trans('ptventa::cash.Opening manager')) }}
                        {{ Form::text('person_name', Auth::user()->person->full_name, ['class' => 'form-control', 'disabled']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('opening_date', trans('ptventa::cash.Opening date')) }}
                        {{ Form::datetimeLocal('opening_date', null, ['class' => 'form-control', 'readonly']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('initial_balance', trans('ptventa::cash.Initial balance')) }}
                        {{ Form::text('initial_balance', null, ['class' => 'form-control', 'readonly']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('final_balance', trans('ptventa::cash.Final balance')) }}
                        {{ Form::number('final_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('sum_price', 'Total de venta actual:') }}
                        {{ Form::text('sum_price', priceFormat($sales->sum('price')), ['class' => 'form-control', 'disabled']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('date', trans('ptventa::cash.Closing date')) }}
                        {{ Form::datetimeLocal('date', null, ['class' => 'form-control', 'readonly']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('warehouse_name', trans('ptventa::cash.Warehouse')) }}
                        {{ Form::text('warehouse_name', $warehouse->name, ['class' => 'form-control', 'readonly']) }}
                    </div>

                    <div class="form-group mt-4 col-md-4 d-flex justify-content-end">
                        {{ Form::hidden('cash_count_id', null, ['id' => 'cash-count-id']) }}
                        <button type="submit" class="btn btn-danger btn-block">{{ trans('ptventa::cash.Close cash') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')
@include('ptventa::layouts.partials.plugins.datatables')

@push('scripts')
    <script src="{{asset('libs/AOS-2.3.1/dist/aos.js')}}"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // Permite la aplicacion de datatables y la vez la traduccion de las tablas
        $(document).ready(function() {
            /* Initialización of Datatables CashCount */
            $('#tableCashCount').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
            /* Initialización of Datatables CashCountAll */
            $('#tableCashCountAll').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
        });
    </script>
    <script>
        // Muestra los datos en el modal de cierre de caja
        var modal = new bootstrap.Modal(document.getElementById('exampleModal'), {});

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var cashCountId = button.data('cash-count-id');
            var initialBalance = button.data('initial-balance');
            var openingDate = button.data('date');

            modal._element.querySelector('#cash-count-id').value = cashCountId;
            modal._element.querySelector('#initial_balance').value = initialBalance;
            modal._element.querySelector('#opening_date').value = openingDate;
        });
    </script>
    <script>
        //Alertas de sweetalert que permiten la confirmacion de si desea cerrar la caja
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('cierre-caja-form');

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                Swal.fire({
                    title: '{{ trans('ptventa::cash.Are_you_sure_you_want_to_close_the_cash?') }}',
                    text: '{{ trans('ptventa::cash.When_closing_the_cash_a_new_one_will_be_started_with_the_next_days_date.') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ trans('ptventa::cash.Yes_close_cash') }}',
                    cancelButtonText: '{{ trans('ptventa::cash.Cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else {
                        Swal.fire(
                            '{{ trans('ptventa::cash.Operation_canceled') }}',
                            '{{ trans('ptventa::cash.The_cash_will_stay_open!') }}',
                            'info'
                        );
                    }
                });
            });

            // Verificar si hay mensajes de éxito o error desde el servidor
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire('{{ trans('ptventa::cash.Successful_Operation') }}', successMessage, 'success');
            }

            if (errorMessage) {
                Swal.fire('{{ trans('ptventa::cash.Operation_declined!') }}', errorMessage, 'error');
            }
        });
    </script>
    <script src="{{ asset('modules/ptventa/js/cash/index/dateTimeNow.js') }}"></script>
@endpush
