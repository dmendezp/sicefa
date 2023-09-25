@extends('agroindustria::layouts.master')
@section('content')
    
<h1 class="title_labor">{{trans('agroindustria::labors.labors')}}</h1>

<div class="table-labors">
    <table id="labors" class="hover" style="width: 98%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::labors.activity')}}</th>
                <th>{{trans('agroindustria::labors.executionDate')}}</th>
                <th>{{trans('agroindustria::labors.state')}}</th>
                <th>{{trans('agroindustria::labors.destination')}}</th>
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
                <td>
                    @if ($l->status === 'Programado')
                        <form method="POST" action="{{ route('cefa.agroindustria.units.instructor.labor.cancelar', ['id' => $l->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                        </form>
                        
                        <form method="POST" action="{{ route('cefa.agroindustria.units.instructor.labor.realizar', ['id' => $l->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Realizar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('script')
@endsection

@endsection