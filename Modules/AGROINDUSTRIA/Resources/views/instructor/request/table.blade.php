@extends('agroindustria::layouts.master')
@section('content')
    
<div class="table-request" style="margin: 20px">
    <h1>{{trans('agroindustria::request.requestsAssets')}}</h1>
    <table id="request" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>{{trans('agroindustria::request.date')}}</th>
                <th>{{trans('agroindustria::request.products')}}</th>
                <th>{{trans('agroindustria::request.quantity')}}</th>
                <th>{{trans('agroindustria::request.state')}}</th>
                <th>
                    @if(auth()->check() && checkRol('agroindustria.instructor.vilmer') || auth()->check() && checkRol('agroindustria.instructor.chocolate') || auth()->check() && checkRol('agroindustria.instructor.cerveceria'))  
                    <a href="{{route('agroindustria.instructor.units.request.form')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    @else
                    <a href="{{route('agroindustria.admin.units.request.excel.unified')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fas fa-file-excel"></i> {{trans('agroindustria::request.unifiedRequestForm')}}
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
                        <form method="GET" action="{{ route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.request.excel', ['movementId' => $m->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-info" style="margin-bottom: 10px"><i class="fas fa-file-excel"></i> {{trans('agroindustria::request.requestForm')}}</button>
                        </form>
                        @if(auth()->check() && checkRol('agroindustria.admin') && $m->state == 'Solicitado') 
                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approbed{{$m->id}}">{{trans('agroindustria::request.approve')}}</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#anular{{$m->id}}">
                              <i class="fas fa-ban"></i> {{trans('agroindustria::deliveries.Cancel')}}
                            </button>       
                        @endif
                        @if(auth()->check() && (checkRol('agroindustria.instructor.vilmer') || checkRol('agroindustria.instructor.chocolate') || checkRol('agroindustria.instructor.cerveceria')) && $m->state == 'Solicitado') 
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#anular{{$m->id}}">
                                <i class="fas fa-ban"></i> {{trans('agroindustria::deliveries.Cancel')}}
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal aprobar movimiento -->
@foreach ($movements as $m)
<div class="modal fade" id="approbed{{$m->id}}" tabindex="-1" aria-labelledby="anularLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="anularLabel">{{trans('agroindustria::request.approveRequest')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
            <p>{{trans('agroindustria::request.haveElementsApplicationReceived')}}</p>
        </div>
        <div class="modal-footer">
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.admin.units.request.pending.state', ['id' => $m->id])]) !!}
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">{{trans('agroindustria::request.yesApprove')}}</button>
            {!! Form:: close() !!}
            <button type="button" class="btn btn-secondary">{{trans('agroindustria::request.cancel')}}</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

   <!-- Modal anular movimiento -->
   @foreach ($movements as $movement)
   <div class="modal fade" id="anular{{$movement->id}}" tabindex="-1" aria-labelledby="anularLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h1 class="modal-title fs-5" id="anularLabel">Cancelar solicitud</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               {!! Form::open(['method' => 'post', 'url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.request.pending.cancelled', ['id' => $movement->id])]) !!}
               @csrf
               @method('PUT')
               <div class="form-group">
                   {!! Form::label('observation', trans('agroindustria::deliveries.Observations')) !!}
                   {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea', 'style' => 'height: 0px'] ) !!}
                   @error('observation')
                       <span class="text-danger">{{ $message }}</span>
                   @enderror
               </div>         
           </div>
           <div class="modal-footer">
               {!! Form::submit(trans('agroindustria::deliveries.yesCancel'), ['class' => 'btn btn-success', 'name' => 'anular']) !!}
             {!! Form:: close() !!}
           </div>
         </div>
       </div>
     </div>
   @endforeach
 

@section('script')
@endsection

@endsection