@extends('gth::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Manual de Usuario</li>
@endpush
@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-success card-outline shadow">
                    <div class="card-body text-center">
                        <h1 class="display-4 hero_title">Manual de Usuario de la Gestión de Talento Humano</h1>
                        <p class="lead hero_paragraph">Gestión de Talento Humano</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="d-flex align-items-center justify-content-center">
        <div class="pdf-container mx-auto p-4" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); width: 45%;">
            <iframe src="{{ $pdfPath1 }}" class="w-100" height="400px" style="border: none;"></iframe>
        </div>
    </div>
    <br>
@endsection






