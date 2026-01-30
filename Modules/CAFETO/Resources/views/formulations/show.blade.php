{{-- resources/views/modules/cafeto/formulations/show.blade.php --}}
@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/formulations/show.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.index') }}"
        class="text-decoration-none">{{ trans('cafeto::formulations.Breadcrumb_Formulations_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::formulations.Breadcrumb_Active_Formulation_Show') }}</li>
@endpush

@section('content')
@php
    $categoryName = $formulation->element && $formulation->element->category ? $formulation->element->category->name : '—';
    $status = $formulation_status ?? (in_array($formulation->proccess, ['approved','pending'], true) ? $formulation->proccess : 'pending');
    $processText = $formulation_process_text ?? null;
@endphp

<div class="card custom-card-show" data-aos="fade-up">
    <div class="card-body">
        <h5 class="text-center text-light mb-4">
            {{ trans('cafeto::formulations.Show') }}:
            {{ $formulation->element ? $formulation->element->name : trans('cafeto::formulations.None') }}
        </h5>

        <hr class="border-secondary">

        <div class="formulation-details" data-aos="fade-up" data-aos-delay="100">
            @if (session('success'))
                <div class="alert alert-success" data-aos="fade-in">
                    {{ session('success') }}
                </div>
            @endif

            <div class="detail-item">
                <span class="detail-label">{{ trans('cafeto::formulations.Status') }}:</span>
                <span class="status-badge badge {{ $status === 'approved' ? 'bg-approved' : 'bg-pending' }}">
                    {{ ucfirst($status) }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Categoría:</span>
                <span class="detail-value">{{ $categoryName }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">{{ trans('cafeto::formulations.Amount') }}:</span>
                <span class="detail-value">{{ $formulation->amount }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">{{ trans('cafeto::formulations.Date') }}:</span>
                <span class="detail-value">{{ $formulation->date }}</span>
            </div>

            {{-- Proceso (guardado dentro de proccess como JSON) --}}
            <div class="detail-item">
                <span class="detail-label">Proceso:</span>
                <span class="detail-value">{{ ($processText !== null && $processText !== '') ? $processText : '—' }}</span>
            </div>

            <hr class="border-secondary mt-4">
            <h6 class="text-light mt-2">Detalles del producto producido</h6>

            <div class="detail-item"><span class="detail-label">Destino:</span><span class="detail-value">{{ $formulation->produced_destination ?? '—' }}</span></div>
            <div class="detail-item"><span class="detail-label">Lote:</span><span class="detail-value">{{ $formulation->produced_lot_number ?? '—' }}</span></div>
            <div class="detail-item"><span class="detail-label">Vence:</span><span class="detail-value">{{ $formulation->produced_expiration_date ?? '—' }}</span></div>
            <div class="detail-item"><span class="detail-label">Código inventario:</span><span class="detail-value">{{ $formulation->produced_inventory_code ?? '—' }}</span></div>
            <div class="detail-item"><span class="detail-label">Marca:</span><span class="detail-value">{{ $formulation->produced_mark ?? '—' }}</span></div>

            <hr class="border-secondary mt-4">
            <h6 class="text-light mt-2">{{ trans('cafeto::formulations.Ingredients') }}</h6>

            @if($formulation->ingredients && $formulation->ingredients->count() > 0)
                <ul class="ingredient-list text-light">
                    @foreach ($formulation->ingredients as $ingredient)
                        <li class="ingredient-item">
                            {{ $ingredient->element ? $ingredient->element->name : '—' }}:
                            {{ $ingredient->amount }}
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-warning">No hay ingredientes registrados.</div>
            @endif

            <div class="text-center mt-4 d-flex justify-content-center gap-2 flex-wrap">
                <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.index') }}"
                   class="btn btn-dark btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> {{ trans('cafeto::formulations.Back to Formulations') }}
                </a>

                <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.edit', $formulation) }}"
                   class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')
@push('scripts')
<script src="{{ asset('libs/AOS-2.3.1/dist/aos.js') }}"></script>
<script>AOS.init();</script>
@endpush
