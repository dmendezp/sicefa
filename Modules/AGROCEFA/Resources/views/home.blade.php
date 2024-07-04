@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ... tus metadatos ... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    
    <section class="banner">
        <div class="banner-content">
            <h1>{{ trans('agrocefa::universal.maintitle')}}</h1>
            @if(isset($selectedUnitName))
                <h1>Unidad Productiva {{ $selectedUnitName }}</h1>
            @else
                {{-- <h1>No se ha seleccionado una unidad productiva.</h1> --}}
            @endif 
        </div>
    </section>
    <br>
    <!--Footer-->
    @include('agrocefa::partials.footer')
</body>
</html>
@endsection
