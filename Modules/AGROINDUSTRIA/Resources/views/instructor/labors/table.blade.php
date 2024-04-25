@extends('agroindustria::layouts.master')
@section('content')
    
<h1 class="title_labor">{{trans('agroindustria::labors.labors')}}</h1>

<div class="table-labors">
    <table id="labors" class="table table-striped" style="width: 98%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::labors.activity')}}</th>
                <th>{{trans('agroindustria::labors.product')}}</th>
                <th>{{trans('agroindustria::labors.executionDate')}}</th>
                <th>{{trans('agroindustria::labors.state')}}</th>
                <th>{{trans('agroindustria::labors.destination')}}</th>
                <th>
                    @if (Auth::user()->havePermission('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.form'))
                        <a href="{{route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.form')}}">
                            <button class="btn btn-success float-end mb-2">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </a>
                    @endif         
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labors as $l)             
            <tr>
                <td>{{$l->activity->name}}</td>
                @if ($l->productions->isNotEmpty())
                <td>{{$l->productions->first()->element->name}}</td>
                @else
                    <td>No hay producción</td>
                @endif
                <td>{{$l->execution_date}}</td>
                <td>{{$l->status}}</td>
                <td>{{$l->destination}}</td>
                <td>
                    @if ($l->status === 'Programado')
                        <div class="mb-3">
                            <a href="{{route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.edit',  ['id' => $l->id])}}">
                                <button data-record-id="{{$l->id}}" class="btn btn-primary edit-button" style="width: 45px; height: 35px;">
                                    <i class="fa-solid fa-pen-to-square fa-sm"></i>
                                </button>
                            </a>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelar{{$l->id}}">{{trans('agroindustria::labors.cancel')}}</button>
                        </div>
                    @endif
                    @if ($l->status === 'Aprobado')
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#realizar{{$l->id}}">{{trans('agroindustria::labors.perform')}}</button>
                        </div>
                    @endif
                    <form method="GET" action="{{ route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.excel', ['laborId' => $l->id]) }}">
                        <div class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-info"><i class="fas fa-file-excel"></i> {{trans('agroindustria::labors.requestForm')}}</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal enviar a punto de venta -->
@foreach ($labors as $l)
<div class="modal fade" id="cancelar{{$l->id}}" tabindex="-1" aria-labelledby="cancelarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
          <h1 class="modal-title fs-5" id="cancelarLabel">{{trans('agroindustria::labors.cancelJob')}}</h1>      
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.cancel', ['id' => $l->id])]) !!}
            @csrf
            @method('POST')
            <div class="form-group">
               <p>{{trans('agroindustria::labors.areYouSureCancelThisJob')}}</p>
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::labors.yesCancel'),['class' => 'btn btn-success', 'name' => 'anular']) !!}
            {!! Form:: close() !!}
        </div>
      </div>
    </div>
</div>  
@if ($l->activity->activity_type->id == 1 && $l->destination == 'Producción')
    
<div class="modal fade" id="realizar{{$l->id}}" tabindex="-1" aria-labelledby="realizarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
          <h1 class="modal-title fs-5" id="realizarLabel">{{trans('agroindustria::labors.sendPointSale')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.do.movement', ['id' => $l->id])]) !!}
            @csrf
            @method('PUT')
            <div class="form-group">
               <p>{{trans('agroindustria::labors.doYouWantSend')}} {{$l->productions->first()->element->name}} {{trans('agroindustria::labors.toPointSale')}}</p>
            </div>
            <div class="date">
                {!! Form::label('date', trans('agroindustria::labors.date')) !!}
                {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['id' => 'readonly-bg-gray', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
            <div class="observations">
                {!! Form::label('observations', trans('agroindustria::labors.observations')) !!}
                {!! Form::textarea('observations', null, ['class'=>'form-control', 'id' => 'observations']) !!}
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::labors.send'),['class' => 'btn btn-success', 'name' => 'anular']) !!}
            {!! Form:: close() !!}
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.do', ['id' => $l->id])]) !!}
            {!! Form::submit(trans('agroindustria::labors.laterOn'),['class' => 'btn btn-info', 'name' => 'after']) !!}
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
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.do', ['id' => $l->id])]) !!}
            @csrf
            @method('POST')
            <div class="form-group">
               <p>¿Terminaste esta labor?</p>
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit('Sí, terminar',['class' => 'btn btn-success', 'name' => 'anular']) !!}
            {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>   
  @endif
@endforeach

@section('script')
@endsection

<script>
    const approveButtons = document.querySelectorAll('.cancel-btn');
    
    approveButtons.forEach(button => {
        button.addEventListener('click', function () {
            Swal.fire({
                title: '{{trans("agroindustria::request.areYouSure")}}',
                text: '{{trans("agroindustria::request.thisActionWillMarkRequestApproved")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{trans("agroindustria::request.yesApprove")}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cambiar el color de la fila al aprobar la solicitud
                    row.style.backgroundColor = 'green';
                    // Cambiar el estilo de la letra al aprobar la solicitud
                    row.style.color = 'white';
                    row.style.fontWeight = 'bold';
                    button.style.display = 'none';

                    // Almacenar la aprobación en localStorage

                    Swal.fire(
                        '{{trans("agroindustria::request.approved")}}',
                        '{{trans("agroindustria::request.theRequestBeenMarkedApproved")}}',
                        'success'
                    );

                }
                
            });
        });
    });
</script>

@endsection