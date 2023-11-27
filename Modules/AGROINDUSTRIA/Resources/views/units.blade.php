@extends('agroindustria::layouts.master')
@section('content')

    @if($noRecords)
    <p>No se encontraron unidades productivas.</p>
    @else
    <div class="container text-center">
      <div class="row">
        @foreach ($units as $unit)
            <div class="col">
                <a href="{{route('cefa.agroindustria.units.instructor.formulations' , ['unit'=> $unit->id])}}">
                    <button class="card-client-button" id="boton_unit" data-unit-name="{{ $unit->name }}"  onclick="selectUnit('{{ $unit->id }}', '{{ $unit->name }}')">
                        <div class="card-client-content">
                            <h2 class="tittleU">{{ $unit->name }}</h2>
                            <br>
                            <i class="{{$unit->icon}}" style="color: #ffffff;"></i>
                            <br><br>
                        </div>
                    </button>   
                </a>             
            </div>
        @endforeach            
        </div>
    </div>
    @endif


    <script>
        function selectUnit(unitId, unitName) {
            // Actualizar el área de navegación con el nombre de la unidad seleccionada
            document.getElementById('title').innerText = `AGROINDUSTRIA - ${unitName}`;
    
            // Almacenar la unidad seleccionada en sessionStorage
            sessionStorage.setItem('viewing_unit', 'true');
            sessionStorage.setItem('viewing_unit_id', unitId);
            sessionStorage.setItem('viewing_unit_name', unitName);
        }
    </script>
@endsection