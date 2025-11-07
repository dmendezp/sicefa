@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="card" style="width: 1100px">
        <table id="inventoryExp" class="table table-striped" style="width: 98%;">
            <br>    
            <center><h4>{{trans('agroindustria::inventory.suppliesSoonToExpire')}}</h4></center>
            <br>
            <thead>
                <tr>
                    <th>{{trans('agroindustria::inventory.product')}}</th>
                    <th>{{trans('agroindustria::inventory.category')}}</th>
                    <th>{{trans('agroindustria::inventory.unitMeasure')}}</th>
                    <th>{{trans('agroindustria::inventory.quantity')}}</th>
                    <th>{{trans('agroindustria::inventory.expirationDate')}}</th>
                    <th>{{trans('agroindustria::inventory.lot')}}</th>
                    <th>{{trans('agroindustria::inventory.state')}}</th>
                    @if(auth()->check() && (checkRol('agroindustria.admin')))  
                    <th>{{trans('agroindustria::inventory.actions')}}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($expirationdate as $item)
                    @if ($item['amount'] > 0) 
                        <tr>
                            <td>{{ $item['element_name'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td>{{ $item['measurement_unit'] }}</td>
                            <td>{{ $item['amount'] }}</td>
                            <td>{{ $item['expiration_date'] }}</td>
                            <td>{{ $item['lot_number'] }}</td>
                            <td>{{ $item['state'] }}</td>
                            @if(auth()->check() && (checkRol('agroindustria.admin')))  
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dischargeModal{{$item['inventory_id']}}">
                                    {{trans('agroindustria::inventory.discharge')}}
                                </button>
                                @include('agroindustria::storer.inventory.discharge')
                            </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</center>
@endsection
