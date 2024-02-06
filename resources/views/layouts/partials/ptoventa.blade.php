    <!-- ======= Portfolio Section ======= -->
    <section id="ptoventa" class="portfolio sinfondo">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Punto de venta</h2>
                <p>Productos en venta / animales de corral</p>
            </div>
            
            <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                @foreach ($categories as $category)
                <li data-filter=".filter-{{ $category->name }}">{{ $category->name }}</li>
                @endforeach
            </ul>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

            @foreach ($inventories as $inventory)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $inventory->element->category->name }}">
                    <!--filtro de busqueda-->
                    <a href="{{ asset('general/assets/img/portfolio/lacteos2.png') }}"
                        class="portfolio-lightbox preview-link">
                        <div class="portfolio-img text-center"><img
                                src="{{ asset($inventory->element->image) }}" class="img-fluid"
                                alt=""></div>
                    </a>
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>{{ $inventory->element->name }}</h4>
                            <!---descripcion-->
                            <p>$ 1.200</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </section><!-- End Portfolio Section -->
