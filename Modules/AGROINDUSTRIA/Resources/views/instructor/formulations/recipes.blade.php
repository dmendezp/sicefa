@extends('agroindustria::layouts.master')
@section('content')

<center>
<h1>{{trans('agroindustria::menu.List of Products')}}</h1>
</center>



<div class="formulations-container">
    @foreach ($formulations as $formulation)
    <div class="formulationcard">
        <div class="formulationscard-header">
            <h2>{{ $formulation->element->name }}</h2>
        </div>
        <div class="formulations-card">
            <p><strong>{{trans('agroindustria::menu.Productive Unit')}}:</strong> {{ $formulation->productive_unit->name }}</p>
            <p><strong>{{trans('agroindustria::menu.Proccess')}}:</strong> {{ $formulation->proccess }}</p>
            <p><strong>{{trans('agroindustria::menu.Amount')}}:</strong> {{ $formulation->amount }}</p>
            
            <!-- Lista de ingredientes para esta formulación -->
            <p><strong>{{trans('agroindustria::menu.Ingredients')}}:</strong></p>
            <ul>
                @foreach ($ingredients as $ingredient)
                    @if ($ingredient->formulation_id === $formulation->id)
                    <li>{{ $ingredient->element->name }}</li>
                    @endif
                @endforeach
            </ul>
            <!-- Fin de la lista de ingredientes -->

            <!-- Lista de utensilios para esta formulación -->
            <p><strong>{{trans('agroindustria::menu.Utensils')}}:</strong></p>
            <ul>
                @foreach ($utensils as $utensil)
                    @if ($utensil->formulation_id === $formulation->id)
                    <li>{{ $utensil->element->name }}</li>
                    @endif
                @endforeach
            </ul>
            <!-- Fin de la lista de utensilios -->
        </div>
    </div>
    @endforeach
</div>








@endsection