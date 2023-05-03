@extends('ptventa::layouts.master')

@section('head')
    {{-- Estilos de livewire --}}
    @livewireStyles()
@endsection

@section('breadcrumb')
    {{-- The breadcrumb is the tracking af the displayed view --}}
    <li class="breadcrumb-item"><a href="{{ route('ptventa.sale.index') }}" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')
    @livewire('ptventa::sale.generate-sale')
@endsection

@section('scripts')
    {{-- Scripts de livewire --}}
    @livewireScripts()
@endsection
