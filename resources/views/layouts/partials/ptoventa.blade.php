    <!-- ======= Portfolio Section ======= -->
    <section id="ptoventa" class="portfolio sinfondo">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Punto de venta</h2>
                <p>Productos en venta</p>
            </div>
            
            <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                @foreach ($categories as $category)
                <li data-filter=".filter-{{ $category->id }}">{{ $category->name }}</li>
                @endforeach
            </ul>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

            @foreach ($inventories as $inventory)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $inventory->element->category_id }}">
                    <!--filtro de busqueda-->
                    
                        @if ( $inventory->element->image)
                        <a href="{{ asset($inventory->element->image) }}"
                        class="portfolio-lightbox preview-link">
                            <div class="portfolio-img text-center"><img
                                src="{{ asset($inventory->element->image) }}" class="img-fluid"
                                alt="">
                            </div>
                        </a>     
                        @else
                        <a href="{{ asset('general/images/product.png') }}"
                        class="portfolio-lightbox preview-link">
                            <div class="portfolio-img text-center" ><img
                                src="{{ asset('general/images/product.png') }}" class="img-fluid"
                                alt="">
                            </div>
                        </a> 
                        
                        @endif
                        
                    
                    <a href="#" title="More Details">
                        <div class="portfolio-info">
                            <h4>{{ $inventory->element->name }}</h4>
                            <!---descripcion-->
                            <p>{{ $inventory->element->price }}</p>
                            <!---valor-->
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </section><!-- End Portfolio Section -->
