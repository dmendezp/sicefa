<!-- laborDetails.blade.php -->

@if (!empty($labor->activity))
<br>
<div style="background-color: #a0dfef; padding: 15px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <center><h3 style="color: #333; font-size: 1.8em; margin-bottom: 15px;">{{ trans('agrocefa::balancelabor.Labor Details') }}</h3></center>
    <center><p style="color: #555; font-size: 1.4em; margin-bottom: 0;">{{ trans('agrocefa::balancelabor.Executed Activity:') }} <strong>{{ $labor->activity->name }}</strong></p>
    </div></center>

    <!-- Agrega más detalles según sea necesario -->
    <style>
        .card {
            background-color: #f2f2f2; /* Puedes ajustar el valor hexadecimal según tus preferencias de color */
        }
    
        .card-header {
            /* Puedes agregar estilos adicionales para el encabezado si es necesario */
        }
    </style>
    
    <div class="card">
        <div class="card-header">
            <span style="float: left;">{{ trans('agrocefa::balancelabor.Elements Associated with the Work') }}</span>
            <a id="pdf" href="{{ route('agrocefa.reports.laborpdf', ['laborId' => $labor->id]) }}" class="btn btn-danger" target="_blank" style="float: right;">PDF</a>
            <div style="clear: both;"></div> <!-- Añadir clearfix para limpiar el float y evitar problemas de diseño -->
        </div>
        
        <!-- Contenido de la tarjeta -->
    </div>
    
    
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('agrocefa::balancelabor.Component') }}</th>
                <th>{{ trans('agrocefa::balancelabor.Type') }}</th>
                <th>{{ trans('agrocefa::balancelabor.Amount') }}</th>
                <th>{{ trans('agrocefa::balancelabor.Unit Price') }}</th>
                <th>{{ trans('agrocefa::balancelabor.Total Cost') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labor->equipments as $equipment)
                <tr>
                    <td>{{ $equipment->inventory->element->name }}</td>
                    <td>{{ trans('agrocefa::balancelabor.Equipment') }}</td>
                    <td>{{ $equipment->amount }}</td>
                    <td>{{ $equipment->price }}</td>
                    <td>{{ $equipment->amount * $equipment->price }}</td>
                </tr>
            @endforeach

            @foreach($labor->consumables as $consumable)
                <tr>
                    <td>{{ $consumable->inventory->element->name }}</td>
                    <td>{{ trans('agrocefa::balancelabor.Consumable') }}</td>
                    <td>{{ $consumable->amount }}</td>
                    <td>{{ $consumable->price }}</td>
                    <td>{{ $consumable->amount * $consumable->price }}</td>
                </tr>
            @endforeach

            
            @foreach($labor->executors as $executor)
                <tr>
                    <td>{{ $executor->person->first_name }}</td>
                    <td>{{ trans('agrocefa::balancelabor.Contracted personnel') }}</td>
                    <td>{{ $executor->amount }}</td>
                    <td>{{ $executor->price }}</td>
                    <td>{{ $executor->amount * $executor->price }}</td>
                </tr>
            @endforeach

            @foreach($labor->tools as $tool)
                <tr>
                    <td>{{ $tool->inventory->element->name }}</td>
                    <td>{{ trans('agrocefa::balancelabor.Tool') }}</td>
                    <td>{{ $tool->amount }}</td>
                    <td>{{ $tool->price }}</td>
                    <td>{{ $tool->amount * $tool->price }}</td>
                </tr>
            @endforeach

            @foreach($labor->productions as $production)
                <tr>
                    <td>{{ $production->element->name }}</td>
                    <td>{{ trans('agrocefa::balancelabor.Production') }}</td>
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
@endif

