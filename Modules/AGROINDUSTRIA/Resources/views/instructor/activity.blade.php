@extends('agroindustria::layouts.master')
@section('content')
<center>
    @if ($activities->count() > 0)
        <h1>{{trans('agroindustria::menu.List of Activities')}}</h1>
        
    @else
        
        <p>No se encontraron actividades para esta unidad productiva</p>        
    @endif
</center>

<br>
<br> 

<div class="actividades-container">
        @foreach ($activities as $activity)
        
        <div class="card">
            <div class="activitiescard-header">
            <h2>{{ $activity->name }}</h2>
            </div>
        
            <div class="activities-card">
                <p><strong>Unidad Productiva:</strong> {{ $activity->productive_unit->name }}</p>
                <p><strong>Tipo de Actividad:</strong> {{ $activity->activity_type->name }}</p>
                <p><strong>Descripcion:</strong> {{ $activity->description }}</p>
                <p><strong>Recurrencia de Actividad:</strong> {{ $activity->period }}</p>
            </div>
            
            
            <div class="activities-footer text-body-secondary">
                <p>{{ $activity->status }}</p>
            </div>
        </div>
        @endforeach
    </div>

@endsection