<!DOCTYPE html>
<html lang="en">
    <head>
        @include('agroindustria::layouts_intern.partials.head')
    </head>
    <body>
        @include('agroindustria::layouts_intern.partials.navbar')
        @yield('content')
        @include('agroindustria::layouts_intern.partials.scripts')
    </body>
</html>
