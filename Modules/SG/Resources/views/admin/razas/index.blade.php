@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Razas</h3>
        <a href="{{ route('sg.admin.sg.razas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Raza
        </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Tabla --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light text-center">
                    <tr>
                        <th width="80">ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th width="120">Animales</th>
                        <th width="160">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($breeds as $breed)

                    <tr>
                        <td class="text-center font-weight-bold text-primary">
                            {{ $breed->id }}
                        </td>

                        <td class="font-weight-bold">
                            {{ $breed->name }}
                        </td>

                        <td>
                            {{ Str::limit($breed->description, 60) ?? '—' }}
                        </td>

                        <td class="text-center">
                            <span class="badge badge-info">
                                {{ $breed->animals_count ?? $breed->animals()->count() }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('sg.admin.sg.razas.show',$breed) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('sg.admin.sg.razas.edit',$breed) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('sg.admin.sg.razas.destroy',$breed) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar esta raza?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            No hay razas registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $breeds->links() }}
        </div>
    </div>

</div>
@endsection
