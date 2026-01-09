@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ficha del Bovino: {{ $animal->id }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-lg overflow-hidden">

                <!-- Banner con foto -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 h-48 relative">
                    <div class="absolute inset-0 bg-black opacity-30"></div>
                    <div class="absolute bottom-0 left-8 transform translate-y-12">
                        <img src="{{ $animal->photo_url }}"
                             class="w-48 h-48 rounded-full border-8 border-white shadow-2xl object-cover">
                    </div>
                </div>

                <div class="pt-20 px-8 pb-8">
                    <div class="flex justify-between items-start mb-8">
                        <div class="ml-60">
                            <h1 class="text-4xl font-bold text-gray-800">
                                {{ $animal->id }} 
                                <span class="text-2xl text-gray-600">{{ $animal->name ? "- {$animal->name}" : '' }}</span>
                            </h1>
                            <p class="text-xl text-green-600 font-semibold mt-2">
                                {{ $animal->breed?->name }} • 
                                {{ $animal->sex === 'FEMALE' ? 'Vaca' : 'Toro' }} • 
                                {{ $animal->age_text }}
                            </p>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('sg.admin.sg.animales.edit', $animal) }}"
                               class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg">
                                Editar
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="font-bold text-gray-700 mb-3">Información Básica</h3>
                            <p><strong>Raza:</strong> {{ $animal->breed?->name }}</p>
                            <p><strong>Sexo:</strong> {{ $animal->sex === 'FEMALE' ? 'Hembra' : 'Macho' }}</p>
                            <p><strong>Edad:</strong> {{ $animal->age_text }}</p>
                            <p><strong>Etapa Productiva:</strong> 
                                <span class="px-3 py-1 rounded-full text-white text-sm {{ $animal->production_stage === 'MILKING' ? 'bg-green-600' : 'bg-gray-600' }}">
                                    {{ $animal->production_stage }}
                                </span>
                            </p>
                            <p><strong>Lote:</strong> {{ $animal->lot ?: 'Sin asignar' }}</p>
                        </div>

                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="font-bold text-gray-700 mb-3">Datos Físicos</h3>
                            <p><strong>Peso actual:</strong> {{ $animal->weight_kg ?? 'Sin registrar' }} kg</p>
                            <p><strong>Condición corporal:</strong> {{ $animal->body_condition ?: 'No evaluada' }}</p>
                            <p><strong>Fecha ingreso:</strong> {{ $animal->entry_date?->format('d/m/Y') ?? 'No registrada' }}</p>
                        </div>

                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="font-bold text-gray-700 mb-3">Producción</h3>
                            <p><strong>Litros hoy:</strong> 
                                {{ $animal->milkProductions()->whereDate('production_date', today())->sum('liters') ?? 0 }} L
                            </p>
                            <p><strong>Total histórico:</strong> 
                                {{ $animal->milkProductions()->sum('liters') }} L
                            </p>
                        </div>
                    </div>

                    <div class="mt-10 text-center">
                        <a href="{{ route('sg.admin.sg.animales.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg">
                            ← Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection