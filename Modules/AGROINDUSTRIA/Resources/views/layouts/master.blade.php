<!DOCTYPE html>
<html lang="en">
    <head>
        @include('agroindustria::layouts.partials.head')
    </head>
    <body>
        @include('agroindustria::layouts.partials.navbar')
        @yield('content')
        @include('agroindustria::layouts.partials.scripts')
    </body>
</html>
