<aside id="mySidebar" class="control-sidebar control-sidebar-dark control-sidebar-overlap">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>{{ trans('cafeto::general.Browse') }}</h5>
        <p>{{ trans('cafeto::general.Clic') }}</p>
        <!-- Seccion de acceso rapido de Apps -->
        <section class="services">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    @foreach (getApps() as $app)
                        <style type="text/css">
                            .services .icon-box:hover .colorapp{{ $app->id }} {
                                color: {{ $app->color }} !important;
                            }
                        </style>
                        <div class="col-xl-6 col-md-3 d-flex align-items-stretch mt-2" data-aos="zoom-in"
                            data-aos-delay="100">
                            <div class="icon-box">
                                <div class="icon-img">
                                    <h4>
                                        <a class="colorapp{{ $app->id }}" href="{{ url($app->url) }}"
                                            style="text-decoration: none" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ $app->name }}">
                                            <i class="colorapp{{ $app->id }} {{ $app->icon }}"></i>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Fin de Seccion de acceso rapido de Apps -->
    </div>
</aside>