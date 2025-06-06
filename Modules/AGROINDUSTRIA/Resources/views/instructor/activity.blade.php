@extends('agroindustria::layouts.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="card card-pink card-outline shadow col-md-10">
                <div class="card-header">
                    <h3 class="card-title">{{trans('agroindustria::menu.List of Activities')}}</h3>
                </div>
                <div class="card-body">
                    <table id="activities" class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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