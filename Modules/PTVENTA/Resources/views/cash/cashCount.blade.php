@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Cierre de Caja</li>
    </li>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Cierre de Caja</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableCashCount">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Encargado</th>
                                <th scope="col">Fecha de apertura</th>
                                <th scope="col">Saldo Inicial</th>
                                <th scope="col">Saldo Final</th>
                                <th scope="col">Diferencia</th>
                                <th scope="col">Hora de cierre</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Cierre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashCounts as $cashCount)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $cashCount->person->full_name }}</td>
                                    <td>{{ $cashCount->opening_date }}</td>
                                    <td>{{ $cashCount->initial_balance }}</td>
                                    <td>{{ $cashCount->final_balance ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->final_balance ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->closing_time ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->state }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-cash-count-id="{{ $cashCount->id }}"
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Realizar corte de caja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'ptventa.cashCount.close1', 'id' => 'cierre-caja-form', 'class' => 'form-row']) !!}
                    <!-- Campos del formulario -->
                    <div class="form-group col-md-4">
                        {{ Form::label('person_name', 'Encargado de apertura:') }}
                        {{ Form::text('person_name', Auth::user()->person->full_name, ['class' => 'form-control', 'disabled']) }}
                    </div>
                
                    <div class="form-group col-md-4">
                        {{ Form::label('opening_date', 'Fecha de Apertura') }}
                        {{ Form::datetimeLocal('opening_date', null, ['class' => 'form-control', 'readonly']) }}
                    </div>
                
                    <div class="form-group col-md-4">
                        {{ Form::label('initial_balance', 'Saldo Inicial') }}
                        {{ Form::text('initial_balance', null, ['class' => 'form-control', 'readonly']) }}
                    </div>
                
                    <div class="form-group col-md-4">
                        {{ Form::label('final_balance', 'Saldo Final') }}
                        {{ Form::number('final_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
                    </div>
                
                    <div class="form-group col-md-4">
                        {{ Form::label('date', 'Hora de Cierre') }}
                        {{ Form::datetimeLocal('date', null, ['class' => 'form-control', 'readonly']) }}
                    </div>
                
                    <div class="form-group mt-4 col-md-4 d-flex align-items-center justify-content-end">
                        {{ Form::hidden('cash_count_id', null, ['id' => 'cash-count-id']) }}
                        <button type="submit" class="btn btn-danger btn-block">Cerrar Caja</button>
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
    <script>
        $(document).ready(function() {
            /* Initialización of Datatables CashCount */
            $('#tableCashCount').DataTable({
                // opciones de configuración para la tabla 1
            });
        });
    </script>
    <script>
        var modal = new bootstrap.Modal(document.getElementById('exampleModal'), {});

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var cashCountId = button.data('cash-count-id');
            var initialBalance = button.data('initial-balance');
            var openingDate = button.data('date');

            modal._element.querySelector('#cash-count-id').value = cashCountId;
            modal._element.querySelector('#initial_balance').value = initialBalance;
            modal._element.querySelector('#opening_date').value = openingDate;
        });
    </script>

    <script src="{{ asset('modules/ptventa/js/cash/index/dateTimeNow.js')}}"></script>  
@endpush
