<table id="deliveries" class="hover" style="width: 98%;">
    <thead>
        <tr>
            <th>{{trans('agroindustria::menu.Date Time')}}</th>
            <th>{{trans('agroindustria::menu.Send')}}</th>
            <th>{{trans('agroindustria::menu.Receive')}}</th>
            <th>{{trans('agroindustria::menu.Element')}}</th>
            <th>{{trans('agroindustria::menu.Amount')}}</th>
            <th>{{trans('agroindustria::menu.Price')}}</th>
            <th>{{trans('agroindustria::menu.Total Movement')}}</th>
            <th>{{trans('agroindustria::menu.State')}}</th>
            <th>{{trans('agroindustria::menu.Observations')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movements as $movement)
            <tr>
                <td>{{$movement->registration_date}}</td>
                <td>
                    {{$movement->movement_responsibilities->first()->person->first_name . ' ' .
                    $movement->movement_responsibilities->first()->person->first_last_name . ' ' .
                    $movement->movement_responsibilities->first()->person->second_last_name}}
                </td>
                <td>
                    @foreach ($movement->movement_responsibilities as $responsibility)
                        @if ($responsibility->role === 'RECIBE')
                            {{ $responsibility->person->first_name . ' ' .
                            $responsibility->person->first_last_name . ' ' .
                            $responsibility->person->second_last_name }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($movement->movement_details as $detail)
                        {{$detail->inventory->element->name}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($movement->movement_details as $detail)
                        {{$detail->amount}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($movement->movement_details as $detail)
                        {{$detail->price}}<br>
                    @endforeach
                </td>
                <td>{{$movement->price}}</td>
                <td>{{$movement->state}}</td>
                <td>{{$movement->observation}}</td>
                <td>
                    @foreach ($movement->movement_responsibilities as $responsibility)
                        @if ($movement->state === 'Solicitado' & $responsibility->role === 'RECIBE')
                            @if ($responsibility->person_id === Auth::user()->person->id)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aprobar{{$movement->id}}">
                                {{trans('agroindustria::menu.Approve')}}
                            </button>  
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#devolver{{$movement->id}}">
                              {{trans('agroindustria::menu.Return')}}
                            </button>
                            @endif
                            @else
                              @if($movement->state === 'Solicitado' & $responsibility->role === 'ENTREGA')
                                @if ($responsibility->person_id === Auth::user()->person->id)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#anular{{$movement->id}}">
                                  {{trans('agroindustria::menu.Cancel')}}
                                    </button>                            
                                @endif
                              @endif
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
<!-- Modal Aprobar-->
@foreach ($movements as $movement)
<div class="modal fade" id="aprobar{{$movement->id}}" tabindex="-1" aria-labelledby="aprobarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="aprobarLabel">Aprobar Movimiento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('cefa.agroindustria.instructor.movements.pending.state', ['id' => $movement->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <p>Quieres aprobar este movimiento?</p>
                </div>                
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Aprobar</button>
        </form>
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
          <h1 class="modal-title fs-5" id="anularLabel">Anular Movimiento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.instructor.movements.cancelled', ['id' => $movement->id])]) !!}
            @csrf
            @method('PUT')
            <div class="form-group">
                {!! Form::label('observation', trans('agroindustria::menu.Observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea'] ) !!}
                @error('observation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::menu.Cancel'),['class' => 'btn btn-danger', 'name' => 'anular']) !!}
          {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Modal devolcer movimiento -->
@foreach ($movements as $movement)
<div class="modal fade" id="devolver{{$movement->id}}" tabindex="-1" aria-labelledby="devolverLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="devolverLabel">Anular Movimiento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.instructor.movements.return', ['id' => $movement->id])]) !!}
            @csrf
            @method('PUT')
            <div class="form-group">
                {!! Form::label('observation', trans('agroindustria::menu.Observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea'] ) !!}
                @error('observation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::menu.Return'),['class' => 'btn btn-danger', 'name' => 'anular']) !!}
          {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>
@endforeach


