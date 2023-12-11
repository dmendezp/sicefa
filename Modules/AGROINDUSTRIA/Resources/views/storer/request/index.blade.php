@extends('agroindustria::layouts.master')
@section('content')

<div class="request" style="margin: 40px">
    <h1>{{trans('agroindustria::request.requestInstructor')}}</h1>
    <table id="request" class="hover" style="width: 100%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::request.date')}}</th>
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

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

        // Mover las filas ordenadas al cuerpo de la tabla
        rows.forEach(row => {
            tableBody.appendChild(row);
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