@extends('sipork::layouts.masterusers')

@section('content')

<h1>Hello Mundo</h1>

<p>
    This is a sample page for the SIPORK module. You can customize this page as per your requirements.
   
    {!! config('sipork.name') !!}
</p>
   
@endsection
