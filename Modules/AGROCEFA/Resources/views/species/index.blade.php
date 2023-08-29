@extends('agrocefa::layouts.master')

@section('content')
<link rel="stylesheet" href="{{asset ('agrocefa/css/specie.css')}}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="content_species">

<h2 id="titulo">Lista de especies de cultivo</h2>


    <a href="{{ route('agrocefa.species.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>Agregar especie
    </a>

    @if(session('success'))
    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro eliminado correctamente',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    @endif

    @if(session('error'))
        <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Error en el proceso, intenta de nuevo',
            showConfirmButton: false,
            timer: 1500
        })
        </script>
    @endif

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Ciclo de vida</th>
        <th>Acciones</th>
    </tr>
    @foreach($species as $a)
    <tr>
        <td>{{$a->id}}</td>
        <td>{{$a->name}}</td>
        <td>{{$a->lifecycle}}</td>

        <td class="bottons">
            <div class="button-group">
                <a href="{{ route('agrocefa.species.edit', ['id' => $a->id]) }}" class="edit">
                    <i class="fa-solid fa-pen-to-square custom-icon"></i>
                </a>

                <form action="{{ route('agrocefa.species.destroy', ['id' => $a->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</table>
</div>

@endsection

