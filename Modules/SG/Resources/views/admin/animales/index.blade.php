@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bovinos Registrados</h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-3xl font-bold text-gray-800">Gestión de Bovinos</h3>
                    <a href="{{ route('sg.admin.sg.animales.create') }}"
                       class="btn btn-primary">
                        + Registrar Bovino
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th style="width:90px">Foto</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Raza</th>
                            <th>Sexo</th>
                            <th>Fecha de Nacimiento </th>
                            <th>Fecha de Ingreso </th>
                            <th>Peso Actual (kg)  </th>
                            <th>Lote / Corral  </th>
                            <th>Edad</th>
                            <th>Observaciones</th>
                            <th>Etapa</th>
                            <th style="width:210px">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($animals as $animal)
                            <tr>
                                <td>
                                    <img src="{{ $animal->photo_url }}" alt="{{ $animal->name ?: $animal->id }}" class="img-thumbnail" style="width:72px;height:48px;object-fit:cover;">
                                </td>
                                <td>{{ $animal->id }}</td>
                                <td>{{ $animal->name ?: 'Sin nombre' }}</td>
                                <td>{{ $animal->breed?->name }}</td>
                                <td>{{ $animal->sex === 'FEMALE' ? 'Vaca' : ($animal->sex === 'MALE' ? 'Toro' : $animal->sex) }}</td>
                                <td>{{ $animal->birth_date ? \Carbon\Carbon::parse($animal->birth_date)->format('d/m/Y') : '' }}</td>
                                <td>{{ $animal->entry_date ? \Carbon\Carbon::parse($animal->entry_date)->format('d/m/Y') : '' }}</td>
                                <td>{{ $animal->weight_kg }}</td>
                                <td>{{ $animal->lot}}</td>
                                <td>{{ $animal->age_text }}</td>
                                <td>{{ $animal->observations }}</td>
                                <td>{{ $animal->production_stage === 'MILKING' ? 'En producción' : $animal->production_stage }}</td>
                                <td>
                                    <a href="{{ route('sg.admin.sg.animales.show', $animal->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                    <a href="{{ route('sg.admin.sg.animales.edit', $animal) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('sg.admin.sg.animales.destroy', $animal) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8">
                    {{ $animals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection