<!-- laborDetails.blade.php -->

@if (!empty($labor->activity))
<br>
<div style="background-color: #f0f0f0; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
    <h3 style="color: #333; font-size: 1.5em; margin-bottom: 10px;">Detalles de la Labor</h3>
    <p style="color: #555; font-size: 1.2em; margin-bottom: 0;">Actividad: <strong>{{ $labor->activity->name }}</strong></p>
</div>

    <!-- Agrega más detalles según sea necesario -->
        <div class="card">
            <div class="card-header">
                Elementos Asociados a la Labor
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Componente</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Costo Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labor->equipments as $equipment)
                <tr>
                    <td>{{ $equipment->inventory->element->name }}</td>
                    <td>Equipo</td>
                    <td>{{ $equipment->amount }}</td>
                    <td>{{ $equipment->price }}</td>
                    <td>{{ $equipment->amount * $equipment->price }}</td>
                </tr>
            @endforeach

            @foreach($labor->consumables as $consumable)
                <tr>
                    <td>{{ $consumable->inventory->element->name }}</td>
                    <td>Consumible</td>
                    <td>{{ $consumable->amount }}</td>
                    <td>{{ $consumable->price }}</td>
                    <td>{{ $consumable->amount * $consumable->price }}</td>
                </tr>
            @endforeach

            
            @foreach($labor->executors as $executor)
                <tr>
                    <td>{{ $executor->person->first_name }}</td>
                    <td>Ejecutor</td>
                    <td>{{ $executor->amount }}</td>
                    <td>{{ $executor->price }}</td>
                    <td>{{ $executor->amount * $executor->price }}</td>
                </tr>
            @endforeach

            @foreach($labor->tools as $tool)
                <tr>
                    <td>{{ $tool->inventory->element->name }}</td>
                    <td>Herramienta</td>
                    <td>{{ $tool->amount }}</td>
                    <td>{{ $tool->price }}</td>
                    <td>{{ $tool->amount * $tool->price }}</td>
                </tr>
            @endforeach

            @foreach($labor->productions as $production)
                <tr>
                    <td>{{ $production->element->name }}</td>
                    <td>Producción</td>
                    <td>{{ $production->amount }}</td>
                    <td>{{ $production->element->price }}</td>
                    <td>{{ $production->amount * $production->element->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@else
    <p>No se encontró información para la labor seleccionada.</p>
@endif

