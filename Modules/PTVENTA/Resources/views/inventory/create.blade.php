@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Registro de entrada</li>
@endpush

@section('content')
    <div class="row mx-3">
        <div class="col-md-3">
            @livewire('ptventa::inventory.show-card-detail')
        </div>
        <div class="col-md-2">
            @livewire('ptventa::inventory.show-card-image')
        </div>
        <div class="col-md-7 h-100">
            @livewire('ptventa::inventory.form-inventory')
        </div>
    </div>
    <div class="row mx-3">
        @livewire('ptventa::inventory.show-table-products')
    </div>
    <div class="d-flex justify-content-evenly">
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-success form-control text-truncate">Guardar Todo <i class="fas fa-save"></i></button>
            </div>
        </div>
    </div>
@endsection
