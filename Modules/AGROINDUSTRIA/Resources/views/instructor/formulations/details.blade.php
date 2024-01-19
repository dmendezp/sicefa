@extends('agroindustria::layouts.master')
@section('content')
    
<div class="formulations-container">
    @foreach ($formulations as $formulation)
    <div class="formulationcard">
        <div class="formulationscard-header">
            <h2>{{ $formulation->element->name }}</h2>
        </div>
        <div class="formulations-card">
            <p><strong>Fecha de creción:</strong> {{ $formulation->date }}</p>
            <p><strong>Creador:</strong> {{ $formulation->person->first_name . ' ' . $formulation->person->first_last_name . ' ' . $formulation->person->second_last_name }}</p>
            <p><strong>{{trans('agroindustria::menu.Productive Unit')}}:</strong> {{ $formulation->productive_unit->name }}</p>
            <p><strong>{{trans('agroindustria::menu.Proccess')}}:</strong> {{ $formulation->proccess }}</p>
            <p><strong>{{trans('agroindustria::menu.Amount')}}:</strong> {{ $formulation->amount }}</p>
            
            <!-- Lista de ingredientes para esta formulación -->
            <p><strong>{{trans('agroindustria::menu.Ingredients')}}:</strong></p>
            <ul>
                @foreach ($formulation->ingredients as $ingredient)                 
                {{ $ingredient->amount . '' .  $ingredient->element->measurement_unit->abbreviation . ' ' . $ingredient->element->name }} 
                @endforeach
            </ul>
            <!-- Fin de la lista de ingredientes -->

            <!-- Lista de utensilios para esta formulación -->
            <p><strong>{{trans('agroindustria::menu.Utensils')}}:</strong></p>
            <ul>
                @foreach ($formulation->utensils as $utensil)
                {{ $utensil->amount . '' .  $utensil->element->measurement_unit->abbreviation . ' ' . $utensil->element->name }}
                @endforeach
            </ul>
            <!-- Fin de la lista de utensilios -->
        </div>
    </div>
    @endforeach
</div>


@section('script')
@endsection

@endsection