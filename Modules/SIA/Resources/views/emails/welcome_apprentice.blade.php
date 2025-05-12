<p>Hola, {{ $user->person->first_name ?? $user->nickname }},</p>

<p>¡Bienvenido al Sistema de Investigación Académica (S.I.A.)!</p>

<p>Hemos creado una cuenta para ti con las siguientes credenciales:</p>
<ul>
    <li><strong>Correo:</strong> {{ $user->email }}</li>
    <li><strong>Contraseña:</strong> {{ $password }}</li>
</ul>

<p>Por favor, inicia sesión en <a href="{{ url('/login') }}">S.I.A.</a> y cambia tu contraseña lo antes posible.</p>

<p>Si necesitas ayuda, contáctanos en soporte@sia.edu.co.</p>

<p>Saludos,<br>Equipo S.I.A.</p>