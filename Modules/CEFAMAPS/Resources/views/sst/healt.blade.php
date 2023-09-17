@extends('cefamaps::layouts.master')

@section('content')
<div class="container">
        <p class="card-text">{{ trans('cefamaps::sst.Title_Card_Healt') }}</p>
        <div class="row">
            <div class="col-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/5CF3HZdu6Bc"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <br>
            <div class="col-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/h42jSt-fwNM"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
