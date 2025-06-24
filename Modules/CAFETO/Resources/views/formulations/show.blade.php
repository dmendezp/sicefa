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
                    <span class="status-badge badge {{ $formulation->proccess === 'approved' ? 'bg-approved' : 'bg-pending' }}">
                        {{ ucfirst($formulation->proccess) }}
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">{{ trans('cafeto::formulations.Amount') }}:</span>
                    <span class="detail-value">{{ $formulation->amount }} {{ trans('cafeto::formulations.units') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">{{ trans('cafeto::formulations.Date') }}:</span>
                    <span class="detail-value">{{ $formulation->date }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">{{ trans('cafeto::formulations.Element') }}:</span>
                    <span class="detail-value">{{ $formulation->element ? $formulation->element->name : trans('cafeto::formulations.None') }}</span>
                </div>
                <h6 class="text-light mt-4">{{ trans('cafeto::formulations.Ingredients') }}</h6>
                <ul class="ingredient-list text-light">
                    @foreach ($formulation->ingredients as $ingredient)
                        <li class="ingredient-item">{{ $ingredient->element->name }}: {{ $ingredient->amount }} {{ trans('cafeto::formulations.units') }}</li>
                    @endforeach
                </ul>
                <div class="text-center mt-4">
                    <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.index') }}"
                       class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                       title="{{ trans('cafeto::formulations.Back to Formulations') }}">
                        <i class="fa-solid fa-arrow-left me-1"></i> {{ trans('cafeto::formulations.Back to Formulations') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')
@push('scripts')
    <script src="{{ asset('libs/AOS-2.3.1/dist/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endpush