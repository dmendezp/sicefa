<!DOCTYPE html>
<html lang="es">

<head>
    @include('cafeto::layouts.mainPage.partials.head')
    @stack('head')
</head>

<body>
    <div class="preloader">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- Document Wrapper -->
    <div id="wrapper" class="wrapper clearfix">
        <header id="navbar-spy" class="header header-1 header-transparent header-fixed">
            <!-- Navbar -->
            @include('cafeto::layouts.mainPage.partials.navbar')
            <!-- /.Navbar -->
        </header>

        <!-- MainContent -->
        @section('content') @show
        <!-- /.MainContent -->

    </div>
    <!-- #wrapper end -->

    <!-- Footer -->
    @include('cafeto::layouts.mainPage.partials.footer')
    <!-- /.Footer -->

    <!-- Footer Scripts -->
    @include('cafeto::layouts.mainPage.partials.scripts')
    @stack('scripts')
</body>

</html>
