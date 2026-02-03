@extends('sg::layouts.masterAprendiz')

@section('content')
<br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            🥛 Editar Producción
        </h3>
        <p class="text-muted">
            Vaca {{ $milkProduction->animal->id }} • 
            {{ $milkProduction->production_date->format('d/m/Y') }}
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('sg.aprendiz.sg.PRODUCCION.update', $milkProduction) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- VACA --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Vaca</label>
                                <div class="form-control bg-light font-weight-bold">
                                    {{ $milkProduction->animal->id }} - {{ $milkProduction->animal->name ?: 'Sin nombre' }}
                                </div>
                                <input type="hidden" name="animal_id" value="{{ $milkProduction->animal->id }}">
                            </div>

                            {{-- FECHA --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Fecha *</label>
                                <input type="date"
                                       name="production_date"
                                       value="{{ $milkProduction->production_date->format('Y-m-d') }}"
                                       class="form-control"
                                       required>
                            </div>

                            {{-- TURNO --}}
                            <div class="col-md-12 mb-4">
                                <label class="font-weight-bold d-block mb-2">Turno *</label>
                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                    <label class="btn btn-outline-primary {{ $milkProduction->shift === 'MORNING' ? 'active' : '' }}">
                                        <input type="radio" name="shift" value="MORNING" {{ $milkProduction->shift === 'MORNING' ? 'checked' : '' }}>
                                        ☀️ Mañana
                                    </label>
                                    <label class="btn btn-outline-warning {{ $milkProduction->shift === 'AFTERNOON' ? 'active' : '' }}">
                                        <input type="radio" name="shift" value="AFTERNOON" {{ $milkProduction->shift === 'AFTERNOON' ? 'checked' : '' }}>
                                        🌤️ Tarde
                                    </label>
                                    <label class="btn btn-outline-dark {{ $milkProduction->shift === 'NIGHT' ? 'active' : '' }}">
                                        <input type="radio" name="shift" value="NIGHT" {{ $milkProduction->shift === 'NIGHT' ? 'checked' : '' }}>
                                        🌙 Noche
                                    </label>
                                </div>
                            </div>

                            {{-- LITROS --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Litros Producidos *</label>
                                <input type="number"
                                       step="0.01"
                                       name="liters"
                                       value="{{ $milkProduction->liters }}"
                                       class="form-control form-control-lg text-center font-weight-bold text-success"
                                       required>
                            </div>

                            {{-- CALIDAD --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold d-block mb-2">Calidad *</label>
                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                    <label class="btn btn-outline-success {{ $milkProduction->quality === 'HIGH' ? 'active' : '' }}">
                                        <input type="radio" name="quality" value="HIGH" {{ $milkProduction->quality === 'HIGH' ? 'checked' : '' }}>
                                        Alta
                                    </label>
                                    <label class="btn btn-outline-warning {{ $milkProduction->quality === 'MEDIUM' ? 'active' : '' }}">
                                        <input type="radio" name="quality" value="MEDIUM" {{ $milkProduction->quality === 'MEDIUM' ? 'checked' : '' }}>
                                        Media
                                    </label>
                                    <label class="btn btn-outline-danger {{ $milkProduction->quality === 'LOW' ? 'active' : '' }}">
                                        <input type="radio" name="quality" value="LOW" {{ $milkProduction->quality === 'LOW' ? 'checked' : '' }}>
                                        Baja
                                    </label>
                                </div>
                            </div>

                            {{-- TEMPERATURA --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Temperatura de la Leche (°C)</label>
                                <input type="number"
                                       step="0.1"
                                       name="milk_temperature"
                                       value="{{ $milkProduction->milk_temperature }}"
                                       class="form-control text-center">
                            </div>

                            {{-- RESPONSABLE --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">Responsable</label>
                                <input type="text"
                                       name="responsible"
                                       value="{{ $milkProduction->responsible }}"
                                       class="form-control">
                            </div>

                            {{-- OBSERVACIONES --}}
                            <div class="col-md-12 mb-4">
                                <label class="font-weight-bold">Observaciones</label>
                                <textarea name="observations"
                                          rows="4"
                                          class="form-control">{{ $milkProduction->observations }}</textarea>
                            </div>

                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('sg.aprendiz.sg.PRODUCCION.index') }}"
                               class="btn btn-outline-secondary btn-lg">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="btn btn-warning btn-lg font-weight-bold">
                                💾 Actualizar Producción
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
