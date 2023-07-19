@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal</title>

</head>
<body>
	<section class="banner">
		<div class="banner-content">
			<h1>Bienvenido al software AGROCEFA</h1>	
		</div>
	</section>

    <br>
    <br>
    <br>

    <footer>

        <div class="container__footer">
            <div class="box__footer">
                <div class="logo">
                    <img src="logo-magtimus.png" alt="">
                </div>
                
            </div>
            <div class="box__footer">
                <h2>Soluciones</h2>
                <a href="https://www.google.com">App Desarrollo</a>
                <a href="#">App Marketing</a>
                <a href="#">IOS Desarrollo</a>
                <a href="#">Android Desarrollo</a>
            </div>
    
            <div class="box__footer">
                <h2>Compañia</h2>
                <a href="#">Acerca de</a>
                <a href="#">Trabajos</a>
                <a href="#">Procesos</a>
                <a href="#">Servicios</a>              
            </div>
    
            <div class="box__footer">
                <h2>Redes Sociales</h2>
                <a href="#"> <i class="fab fa-facebook-square"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter-square"></i> Twitter</a>
                <a href="#"><i class="fab fa-linkedin"></i> Linkedin</a>
                <a href="#"><i class="fab fa-instagram-square"></i> Instagram</a>
            </div>
    
        </div>
    
        <div class="box__copyright">
            <hr>
            <p>Todos los derechos reservados © 2023 <b>AGROCEFA</b></p>
        </div>
    </footer>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.1.o.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
@endsection
