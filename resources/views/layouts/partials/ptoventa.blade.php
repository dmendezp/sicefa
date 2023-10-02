    <!-- ======= Portfolio Section ======= -->
    <section id="ptoventa" class="portfolio sinfondo">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Punto de venta</h2>
                <p>Productos en venta / animales de corral</p>
            </div>

            <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-carnicos">Carnicos</li>
                <li data-filter=".filter-panaderia">Panaderia</li>
                <li data-filter=".filter-fruver">Frutas y verduras</li>
                <li data-filter=".filter-lacteos">Lacteos</li>
                <li data-filter=".filter-animales">Animales</li>
            </ul>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item filter-lacteos">
                    <!--filtro de busqueda-->
                    <a href="{{ asset('general/assets/img/portfolio/lacteos2.png') }}"
                        class="portfolio-lightbox preview-link">
                        <div class="portfolio-img text-center"><img
                                src="{{ asset('general/assets/img/portfolio/lacteos2.png') }}" class="img-fluid"
                                alt=""></div>
                    </a>
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>Yogurt</h4>
                            <!---descripcion-->
                            <p>$ 1.200</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-lacteos">
                    <!--filtro de busqueda-->
                    <a href="{{ asset('general/assets/img/portfolio/quesotajado.jpg') }}"
                        class="portfolio-lightbox preview-link">
                        <div class="portfolio-img text-center"><img
                                src="{{ asset('general/assets/img/portfolio/quesotajado.jpg') }}" class="img-fluid"
                                alt=""></div>
                    </a>
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>Queso Tajado</h4>
                            <!---descripcion-->
                            <p>$ 8.000</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-animales">
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

                <div class="col-lg-4 col-md-6 portfolio-item filter-animales">
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

                <div class="col-lg-4 col-md-6 portfolio-item filter-fruver">
                    <div class="portfolio-img"><img src="{{ asset('general/assets/img/portfolio/portfolio-2.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>Limon</h4>
                        <p>$ 2.000</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-2.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-carnicos">
                    <div class="portfolio-img"><img src="{{ asset('general/assets/img/portfolio/portfolio-3.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>Chorizo</h4>
                        <p>$ 9.000</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-3.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-panaderia">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-4.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Mojicon</h4>
                        <p>$ 1.200</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-4.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-fruver">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-5.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Piña</h4>
                        <p>$ 5.000</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-5.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-carnicos">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-6.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Hamburguesa</h4>
                        <p>$ 6.000</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-6.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-panaderia">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Croissant</h4>
                        <p>$ 1.200</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-7.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-panaderia">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Pan con queso</h4>
                        <p>$ 1.000</p>
                        <a href="{{ asset('general/assets/img/portfolio/portfolio-8.jpg') }}"
                            data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-fruver">
                    <div class="portfolio-img"><img
                            src="{{ asset('general/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-info">
                        <h4>Maracuya</h4>
                        <p>$ 3.000</p>
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
