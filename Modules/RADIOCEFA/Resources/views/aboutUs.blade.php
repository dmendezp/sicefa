@extends('radiocefa::layouts.master')

@section('styles')

{{--     <!-- Libraries Stylesheet -->
    <link href="{{ asset('radi__cefa/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('radi__cefa/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet"> --}}

@endsection
@include('radiocefa::layouts/partials/navbar')

@section('content')

<section class="container text-center">
	{{-- title for section --}}
	<h1 class="justify-content-md-center">Conoce mas de radio SENA</h1>

</section>

	{{-- body of content --}}
    <div class="container-xxl py-5">
        <div class="container">
        	<div class="card p-2">
            	<div class="row g-4 align-items-end mb-4">
                	<div class="col-lg-6">
                    	<img class="img-fluid rounded" src="{{ asset('radi__cefa/about1.jpeg') }}">
                	</div>
                	<div class="col-lg-6">
                    	<h1 class="display-5 mb-4 text-warning">Conoce más sobre radioSENA y su equipo de trabajo</h1>
                    	<p class="mb-4">Radiocefa es una aplicativo que busca facilitar la tarea de bienestar con la divulgación de información importante para todas las ares de centro de formación y también mejorar el ambiente en las diferentes horas del día y asi disfrutar mas la jornada.</p>

                    	<p class="mb-4">Te invitamos a dar una mirada mas de cerca a Radiocefa, conoce a su equipo de trabajo, disfruta de nuestras secciones y de la buena música.</p>
                    </div>
                </div>
            </div>
        </div>
	</div>	

<section>
        <div class="container">
        	<div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="intro text-center">
                        <h1>Equipo de trabajo</h1>
                        <p class="mx-auto">Nuestro gran equipo  de trabajao</p>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                {{-- card person --}}
                <div class="col-lg-4">
                    <div class="team-member">
                        <div class="image">
                            <img src="{{ asset('radi__cefa/avatar1.jpg') }}" alt="">
                        </div>

                        <h5>Marvin McKinney</h5>
                        <p>Marketing Coordinator</p>
                    </div>
                </div>
                {{-- /card person --}}
                {{-- card person --}}
                <div class="col-lg-4">
                    <div class="team-member">
                        <div class="image">
                            <img src="{{ asset('radi__cefa/avatar2.jpg') }}" alt="">
                        </div>

                        <h5>Kathryn Murphy</h5>
                        <p>Ethical Hacker</p>
                    </div>
                </div>
                {{-- /card person --}}
                {{-- card person --}}
                <div class="col-lg-4">
                    <div class="team-member">
                        <div class="image">
                            <img src="{{ asset('radi__cefa/avatar3.jpg') }}" alt="">

                        </div>

                        <h5>Darrell Steward</h5>
                        <p>Software Developer</p>
                    </div>
                </div>
                {{-- /card person --}}
            
            </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')


@endsection