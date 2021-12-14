    <!-- ======= Portfolio Section ======= -->
    <section id="ptoventa" class="portfolio sinfondo">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Punto de venta</h2>
                <p>Productos en venta / animales de corral</p>
            </div>

            <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-consumibles">consumibles</li>
                <li data-filter=".filter-card">Card</li>
                <li data-filter=".filter-web">Web</li>
                <li data-filter=".filter-lacteos">lacteos</li>
                <li data-filter=".filter-ganado">ganado</li>
            </ul>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item filter-consumibles">
                    <!--filtro de busqueda-->
                    <a href="{{ asset('general/assets/img/portfolio/lacteos2.png') }}"
                        class="portfolio-lightbox preview-link">
                        <div class="portfolio-img text-center"><img
                                src="{{ asset('general/assets/img/portfolio/lacteos2.png') }}" class="img-fluid"
                                alt=""></div>
                    </a>
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <!---descripcion-->
                            <p>App</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-ganado">
                    <!--filtro de busqueda-->
                    <a href="{{ asset('general/assets/img/portfolio/ganado2.png') }}"
                        class="portfolio-lightbox preview-link">
                        <div class="portfolio-img text-center"><img
                                src="{{ asset('general/assets/img/portfolio/ganado2.png') }}" class="img-fluid"
                                alt=""></div>
                    </a>
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>ganado</h4>
                            <!---descripcion-->
                            <p>App</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-ganado">
                    <!--filtro de busqueda-->
                    <a href="{{ asset('general/assets/img/portfolio/ganado.png') }}"
                        class="portfolio-lightbox preview-link">
                        <div class="portfolio-img text-center"><img
                                src="{{ asset('general/assets/img/portfolio/ganado.png') }}" class="img-fluid"
                                alt=""></div>
                    </a>
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>ganado</h4>
                            <!---descripcion-->
                            <p>App</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-img"><img src="{{ asset('general/assets/img/portfolio/portfolio-2.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>Web 3</h4>
                        <p>Web</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-2.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-consumibles">
                    <div class="portfolio-img"><img src="{{ asset('general/assets/img/portfolio/portfolio-3.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>App 2</h4>
                        <p>App</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-3.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-4.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Card 2</h4>
                        <p>Card</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-4.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-5.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Web 2</h4>
                        <p>Web</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-5.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-consumibles">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-6.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>App 3</h4>
                        <p>App</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-6.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Card 1</h4>
                        <p>Card</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-7.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Card 3</h4>
                        <p>Card</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-8.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Web 3</h4>
                        <p>Web</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-9.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-lacteos">
                    <div class="portfolio-img text-center"><img
                            src="{{ asset('general/assets/img/portfolio/lacteos.png') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Card 2</h4>
                        <p>Card</p>
                        <a href="{{ asset('general/assets/img/portfolio/lacteos.png') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Portfolio Section -->
