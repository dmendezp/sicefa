    <!-- ======= Portfolio Section ======= -->
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

                @php
                    // ====== URL destino para ir a VENTA CAFETO con producto preseleccionado ======
                    // Prioridad: cashier > admin > instructor
                    $saleRouteName = null;

                    if (Auth::check()) {
                        if (checkRol('cafeto.cashier')) {
                            $saleRouteName = 'cafeto.cashier.sale.register';
                        } elseif (checkRol('cafeto.admin')) {
                            $saleRouteName = 'cafeto.admin.sale.register';
                        } elseif (checkRol('cafeto.instructor')) {
                            $saleRouteName = 'cafeto.instructor.sale.register';
                        }
                    }

                    // Si ya está logueado y tiene rol CAFETO: entra directo a register y pasa element_id
                    $saleUrl = $saleRouteName
                        ? route($saleRouteName, ['element_id' => $inventory->element_id])
                        : route('cefa.welcome'); // fallback si no tiene rol

                    // Si NO está logueado: login con redirect a register (con element_id)
                    if (!Auth::check()) {
                        // Se manda por defecto a cashier; si tu rol real es otro, el middleware lo manejará
                        $afterLogin = route('cafeto.cashier.sale.register', ['element_id' => $inventory->element_id]);
                        $saleUrl = route('login', ['redirect' => $afterLogin]);
                    }
                @endphp

                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $inventory->element->category_id }}" style="width: 20%">
                    <div class="image-container" style="width: 100%; height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                        @if ($inventory->element->image)
                            <a href="{{ asset($inventory->element->image) }}" class="portfolio-lightbox preview-link">
                                <div class="portfolio-img text-center">
                                    <img src="{{ asset($inventory->element->image) }}" class="img-fluid portfolio-image" alt=""
                                        style="max-width: 100%; max-height: 100%; display: block;">
                                </div>
                            </a>
                        @else
                            <a href="{{ asset('general/images/product.png') }}" class="portfolio-lightbox preview-link">
                                <div class="portfolio-img text-center">
                                    <img src="{{ asset('general/images/product.png') }}" class="img-fluid portfolio-image" alt=""
                                        style="max-width: 100%; max-height: 100%; display: block;">
                                </div>
                            </a>
                        @endif
                    </div>

                    {{-- ✅ AHORA EL CLICK SÍ ENVÍA A VENTA CAFETO --}}
                    <a href="{{ $saleUrl }}" title="Ir a venta">
                        <div class="portfolio-info">
                            <h4>{{ $inventory->element->name }}</h4>
                            <p>{{ $inventory->element->price }}</p>
                            <div class="details-link"><i class="bx bx-plus"></i></div>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>

    </div>
</section><!-- End Portfolio Section -->

{{-- Script para desplazamiento de la barra categorias --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('portfolio-flters-container');
        const scrollStep = 200;

        document.querySelector('.scroll-prev').addEventListener('click', function() {
            container.scrollLeft -= scrollStep;
        });

        document.querySelector('.scroll-next').addEventListener('click', function() {
            container.scrollLeft += scrollStep;
        });
    });
</script>

    <!-- End Portfolio Section -->
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
    
    
