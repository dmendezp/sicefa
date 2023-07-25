@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal</title>

</head>
<body>
	<section class="banner">
		<div class="banner-content">
			<h1>{{ trans('agrocefa::universal.maintitle')}}</h1>	
		</div>
	</section>
    <br>
	  <!--Footer-->
	  @include('agrocefa::partials.footer')

</body>
</html>
@endsection