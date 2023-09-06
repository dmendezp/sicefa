@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')
@section('content')
    


    <section class="ganaderia" id="ganaderia">
        <div class="container">
            <h2 class="h2-sub1">
                <span class="fil">B</span>ienvenido  
            </h2>
            <h1 class="head">AGROINDUSTRIA</h1>
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