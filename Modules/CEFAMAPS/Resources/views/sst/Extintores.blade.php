@extends('cefamaps::layouts.master')

@section('content')
<div class="container">
        <p class="card-text">{{ trans('cefamaps::sst.Title_Card_Fire_Extinguishers') }}</p>
        <div class="row">

            <div class="col-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/n8NkEB1T-fw"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <br>
            <div class="col-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/aWkwRObF5OY"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.carousel').carousel();
    </script>
@endsection
