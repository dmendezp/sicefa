@extends('ptventa::layouts.master')

@section('head')
    {{-- PhotoSwipe-5.3.7 --}}
    <link rel="stylesheet" href="{{ asset('PhotoSwipe-5.3.7/dist/photoswipe.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Inicio</a></li>
    <li class="breadcrumb-item active">Productos</li>
    <li class="breadcrumb-item active">Imágenes</li>
@endsection

@section('content')
    <div class="card card-success card-outline">
        <div class="card-body">
            <div class="pswp-gallery" id="my-gallery">
                @foreach ($elements as $e)
                    <a href="{{ asset($e->image) }}" data-pswp-width="60" data-pswp-height="40">
                        <img src="{{ asset($e->image) }}" alt="{{ $e->name }}"/>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('PhotoSwipe-5.3.7/dist/photoswipe-lightbox.esm.js') }}"></script>
    <script>
        const lightbox = new PhotoSwipeLightbox({
            gallery: '#my-gallery',
            children: 'a',
            pswpModule: () => import('{{ asset("PhotoSwipe-5.3.7/dist/photoswipe.esm.js") }}')
        });
        lightbox.init();
    </script>
@endsection
