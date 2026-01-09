@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Producción: {{ $milkProduction->animal->id }} - {{ $milkProduction->production_date->format('d/m/Y') }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.produccion.update', $milkProduction) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Vaca</label>
                            <div class="px-5 py-4 bg-gray-100 rounded-lg text-xl font-bold">
                                {{ $milkProduction->animal->id }} - {{ $milkProduction->animal->name ?: 'Sin nombre' }}
                            </div>
                            <input type="hidden" name="animal_id" value="{{ $milkProduction->animal->id }}">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Fecha</label>
                            <input type="date" name="production_date" value="{{ $milkProduction->production_date->format('Y-m-d') }}"
                                   class="w-full px-5 py-4 border-2 rounded-lg text-lg" required>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Turno</label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer 
                                       {{ $milkProduction->shift === 'MORNING' ? 'border-blue-600 bg-blue-50' : 'border-gray-300' }}">
                                    <input type="radio" name="shift" value="MORNING" {{ $milkProduction->shift === 'MORNING' ? 'checked' : '' }} class="hidden">
                                    <span class="text-2xl">Mañana</span>
                                </label>
                                <label class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer 
                                       {{ $milkProduction->shift === 'AFTERNOON' ? 'border-orange-600 bg-orange-50' : 'border-gray-300' }}">
                                    <input type="radio" name="shift" value="AFTERNOON" {{ $milkProduction->shift === 'AFTERNOON' ? 'checked' : '' }} class="hidden">
                                    <span class="text-2xl">Tarde</span>
                                </label>
                                <label class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer 
                                       {{ $milkProduction->shift === 'NIGHT' ? 'border-purple-600 bg-purple-50' : 'border-gray-300' }}">
                                    <input type="radio" name="shift" value="NIGHT" {{ $milkProduction->shift === 'NIGHT' ? 'checked' : '' }} class="hidden">
                                    <span class="text-2xl">Noche</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Litros Producidos *</label>
                            <input type="number" step="0.01" name="liters" value="{{ $milkProduction->liters }}" required
                                   class="w-full px-5 py-4 border-2 rounded-lg text-3xl text-center font-bold text-green-600">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Calidad de la Leche *</label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer 
                                       {{ $milkProduction->quality === 'HIGH' ? 'border-green-600 bg-green-50' : 'border-gray-300' }}">
                                    <input type="radio" name="quality" value="HIGH" {{ $milkProduction->quality === 'HIGH' ? 'checked' : '' }} class="hidden">
                                    <span class="text-2xl font-bold text-green-600">Alta</span>
                                </label>
                                <label class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer 
                                       {{ $milkProduction->quality === 'MEDIUM' ? 'border-yellow-600 bg-yellow-50' : 'border-gray-300' }}">
                                    <input type="radio" name="quality" value="MEDIUM" {{ $milkProduction->quality === 'MEDIUM' ? 'checked' : '' }} class="hidden">
                                    <span class="text-2xl font-bold text-yellow-600">Media</span>
                                </label>
                                <label class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer 
                                       {{ $milkProduction->quality === 'LOW' ? 'border-red-600 bg-red-50' : 'border-gray-300' }}">
                                    <input type="radio" name="quality" value="LOW" {{ $milkProduction->quality === 'LOW' ? 'checked' : '' }} class="hidden">
                                    <span class="text-2xl font-bold text-red-600">Baja</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Temperatura de la Leche (°C)</label>
                            <input type="number" step="0.1" name="milk_temperature" value="{{ $milkProduction->milk_temperature }}"
                                   class="w-full px-5 py-4 border-2 rounded-lg text-2xl text-center">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3">Responsable</label>
                            <input type="text" name="responsible" value="{{ $milkProduction->responsible }}"
                                   class="w-full px-5 py-4 border-2 rounded-lg text-lg">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-lg font-bold text-gray-700 mb-3">Observaciones</label>
                            <textarea name="observations" rows="4"
                                      class="w-full px-5 py-4 border-2 rounded-lg text-lg">{{ $milkProduction->observations }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-12 space-x-6">
                        <a href="{{ route('sg.admin.sg.produccion.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-4 px-10 rounded-lg text-xl">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-12 rounded-lg text-xl shadow-lg">
                            Actualizar Producción
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection