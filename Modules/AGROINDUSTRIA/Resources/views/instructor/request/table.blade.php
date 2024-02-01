@extends('agroindustria::layouts.master')
@section('content')
    
<div class="table-request">
    <table id="request" class="hover" style="width: 90%">
        <thead>
            <tr>
                <th>{{trans('agroindustria::request.date')}}</th>
                <th>{{trans('agroindustria::request.coordinator')}}</th>
                <th>{{trans('agroindustria::request.receiver')}}</th>
                <th>{{trans('agroindustria::request.course')}}</th>
                <th>{{trans('agroindustria::request.status')}}</th>
                <th>
                    <a href="{{route('cefa.agroindustria.units.instructor.solicitud')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $r)           
            <tr>
                <td>{{$r->date}}</td>
                <td>{{$r->person->first_name . ' ' . $r->person->first_last_name . ' ' . $r->person->second_last_name}}</td>
                <td>{{$r->receive->first_name . ' ' . $r->receive->first_last_name . ' ' . $r->receive->second_last_name}}</td>
                <td>{{$r->course->program->name}}</td>
                <td>{{$r->status}}</td>
                <td>
                    @if ($r->status === 'Pendiente')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#anular{{$r->id}}">
                            {{trans('agroindustria::menu.Cancel')}}
                        </button>     
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal anular movimiento -->
@foreach ($requests as $r)
<div class="modal fade" id="anular{{$r->id}}" tabindex="-1" aria-labelledby="anularLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="anularLabel">{{trans('agroindustria::request.cancelRequest')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.units.instructor.requests.cancelled', ['id' => $r->id])]) !!}
            @csrf
            @method('PUT')
            <p>{{trans('agroindustria::request.doYouWantCancelThisRequest')}}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::menu.Cancel'),['class' => 'btn btn-danger', 'name' => 'anular']) !!}
          {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>
@endforeach



@section('script')
@endsection

@endsection