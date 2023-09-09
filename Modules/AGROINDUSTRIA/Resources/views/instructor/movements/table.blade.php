<table id="deliveries" class="hover" style="width: 98%;">
    <thead>
        <tr>
            <th>Fecha de Solicitud</th>
            <th>Tipo de Movimiento</th>
            <th>Envia</th>
            <th>Recibe</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total del Movimiento</th>
            <th>Estado</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movements as $movement)
        <tr>
            <td>{{$movement->registration_date}}</td>
            <td>{{$movement->movement_type->name}}</td>
            <td>{{$movement->movement_responsibilities->first()->person->first_name . ' ' .$movement->movement_responsibilities->first()->person->first_last_name . ' ' . $movement->movement_responsibilities->first()->person->second_last_name}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>