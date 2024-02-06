



@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="card" style="width: 1100px">
        <table id="inventoryAlert" class="table table-striped" style="width: 98%;">
            <br>    
            <center><h4>{{trans('agroindustria::inventory.suppliesSoonToBeSoldOut')}}</h4></center>
            <br>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>{{trans('agroindustria::inventory.product')}}</th>
                    <th>{{trans('agroindustria::inventory.category')}}</th>
                    <th>{{trans('agroindustria::inventory.quantityAvailable')}}</th>
                    <th>{{trans('agroindustria::inventory.expirationDate')}}</th>
                    <th>{{trans('agroindustria::inventory.lot')}}</th>
                    <th>{{trans('agroindustria::inventory.description')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventoryAlert as $inventory)
                <tr>
                    <td>{{$inventory->id}}</td>
                    <td>{{$inventory->element->name}}</td>
                    <td>{{$inventory->element->category->name}}</td>
                    <td>{{$inventory->amount / $inventory->element->measurement_unit->conversion_factor}} ({{$inventory->element->measurement_unit->abbreviation}} )</td>
                    <td>{{$inventory->expiration_date}}</td>
                    <td>{{$inventory->lot_number}}</td>
                    <td>{{$inventory->description}}</td>
                    </tr>
                @endforeach
               
            </tbody>
          </table>
    </div>
</center>
@endsection






