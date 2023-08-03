<!DOCTYPE html>
<html lang="es">
    @include('tilabs::layouts.partials.head')
    @section('stylesheet')
    @show
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('tilabs::layouts.partials.navbar')
            @include('tilabs::layouts.partials.sidebar')
            <div class="content-wrapper">
                @include('tilabs::layouts.partials.breadcrumb')
                @section('content')
                @show
            </div>
            @include('tilabs::layouts.partials.footer')
        </div>
        @include('tilabs::layouts.partials.scripts')
    </body>
</html>
