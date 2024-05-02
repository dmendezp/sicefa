    <!-- ======= Portfolio Section ======= -->
    <section id="ptoventa" class="portfolio sinfondo">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Punto de venta</h2>
                <p>Productos en venta</p>
            </div>
            <div class="horizontal-scroll-container">
                <div id="portfolio-flters-container">
                    <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($categories as $category)
                        <li data-filter=".filter-{{ $category->id }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <button class="scroll-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="scroll-next"><i class="fas fa-chevron-right"></i></button>
            </div>
            
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                @foreach ($inventories as $inventory)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $inventory->element->category_id }}" style="width: 20%">
                    <!--filtro de busqueda-->
                    <div class="image-container" style="width: 100%; height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                        @if ($inventory->element->image)
                        <a href="{{ asset($inventory->element->image) }}" class="portfolio-lightbox preview-link">
                            <div class="portfolio-img text-center">
                                <img src="{{ asset($inventory->element->image) }}" class="img-fluid portfolio-image" alt="" style="max-width: 100%; max-height: 100%; display: block;">
                            </div>
                        </a>
                        @else
                        <a href="{{ asset('general/images/product.png') }}" class="portfolio-lightbox preview-link">
                            <div class="portfolio-img text-center">
                                <img src="{{ asset('general/images/product.png') }}" class="img-fluid portfolio-image" alt="" style="max-width: 100%; max-height: 100%; display: block;">
                            </div>
                        </a>
                        @endif
                    </div>
                    
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
    {{-- Script para desplazamiento de la barra categorias --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('portfolio-flters-container');
            const scrollStep = 200; // Cantidad de desplazamiento en píxeles
    
            document.querySelector('.scroll-prev').addEventListener('click', function() {
                console.log("Botón de desplazamiento izquierdo clickeado");
                container.scrollLeft -= scrollStep;
            });
    
            document.querySelector('.scroll-next').addEventListener('click', function() {
                console.log("Botón de desplazamiento derecho clickeado");
                container.scrollLeft += scrollStep;
            });
        });
    </script>
    
    
