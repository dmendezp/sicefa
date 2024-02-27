@extends('layouts.dpfp_layout')

@section('title')
Crear Usuarios
@endsection

@section('page_title')
Crear Usuarios
@endsection

@section('content')
<h3>Users List</h3>
<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th></th>
    </tr>
    <tbody>
        @foreach($people as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->full_name}}</td>
            <td>{{$user->personal_email}}</td>
            <td>
           <a href="users/{{$user->id}}/finger-list" style="font-size: 15px;margin-left: 7px;color:#03579f;" >fingerprint list</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $people->links() }}
@endsection