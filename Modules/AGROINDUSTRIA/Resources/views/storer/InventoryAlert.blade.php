



@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="card" style="width: 1100px">
        <table class="table table-striped-columns">
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
                    <td>{{$inventory->amount / $inventory->element->measurement_unit->conversion_factor}}</td>
                    <td>{{$inventory->expiration_date}}</td>
                    <td>{{$inventory->lot_number}}</td>
                    <td>{{$inventory->description}}</td>
                    </tr>
                @endforeach
               
            </tbody>
          </table>
    </div>
   
@endsection







{{-- @extends('agroindustria::layouts.master')
@section('content')
<table>
    <div class="container">
        <div class="card">
                <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventoryAlert as $inventory)
                            <tr>
                                <td>{{$inventory->id}}</td>
                                <td>{{$inventory->element->name}}</td>
                                <td>{{$inventory->description}}</td>
                                <td>{{$inventory->amount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</table>

@endsection --}}