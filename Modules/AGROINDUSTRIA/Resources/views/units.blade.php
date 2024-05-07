@extends('agroindustria::layouts.master')
@section('content')

    @if($noRecords)
    <p>No se encontraron unidades productivas.</p>
    @else
    <div class="container text-center">
      <div class="row">
        @foreach ($units as $unit)
            <div class="col">
                @if(Route::is('*instructor.*') && Auth::user()->havePermission('agroindustria.instructor.units.activity'))
                <a href="{{route('agroindustria.instructor.units.activity' , ['unit'=> $unit->id])}}">
                    <button class="card-client-button" id="boton_unit" data-unit-name="{{ $unit->name }}"  onclick="selectUnit('{{ $unit->id }}', '{{ $unit->name }}')">
                        <div class="card-client-content">
                            <h2 class="tittleU">{{ $unit->name }}</h2>
                            <br>
                            <i class="{{$unit->icon}}" style="color: #ffffff;"></i>
                            <br><br>
                        </div>
                    </button>   
                </a>      
                @else
                @if(Route::is('*storer.*') && auth()->check() && checkRol('agroindustria.almacenista'))
                <a href="{{route('agroindustria.storer.units.inventory' , ['id'=> $unit->id])}}">
                    <button class="card-client-button" id="boton_unit" data-unit-name="{{ $unit->name }}"  onclick="selectUnit('{{ $unit->id }}', '{{ $unit->name }}')">
                        <div class="card-client-content">
                            <h2 class="tittleU">{{ $unit->name }}</h2>
                            <br>
                            <i class="{{$unit->icon}}" style="color: #ffffff;"></i>
                            <br><br>
                        </div>
                    </button>   
                </a>  
                @else  
                @if(Route::is('*admin.*') && Auth::user()->havePermission('agroindustria.admin.units.activity'))
                <a href="{{route('agroindustria.admin.units.activity' , ['unit'=> $unit->id])}}">
                    <button class="card-client-button" id="boton_unit" data-unit-name="{{ $unit->name }}"  onclick="selectUnit('{{ $unit->id }}', '{{ $unit->name }}')">
                        <div class="card-client-content">
                            <h2 class="tittleU">{{ $unit->name }}</h2>
                            <br>
                            <i class="{{$unit->icon}}" style="color: #ffffff;"></i>
                            <br><br>
                        </div>
                    </button>   
                </a> 
                @endif      
                @endif
                @endif
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