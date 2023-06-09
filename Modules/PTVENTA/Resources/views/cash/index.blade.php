@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">{{ trans('ptventa::cash.Cash')}}</a>
        <li class="breadcrumb-item active">{{ trans('ptventa::cash.Cash Opening')}}</li>
    </li>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">{{ trans('ptventa::cash.Cash Opening')}}</h4>
                <hr>
                {!! Form::open(['route' => 'ptventa.cashCount.store', 'id' => 'arqueo-form', 'class' => 'form-row']) !!}
                    <!-- Campos del formulario -->
                    <div class="form-group col-md-4">
                        {{ Form::label('person_id', trans('ptventa::cash.Opening manager')) }}
                        {{ Form::text('person_id', Auth::user()->person->full_name, ['class' => 'form-control', 'disabled']) }}
                    </div>

                    <div class="form-group col-md-3">
                        {{ Form::label('date', trans('ptventa::cash.Opening date')) }}
                        {{ Form::datetimeLocal('date', null, ['class' => 'form-control', 'required', 'readonly']) }}
                    </div>

                    <div class="form-group col-md-3">
                        {{ Form::label('initial_balance', trans('ptventa::cash.Initial balance')) }}
                        {{ Form::number('initial_balance', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
                        <div class="form-text">{{ trans('ptventa::cash.*Use directly the keys on your keyboard')}}</div>
                    </div>

                    <div class="form-group col-md-2 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> {{ trans('ptventa::cash.Open cash')}}
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">{{ trans('ptventa::cash.Cash History')}}</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableCashCount">
                        <thead class="table-dark">
                            <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">{{ trans('ptventa::cash.Opening manager')}}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Opening date')}}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Initial balance')}}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Final balance')}}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Difference')}}</th>
                                    <th scope="col">{{ trans('ptventa::cash.Closing date')}}</th>
                                    <th scope="col">{{ trans('ptventa::cash.State')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashCounts as $cashCount)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $cashCount->person->full_name}}</td>
                                    <td>{{ $cashCount->opening_date }}</td>
                                    <td>{{ $cashCount->initial_balance }}</td>
                                    <td>{{ $cashCount->final_balance ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->difference ?: '0' }}</td>
                                    <td>{{ $cashCount->closing_date ?: 'N/A' }}</td>
                                    <td>{{ $cashCount->state }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')
@include('ptventa::layouts.partials.plugins.datatables')

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded',
        () => { // Agrega un evento que se activa cuando el contenido de la página se ha cargado completamente.
            const form = document.getElementById(
            'arqueo-form'); // Se obtiene el elemento del formulario con el ID "arqueo-form" y se almacena en la variable form.

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                Swal.fire({
                    title: '{{ trans('ptventa::cash.Start_a_new_cash?')}}',
                    text: '{{ trans('ptventa::cash.This_action_cannot_be_undone')}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ trans('ptventa::cash.Confirm')}}',
                    cancelButtonText: '{{ trans('ptventa::cash.Cancel')}}'
                }).then((
                result) => { //  Promesa (then) que se activa cuando el usuario hace clic en uno de los botones del cuadro de diálogo. Si el usuario confirma (isConfirmed), se envía el formulario llamando a form.submit().
                    if (result.isConfirmed) {
                        form.submit(); // Enviar el formulario si se confirma la acción
                    }
                });
            });
            
            @if (session('success'))
                Swal.fire(
                    '{{ trans('ptventa::cash.Successful_Operation')}}',
                    '{{ trans('ptventa::cash.You_have_started_a_new_cash!')}}',
                    'success'
                );
            @endif

            @if (session('error')) 
                Swal.fire(
                    '{{ trans('ptventa::cash.Operation_declined!')}}',
                    '{{ trans('ptventa::cash.An_open_cash_already_exists')}}',
                    'error'
                );
            @endif
        });
    </script>
    <script>
        $(document).ready(function () { /* Initialización of Datatables CashCount */
            $('#tableCashCount').DataTable({
            language: 
                language_datatables, // Agregar traducción a español
            });
        });
    </script>
    <script src="{{ asset('modules/ptventa/js/cash/index/dateTimeNow.js')}}"></script>
@endpush
