@extends('agroindustria::layouts.master')
@section('content')

<div class="request" style="margin: 40px">
    <h1>{{trans('agroindustria::request.requestInstructor')}}</h1>
    <table id="request" class="hover" style="width: 100%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::request.date')}}</th>
                <th>Unidad Productiva</th>
                <th>{{trans('agroindustria::request.element')}}</th>
                <th>{{trans('agroindustria::request.amount')}}</th>
                <th>{{trans('agroindustria::request.applicant')}}</th>
                <th>{{trans('agroindustria::request.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $r)
            <tr data-created-at="{{$r->created_at}}">
                <td>{{$r->planning_date}}</td>
                <td>{{$r->activity->productive_unit->name}}</td>
                <td> 
                    @foreach($r->consumables as $c)
                    {{$c->inventory->element->name}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach ($r->consumables as $c)
                        {{$c->amount / $c->inventory->element->measurement_unit->conversion_factor . ' (' . $c->inventory->element->measurement_unit->abbreviation . ')'}} <br>
                    @endforeach
                </td>
                <td>{{$r->person->first_name . ' ' . $r->person->first_last_name . ' ' . $r->person->second_last_name}}</td>
                <td>
                    <button class="btn btn-success approve-btn" data-request-id="{{$r->id}}">{{trans('agroindustria::request.approve')}}</button>
                    <button type="submit" class="btn btn-danger cancel-btn" data-bs-toggle="modal" data-bs-target="#cancelar{{$r->id}}">Rechazar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal anular movimiento -->
@foreach ($requests as $r)
<div class="modal fade" id="cancelar{{$r->id}}" tabindex="-1" aria-labelledby="cancelarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="cancelarLabel">Rechazar solicitud</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.storer.units.request.cancelled', ['id' => $r->id])]) !!}
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
            {!! Form::submit('Si, rechazar',['class' => 'btn btn-success', 'name' => 'anular']) !!}
          {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('#request tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    rows.sort((a, b) => {
        const statusA = a.style.backgroundColor === 'green' ? 1 : 0;
        const statusB = b.style.backgroundColor === 'green' ? 1 : 0;

        // Ordenar primero las no aprobadas y luego las aprobadas
        if (statusA !== statusB) {
            return statusB - statusA;
        }

        // Si ambas son aprobadas o no aprobadas, ordenar por fecha de creación
        const dateA = new Date(a.dataset.createdAt);
        const dateB = new Date(b.dataset.createdAt);

        return dateB - dateA;
    });

    const approveButtons = document.querySelectorAll('.approve-btn');
    
    approveButtons.forEach(button => {
        const requestId = button.getAttribute('data-request-id');
        const row = button.closest('tr');

        // Verificar si la solicitud ya ha sido aprobada (si hay un valor en localStorage)
        const isApproved = localStorage.getItem(`request_${requestId}_approved`);
        if (isApproved) {
            row.style.backgroundColor = 'green';
            // Cambiar el estilo de la letra al aprobar la solicitud
            row.style.color = 'white';
            row.style.fontWeight = 'bold';
            button.style.display = 'none';
            
            const cancelButton = row.querySelector('.cancel-btn');
            if (cancelButton) {
                cancelButton.style.display = 'none';
            }
        }

        button.addEventListener('click', function () {
            Swal.fire({
                title: '¿Está seguro?',
                text: 'Esta acción marcará la solicitud como aprobada.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, aprobar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cambiar el color de la fila al aprobar la solicitud
                    row.style.backgroundColor = 'green';
                    // Cambiar el estilo de la letra al aprobar la solicitud
                    row.style.color = 'white';
                    row.style.fontWeight = 'bold';
                    button.style.display = 'none';

                    // Almacenar la aprobación en localStorage
                    localStorage.setItem(`request_${requestId}_approved`, 'true');

                    Swal.fire(
                        '¡Aprobada!',
                        'La solicitud ha sido marcada como aprobada.',
                        'success'
                    );

                    // Aquí puedes agregar lógica adicional, como enviar una solicitud al servidor para marcar la aprobación en la base de datos.
                }
            });
        });
    });
});
</script>
@endsection