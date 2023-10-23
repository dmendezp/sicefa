@extends('agrocefa::layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('agrocefa/css/specie.css') }}">

    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Exitoso',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Eliminado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

<div class="container" style="margin-left: 20px">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">{{ trans('agrocefa::parameters.Parameters') }}</h1>
        </div>
    </div>
    <div class="row">
        {{-- Columna 1 --}}
        <div class="col-md-6">
            @include('agrocefa::parameters.activity')
            @include('agrocefa::parameters.specie')
        </div>


        {{-- Columna 2 --}}
        <div class="col-md-6">
            @include('agrocefa::parameters.variety')
            <br>

            
        <br>
    </div>
</div>
<br>
<br>
<br>

<div class="row">
    @include('agrocefa::parameters.crop')
</div>
<br>






@endsection
