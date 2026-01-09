@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Raza: {{ $breed->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">ID</h3>
                        <p class="text-gray-900">{{ $breed->id }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Nombre</h3>
                        <p class="text-gray-900 font-bold text-xl">{{ $breed->name }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-700">Descripción</h3>
                        <p class="text-gray-900">{{ $breed->description ?: 'Sin descripción' }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Creado</h3>
                        <p class="text-gray-900">{{ $breed->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Última actualización</h3>
                        <p class="text-gray-900">{{ $breed->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('sg.admin.sg.razas.edit', $breed) }}"
                       class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded">
                        Editar
                    </a>
                    <a href="{{ route('sg.admin.sg.razas.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                        ← Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection