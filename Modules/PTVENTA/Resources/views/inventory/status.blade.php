@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a></li>
    <li class="breadcrumb-item active">Estado de Productos </li>
@endpush
