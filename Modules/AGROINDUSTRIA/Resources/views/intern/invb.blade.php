@extends('agroindustria::layouts_intern.master_intern')

@section('content')
        
<section class="ganaderia" id="ganaderia">
    <div class="container">
        <h2 class="h2-sub1">
            <span class="fil">B</span>ienvenido
        </h2>
        <h1 class="head">Agroindustria</h1>
        <div class="he-des">
            <h5>Cefa</h5>
        </div>
    </div>
</section>
               
<section class="taste bt">
    <div class="container">
        <div class="global">
            <h1 class="h1">INVENTARIO-BODEGAS</h1>
        </div>
    </div>  
</section>
<section>
    <div class="targets">  
        <div class="elementospp">
            <p> EPP </p> 
            <i class="fa-solid fa-mask-face"></i>    
        </div>
        <div class="insumos">
            <p> INSUMOS </p>
            <i class="fa-solid fa-cubes-stacked"></i>
        </div>
        <div class="env">
            <p> ENVASES </p>
            <i class="fa-solid fa-box-open"></i>                    
        </div>
        <div class="aseo">
            <p> ASEO </p>
            <i class="fa-solid fa-pump-soap"></i>                   
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