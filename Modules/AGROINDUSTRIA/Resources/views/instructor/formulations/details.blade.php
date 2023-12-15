@extends('agroindustria::layouts.master')
@section('content')

@foreach ($formulations as $formulation)
<div class="container-card" style="display: flex; justify-content: center; align-items: center;">
    <div class="card" style="width: 500px;">
        @if(isset($formulation->element->image))
        <img src="{{ asset($formulation->element->image) }}" class="card-img-top" width="5px">
        @else
        <img src="{{ asset('modules/agroindustria/img/blanco.png') }}" class="card-img-top" width="5px">
        @endif
        <div class="card-body">
        <h5 class="card-title">{{ $formulation->element->name }}</h5>
        <p><strong>Fecha de creción:</strong> {{ $formulation->date }}</p>
                <p class="card-text"><strong>Creador:</strong> {{ $formulation->person->first_name . ' ' . $formulation->person->first_last_name . ' ' . $formulation->person->second_last_name }}</p>
                <p class="card-text"><strong>{{trans('agroindustria::menu.Productive Unit')}}:</strong> {{ $formulation->productive_unit->name }}</p>
                <p class="card-text"><strong>Cantidad que se produce:</strong> {{ $formulation->amount }}</p>
                <p class="card-text"><strong>{{trans('agroindustria::menu.Proccess')}}:</strong> {{ $formulation->proccess }}</p>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>Ingredientes:</strong> 
            <ul>
                @foreach($formulation->ingredients as $ingredient)
                <li>{{$ingredient->element->name .' ' . $ingredient->amount . '' .  $ingredient->element->measurement_unit->abbreviation}}</li>
                @endforeach
            </ul>
        </li>
        <li class="list-group-item">
            <strong>Utencilios:</strong>
            <ul>
                @foreach($formulation->utensils as $utensil)
                <li>{{$utensil->element->name .' ' . $utensil->amount . '' .  $utensil->element->measurement_unit->abbreviation}}</li>
                @endforeach
            </ul>
        </li>
        </ul>
    </div>
</div>
@endforeach


@section('script')
@endsection

@endsection