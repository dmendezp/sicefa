@extends('agroindustria::layouts.master')
@section('content')
<h3 id="bajas">{{trans('agroindustria::deliveries.desregistrations')}}</h3>
<div class="table_discharge">
    <table id="discharge" class="table table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::deliveries.dateTime')}}</th>
                <th>{{trans('agroindustria::deliveries.responsible')}}</th>
                <th>{{trans('agroindustria::deliveries.element')}}</th>
                <th>{{trans('agroindustria::deliveries.amount')}}</th>
                <th>{{trans('agroindustria::deliveries.price')}}</th>
                <th>{{trans('agroindustria::deliveries.totalMovement')}}</th>
                <th>{{trans('agroindustria::deliveries.observations')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
                <tr>
                    <td>{{$movement->registration_date}}</td>
                    <td>
                        {{$movement->movement_responsibilities->first()->person->first_name . ' ' .
                        $movement->movement_responsibilities->first()->person->first_last_name . ' ' .
                        $movement->movement_responsibilities->first()->person->second_last_name}}
                    </td>
                    <td>
                        @foreach ($movement->movement_details as $detail)
                            {{$detail->inventory->element->name}}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($movement->movement_details as $detail)
                            {{$detail->amount}}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($movement->movement_details as $detail)
                            {{$detail->price}}<br>
                        @endforeach
                    </td>
                    <td>{{$movement->price}}</td>
                    <td>{{$movement->observation}}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>

@endsection