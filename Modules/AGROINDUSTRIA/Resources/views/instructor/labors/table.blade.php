@extends('agroindustria::layouts.master')
@section('content')
    
<h1 class="title_labor">{{trans('agroindustria::labors.labors')}}</h1>

<div class="table-labors">
    <table id="labors" class="table table-striped" style="width: 98%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::labors.activity')}}</th>
                <th>{{trans('agroindustria::labors.executionDate')}}</th>
                <th>{{trans('agroindustria::labors.state')}}</th>
                <th>{{trans('agroindustria::labors.destination')}}</th>
                <th>
                    @if (Auth::user()->havePermission('agroindustria.admin.labor.units.form'))
                        <a href="{{route('agroindustria.admin.labor.units.form')}}">
                            <button class="btn btn-success float-end mb-2">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </a>
                    @else
                        @if (Auth::user()->havePermission('agroindustria.instructor.units.form'))
                            <a href="{{route('agroindustria.instructor.units.form')}}">
                                <button class="btn btn-success float-end mb-2">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                        @endif
                    @endif         
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
                        <br>
                        @csrf
                        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#realizar{{$l->id}}">Realizar</button>
                        @endif
                        <form method="GET" action="{{ route('cefa.agroindustria.units.instructor.labor.excel', ['laborId' => $l->id]) }}">
                            @csrf
                            <br>
                            <button type="submit" class="btn btn-info"><i class="fas fa-file-excel"></i> Solicitud de Bienes</button>
                        </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal enviar a punto de venta -->
@foreach ($labors as $l)
@if ($l->activity->activity_type->id == 1)
    
<div class="modal fade" id="realizar{{$l->id}}" tabindex="-1" aria-labelledby="realizarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
          <h1 class="modal-title fs-5" id="realizarLabel">Enviar a Punto de Venta</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.units.instructor.labor.realizar.movement', ['id' => $l->id])]) !!}
            @csrf
            @method('PUT')
            <div class="form-group">
               <p>¿Deseas enviar {{$l->productions->first()->element->name}} a Punto de Venta?</p>
            </div>
            <div class="date">
                {!! Form::label('date', 'Fecha') !!}
                {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['id' => 'readonly-bg-gray', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
            <div class="observations">
                {!! Form::label('observations', trans('agroindustria::labors.observations')) !!}
                {!! Form::textarea('observations', null, ['class'=>'form-control', 'id' => 'observations']) !!}
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit('Enviar',['class' => 'btn btn-success', 'name' => 'anular']) !!}
            {!! Form:: close() !!}
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.units.instructor.labor.realizar', ['id' => $l->id])]) !!}
            {!! Form::submit('Mas tarde',['class' => 'btn btn-info', 'name' => 'after']) !!}
            {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>   
  @else
  <div class="modal fade" id="realizar{{$l->id}}" tabindex="-1" aria-labelledby="realizarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
          <h1 class="modal-title fs-5" id="realizarLabel">Terminar labor</h1>      
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.units.instructor.labor.realizar', ['id' => $l->id])]) !!}
            @csrf
            @method('POST')
            <div class="form-group">
               <p>¿Terminaste esta labor?</p>
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit('Enviar',['class' => 'btn btn-success', 'name' => 'anular']) !!}
            {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>   


  @endif
@endforeach
@section('script')
@endsection

@endsection