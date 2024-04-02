<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
    <img src="{{ asset('general/images/logosicefa.png') }}" alt="">
    <div class="card">
        <div class="card-header">
            <h2>Solicitud de Usuario</h2>
        </div>
        <div class="card-body">
            <h3>Usuario : {{ $email }}</h3>
            <h3>Contraseña: {{ $password }}</h3>
            
        </div>
    </div>
</div>


