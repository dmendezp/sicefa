@extends('agroindustria::layouts.master')
@section('content')

@foreach ($formulations as $formulation)
<div class="container-card" style="display: flex; justify-content: center; align-items: center;">
    <div class="card" style="width: 500px;">
        @if(isset($formulation->element->image))
        <img src="{{ asset($formulation->element->image) }}" class="card-img-top" width="5px">
        @else
        <svg xmlns="http://www.w3.org/2000/svg" height="200" width="500" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M480 416v16c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48h16v208c0 44.1 35.9 80 80 80h336zm96-80V80c0-26.5-21.5-48-48-48H144c-26.5 0-48 21.5-48 48v256c0 26.5 21.5 48 48 48h384c26.5 0 48-21.5 48-48zM256 128c0 26.5-21.5 48-48 48s-48-21.5-48-48 21.5-48 48-48 48 21.5 48 48zm-96 144l55.5-55.5c4.7-4.7 12.3-4.7 17 0L272 256l135.5-135.5c4.7-4.7 12.3-4.7 17 0L512 208v112H160v-48z"/></svg>
        @endif
        <div class="card-body">
        <h5 class="card-title"><strong>{{ $formulation->element->name }}</strong></h5>
        <p><strong>{{trans('agroindustria::formulations.dateCreation')}}:</strong> {{ $formulation->date }}</p>
        <p class="card-text"><strong>{{trans('agroindustria::formulations.Owner')}}:</strong> {{ $formulation->person->first_name . ' ' . $formulation->person->first_last_name . ' ' . $formulation->person->second_last_name }}</p>
        <p class="card-text"><strong>{{trans('agroindustria::formulations.Productive Unit')}}:</strong> {{ $formulation->productive_unit->name }}</p>
        <p class="card-text"><strong>{{trans('agroindustria::formulations.Quantity produced')}}:</strong> {{ $formulation->amount }}</p>
        <p class="card-text"><strong>{{trans('agroindustria::formulations.Process')}}:</strong> {{ $formulation->proccess }}</p>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>{{trans('agroindustria::formulations.Ingredients')}}:</strong> 
            <ul>
                @foreach($formulation->ingredients as $ingredient)
                <li>{{$ingredient->element->name .' ' . $ingredient->amount / $ingredient->element->measurement_unit->conversion_factor. '' .  $ingredient->element->measurement_unit->abbreviation}}</li>
                @endforeach
            </ul>
        </li>
        <li class="list-group-item">
            <strong>{{trans('agroindustria::formulations.Utencils')}}:</strong>
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