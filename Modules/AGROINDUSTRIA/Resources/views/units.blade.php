@extends('agroindustria::layouts.master')
@section('content')

<div class="container">
    @if($noRecords)
    <p>No se encontraron unidades productivas.</p>
    @else
    <div class="container text-center">
      <div class="row">
        @foreach ($units as $unit)
        @php
            $unitIcons = [       
                'Panaderia' => 'fas fa-bread-slice fa-lg',
                'Chocolateria' => 'fas fa-mug-hot fa-lg',
                'Pasteleria' => 'fas fa-birthday-cake fa-lg',
            ];
        $unitRoutes = [
            'Panaderia' => route('cefa.agroindustria.units.bakery', ['unit'=> $unit->id]), // Reemplazar con la ruta real
            'Chocolateria' => route('cefa.agroindustria.units.pasteleria',['unit' => $unit->id]), 
            'Pasteleria' => route('cefa.agroindustria.units.pasteleria',['unit' => $unit->id]), 
        ];

        // Determinar el ícono correspondiente al nombre de la unidad actual
        $currentUnitIcon = $unitIcons[$unit->name] ?? 'fas fa-question-circle fa-lg';
        $currentUnitRoute = $unitRoutes[$unit->name] ?? '#';
        @endphp
            <div class="col">
                <button onclick="window.location.href = '{{ $currentUnitRoute }}'" class="card-client-button" id="boton_unit">
                    <div class="card-client-content">
                        <h2 class="tittleU">{{ $unit->name }}</h2>
                        <br>
                        <i class="{{$currentUnitIcon}}" style="color: #ffffff;"></i>
                        <br><br>
                    </div>
                </button>                
            </div>
        @endforeach
            
        </div>
    </div>
    @endif
</div>

@endsection