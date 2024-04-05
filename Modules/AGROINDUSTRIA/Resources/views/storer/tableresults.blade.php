@extends('agroindustria::layouts.master')
@section('content')

@if ($inventories->count() > 0)

<table id="inventory" class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>{{ trans('agroindustria::menu.Name') }}</th>
            <th>{{ trans('agroindustria::menu.Category') }}</th>
            <th>{{ trans('agroindustria::menu.Price') }}</th>
            <th>{{ trans('agroindustria::menu.Stock') }}</th>
            <th>{{ trans('agroindustria::menu.Expiration Date') }}</th>
            <th>{{ trans('agroindustria::menu.Description') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $inventory)
            <tr>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->element->name }}</td>
                <td>{{ $inventory->element->category->name }}</td>
                <td>{{ $inventory->price }}</td>
                <td>{{ $inventory->amount }}</td>
                <td>{{ $inventory->expiration_date }}</td>
                <td>{{ $inventory->description }}</td>


            </tr>
        @endforeach
    </tbody>
</table>


@else
    <p>No hay registros</p>   
@endif
@endsection