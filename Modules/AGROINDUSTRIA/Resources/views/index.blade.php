@extends('agroindustria::layouts.master')
@section('content')
    
    <section class="carousel_info">
    <div id="carouselExampleCaptions" class="carousel slide">
           
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
           
  </div>
</div>
            </section>

    <section>
    <body>
    <a href="{{route('cefa.agroindustria.home.formulations.recipes')}}" class="cardimg">
        <div class="image-container">
        <img class="imgcards" src="{{ asset('modules/agroindustria/img/ProductosAG1.jpg') }}" alt="Imagen 1">
        </div>
        <div class="image-container">
        <img class="imgcards" src="{{ asset('modules/agroindustria/img/ProductosAG2.jpg') }}" alt="Imagen 2">
            <div class="image-text">Haz click en cualquiera de las tarjetas para conocer nuestros productos.</div>
        </div>
        <div class="image-container">
        <img class="imgcards" src="{{ asset('modules/agroindustria/img/ProductosAG3.jpg') }}" alt="Imagen 3">
        </div>
    </a>

</body>
</html>
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