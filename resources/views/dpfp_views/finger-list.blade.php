@extends('senaempresa::layouts.master')


@section('content')

<div class="card card-outline card-primary m-2">
    <div class="card-header">
    <h3 class="card-title">User Fingerprint List : {{$person->full_name}} {{$person->document_number}}</h3><br>
    <button style="margin-bottom: 1%;" class="add_finger btn thead btn-success"  data-id="{{$person->id}}">Add Fingerprint</button>

    </div>

    <div class="card-body">
    <table border="1" class="table">
    <tr>
        <th>id</th>
        <th>fingerprint name</th>
        <th>fingerprint image</th>
        <th>Delete</th>
    </tr>
    <tbody>
        @foreach($finger_list as $finger)
        <tr>
            <td>{{$finger->id}}</td>
            <td>{{$finger->finger_name}}</td>
            <td style="text-align: center">
                <img  style="width: 30px;" src="{{asset($finger->image)}}"/>
            </td>
            <td>

            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>

</div>
@endsection