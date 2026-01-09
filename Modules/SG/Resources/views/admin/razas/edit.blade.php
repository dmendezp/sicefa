@extends('sg::layouts.master')

@section('content')
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Raza: {{ $breed->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('sg.admin.sg.razas.update', $breed) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Raza *</label>
                        <input type="text" name="name" value="{{ old('name', $breed->name) }}"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">{{ old('description', $breed->description) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('sg.admin.sg.razas.index') }}" class="text-gray-600 hover:text-gray-900">
                            ← Volver
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                            Actualizar Raza
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
