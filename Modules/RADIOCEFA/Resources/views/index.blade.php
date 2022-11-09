@extends('radiocefa::layouts.master')

@section('content')

<div class="content">
    <div class="header">
        <img src="{{asset('radi__cefa/headerRadio.jpg')}}" style="bacgraund-color:rgb(194, 194, 194, 0.5)">
    </div>
</div>

<iframe src="https://zeno.fm/player/radio-cefa" width="768" height="600" frameborder="0" scrolling="no"></iframe><a href="https://zeno.fm/" target="_blank" style="display: block; font-size: 0.9em; line-height: 10px;">A Zeno.FM Station</a>

@endsection
