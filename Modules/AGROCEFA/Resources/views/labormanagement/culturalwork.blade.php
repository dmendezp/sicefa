@extends('agrocefa::layouts.master')

@section('content')
    <li style="margin-left: 40px; margin-right: 130px; ">
        <a href="#" id="an">
            @if (!empty(Session::get('selectedUnitName')))
                APLICACIÓN DE LABORES CULTURALES-{{ Session::get('selectedUnitName') }}
            @else
                APLICACIÓN DE LABORES CULTURALES
            @endif
        </a>
    </li>
@endsection
