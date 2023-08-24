@extends('agrocefa::layouts.master')

@section('content')
<link rel="stylesheet" href="{{asset ('agrocefa/css/specie.css')}}">

<h2>Parametros de especies de cultivo</h2>

<td>
    <a href="{{ route('agrocefa.species.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>
    </a>
</td>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Ciclo de vida</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    @foreach($species as $a)
    <tr>
        <td>{{$a->id}}</td>
        <td>{{$a->name}}</td>
        <td>{{$a->lifecycle}}</td>

        <td>
            <a href="{{ route('agrocefa.species.edit', ['id' => $a->id]) }}" class="edit">
                <i class="fa-solid fa-pen-to-square custom-icon"></i>
            </a>
        </td>

        <td>
            <a href="{{ route('agrocefa.species.delete', ['id' => $a->id]) }}" class="delete">
                <i class="fa-solid fa-trash"></i>
            </a>
        </td>
    </tr>
    @endforeach
</table>


@endsection
