



@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="card" style="width: 1100px">
        <table id="inventoryAlert" class="table table-striped" style="width: 98%;">
            <br>    
            <center><h4>Insumos pronto a agotarse</h4></center>
            <br>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>{{trans('agroindustria::menu.Name')}}</th>
                    <th>{{trans('agroindustria::menu.Category')}}</th>
                    <th>{{trans('agroindustria::menu.Amount stock')}}</th>
                    <th>Fecha expiración</th>
                    <th>Lote</th>
                    <th>{{trans('agroindustria::menu.Description')}}</th>
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






