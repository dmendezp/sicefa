@extends('agroindustria::layouts.master')
@section('content')
    


    <section class="carousel_info">
    <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="{{ asset('modules/agroindustria/img/PhotoReal_Industria_de_alimentos_2.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A G R O I N D U S T R I A</h5>
                    <br>
                    <br>
                    <p>Bienvenidos a nuestra página web de agroindustria, donde fusionamos la tradición agrícola con la innovación
                         culinaria. Aquí, llevamos a cabo el procesamiento de alimentos de la más alta calidad, utilizando métodos
                          sostenibles y tecnología de vanguardia. Nuestra misión es no solo ofrecer productos agroindustriales 
                          excepcionales, sino también empoderar a las personas con conocimientos y habilidades para que puedan 
                          aprender a realizar estos procesos por sí mismas. Explora nuestro mundo de sabores naturales y 
                          descubre cómo puedes unirte a nuestra comunidad apasionada por la agroindustria y la cocina.</p>

                       <p>un espacio diseñado para satisfacer a todo tipo de público. Aquí encontrarás una amplia variedad 
                        de alimentos procesados cuidadosamente seleccionados y elaborados por expertos en la agroindustria.
                         Desde deliciosas conservas hasta productos horneados artesanales, nuestra plataforma ofrece una 
                         gama diversa que seguramente complacerá a los amantes de la comida de todo el mundo. Además, 
                         si deseas llevar tu experiencia culinaria al siguiente nivel, también te ofrecemos 
                         recetas detalladas y consejos expertos para que puedas realizar estos procesos en la comodidad de tu hogar.
                          ¡Explora, descubre y disfruta de la versatilidad de la agroindustria en un solo lugar!</p>
                </div>
            </div>
            <div class="carousel-item">
            <img src="{{ asset('modules/agroindustria/img/PhotoReal_cocineros_1.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>N O S O T R O S</h5>
                    <br>
                    <br>
                    <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha 
                    sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona
                     que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer 
                     un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en 
                     documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación
                      de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de
                       autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>

                       <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha 
                    sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona
                     que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer 
                     un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en 
                     documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación
                      de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de
                       autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
            </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('modules/agroindustria/img/PhotoReal_Industria_de_alimentos_3.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>N O S E Q P O N E R</h5>
                    <br>
                    <br>
                    <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha 
                    sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona
                     que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer 
                     un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en 
                     documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación
                      de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de
                       autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>

                       <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha 
                    sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona
                     que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer 
                     un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en 
                     documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación
                      de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de
                       autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
            </div>
        </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
            </section>

    <section>
        
    </section>
           
           
    <footer>
        <div class="container">
            <div class="footer-content">

                
                <div class="footer-div">
                    <div class="social-media">

                         <h4>Mas Informacion</h4>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fab fa-telegram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-facebook-square"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </li>
                        </ul>
                    </div>
                    
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <script>

        const selectElement = function(element) {
            return document.querySelector(element);
        }


        let menuToggle = selectElement('.inicio-to');
        let body = selectElement('body');

        menuToggle.addEventListener('click', function(){
            body.classList.toggle('open');
        })

    </script>
@endsection