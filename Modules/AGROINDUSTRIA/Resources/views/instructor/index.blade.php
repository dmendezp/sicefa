@extends('agroindustria::layouts_instructor.master_instructor')

@section('content')
    


    <section class="ganaderia" id="ganaderia">
        <div class="container">
            <h2 class="h2-sub1">
                <span class="fil">B</span>ienvenid@s a 
            </h2>
            <h1 class="head">Datagro</h1>
        </div>
            </section>

    <section>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <center>
            <div class="card mb-3" >
                <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset('agroindustria/img/foto1.jpg')}}" class="img-fluid rounded-start" alt="...">
                        </div>
                     <div class="col-md-8">
                <div class="card-body">
                        <h1 class="card-title">Nosotros</h1>
                        <p class="card-text">TLorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown 
                        printer took a galley of type and scrambled it to make a type specimen book. It has survived 
                        not only five centuries, but also the leap into electronic typesetting, remaining essentially
                        unchanged.</p>
                </div>
            </div>
        </div>
</div>
<br>
            </center>
    
    </div>
    </div>
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