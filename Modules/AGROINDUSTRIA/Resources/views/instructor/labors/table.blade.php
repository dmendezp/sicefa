@extends('agroindustria::layouts.master')
@section('content')
    
<h1>Labores</h1>

<div class="table-labors">
    <table id="labors" class="hover" style="width: 90%">
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Fecha de Ejecución</th>
                <th>Estado</th>
                <th>Destino</th>
                <th>
                    <a href="{{route('cefa.agroindustria.units.instructor.labor.form')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labors as $l)             
            <tr>
                <td>{{$l->activity->name}}</td>
                <td>{{$l->execution_date}}</td>
                <td>{{$l->status}}</td>
                <td>{{$l->destination}}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('script')
@endsection

@endsection