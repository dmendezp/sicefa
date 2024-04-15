@extends('agrocefa::layouts.master')

@section('content')

<div class="container" id="containermovements">
    <h2>{{ trans('agrocefa::movements.MovementHistory')}}</h2>
    @if (count($datas) > 0)
    <div class="container my-5">
        <div class="row" style="width: auto">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="col-3">{{ trans('agrocefa::movements.2T_Date')}}</th>
                                    <th class="col-2">{{ trans('agrocefa::movements.2T_Responsibility')}}</th>
                                    <th style="width: 40%">{{ trans('agrocefa::movements.2T_Elements')}}</th>
                                    <th>{{ trans('agrocefa::movements.2T_Amount')}}</th>
                                    <th>{{ trans('agrocefa::movements.2T_Price')}}</th>
                                    <th class="col-5">{{ trans('agrocefa::movements.MovementType')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $currentId = null; @endphp
                                @foreach ($datas as $data)
                                    @if ($currentId !== $data['id'])
                                        {{-- Iniciar una nueva fila para un nuevo movimiento --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['date'] }}</td>
                                            <td>{{ $data['respnsibility'] }}</td>
                                            <td>
                                                {{-- Crear una columna para los elementos --}}
                                                @foreach ($datas as $innerData)
                                                    @if ($innerData['id'] === $data['id'])
                                                        {{ $innerData['inventory'] }}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{-- Crear una columna para las cantidades --}}
                                                @foreach ($datas as $innerData)
                                                    @if ($innerData['id'] === $data['id'])
                                                        {{ $innerData['amount'] }}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>${{ number_format($data['pricetotal'], 0, ',', '.') }}</td>
                                            <td>{{ $data['movement_type'] }}</td>
                                            
                                                {!! Form::open(['route' => ['agrocefa.movements.confirmation', $data['id']], 'method' => 'POST']) !!}
                                                @csrf
                                                {!! Form::hidden('person_id', $data['person_id']) !!}
                                                {!! Form::hidden('element_id', $data['element_id']) !!}
                                                {!! Form::hidden('destination', $data['destination']) !!}
                                                {!! Form::hidden('amount', $data['amount']) !!}
                                                {!! Form::hidden('price', $data['price']) !!}
                                                {!! Form::hidden('lot', $data['lot']) !!}
                                                {!! Form::close() !!}
                                        
                                        </tr>
                                        @php $currentId = $data['id']; @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
        <p>No hay movimientos.</p>
@endif
@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endsection
