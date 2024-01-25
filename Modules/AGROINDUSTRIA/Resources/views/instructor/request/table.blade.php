@extends('agroindustria::layouts.master')
@section('content')
    
<div class="table-request" style="margin: 20px">
    <h1>Solicitudes de Bienes</h1>
    <table id="request" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>{{trans('agroindustria::request.date')}}</th>
                <th>Productos</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>
                    @if(auth()->check() && checkRol('agroindustria.instructor.vilmer') || auth()->check() && checkRol('agroindustria.instructor.chocolate'))  
                    <a href="{{route('cefa.agroindustria.instructor.units.solicitud')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    @else
                    <a href="{{route('cefa.agroindustria.units.instructor.request.excel.unified')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fas fa-file-excel"></i> Formato de Solicitud Unificado
                        </button>
                    </a>
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $m) 
                <tr>
                    <td>{{$m->registration_date}}</td>
                    <td>
                        @foreach ($m->movement_details as $detail)
                            {{$detail->inventory->element->name}}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($m->movement_details as $detail)
                            {{$detail->amount / $detail->inventory->element->measurement_unit->conversion_factor}}<br>
                        @endforeach
                    </td>
                    <td>{{$m->state}}</td>
                    <td>
                        <form method="GET" action="{{ route('cefa.agroindustria.units.instructor.request.excel', ['movementId' => $m->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-info" style="margin-bottom: 10px"><i class="fas fa-file-excel"></i> Formato de Solicitud</button>
                        </form>
                        @if(auth()->check() && checkRol('agroindustria.admin') && $m->state == 'Solicitado') 
                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approbed{{$m->id}}">Aprobar</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal anular movimiento -->
@foreach ($movements as $m)
<div class="modal fade" id="approbed{{$m->id}}" tabindex="-1" aria-labelledby="anularLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="anularLabel">Aprobar Solicitud</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
            <p>¿Todos los elementos de esta solicitud fueron recibidos?</p>
        </div>
        <div class="modal-footer">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.units.instructor.request.pending.state', ['id' => $m->id])]) !!}
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Si, aprobar</button>
            {!! Form:: close() !!}
            <button type="button" class="btn btn-secondary">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@section('script')
@endsection

@endsection