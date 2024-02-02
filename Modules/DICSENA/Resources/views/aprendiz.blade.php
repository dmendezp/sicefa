@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex flex-row justify-content-start">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        <i class="fas fa-globe"></i> DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ route('cefa.welcome') }}" class="dropdown-item">Return to SICEFA</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.home.index') }}" style="color: white;">Translator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.guide')}}" style="color: white;">Guide</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.gloss')}}" style="color: white;">Glossary</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.aprendiz') }}" data-toggle="tooltip" data-placement="top" data-title="¿Necesitas ayuda en el uso?" data-color="#ffffff" style="color: white;">
                        <i class="fas fa-book-open"></i> Help
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if(Auth::user())
                @if(Auth::user()->havePermission('dicsena.instructor.menu'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}" style="color: white;">Panel</a>
                </li>
                @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
<div>
    <h2><a href="">Module DICSENA Manual de Usuario</a></h2>
</div>

<div>
    <h2><a>DICSENA Panel de funciones para el aprendiz</a></h2>
</div>

<div>
    <h3>Click on highlight(Hay 3 opciones )</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/275c4a2c-2dbe-4945-a1e2-63902933bdb8/8f71f450-18ed-4e65-b06a-9020eb6d0ea1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.0845&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=34&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9ODgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
</div>

<div>
    <h3>1. Click on Traductor(Contiene la vista de traductor)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/7bbd0a7f-d617-4e34-a5c4-41a12ae9282a/e4f1edb9-0092-4023-868a-178984112ae8.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1612&fp-y=0.2181&fp-z=2.5667&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=358&mark-y=326&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0yNzYmaD0xNTImZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Traductor" />
</div>

<div>
    <h3>2. Type "hola"(Escribimos lo que se desea traducir)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/35377bf1-75b1-4056-b2b8-071bf362cee5/56b061e3-8ec0-4296-a73b-51871d044d62.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.3213&fp-y=0.3303&fp-z=1.4361&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=238&mark-y=153&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02MzImaD00NTgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;hola&quot;" />
</div>

<div>
    <h3>3. Click on Amárico…</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/b8aac717-5791-45cb-9286-c85c2e4ba65f/f4cb438a-9456-40d9-be08-a68a59e98632.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.4501&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=110&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9NTg1JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Amárico…" />
</div>

<div>
    <h3>4. Click on Traducir el Texto(Pulsamos el boton de traducir texto)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/32980627-06e9-4af4-8446-a782e922a8a4/ebacb4c7-e5b5-4755-b0d8-507ee1048e08.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.7204&fp-z=1.1601&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=95&mark-y=499&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDA5Jmg9ODkmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Traducir el Texto" />
</div>

<div>
    <h3>5. Click on Amárico…(Nos mostrara el resultado)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/6ce7a373-a249-4d7f-9d1d-7f1713703d8c/b28395bf-f0fa-46ef-8ef5-c57135fceec1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.4501&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=110&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9NTg1JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Amárico…" />
</div>
<div>
    <h3>6. Click on highlight(Este boton nos permitira cambiar el idioma a traducir)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/dc4dd4ae-accc-4ce4-a835-346502126bae/3d60be36-0b25-4378-b954-e3dd917de034.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.5730&fp-z=2.9685&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=556&mark-y=358&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz04OCZoPTg4JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
</div>
<h1>Como buscar una guia</h1>
<div>
    <h3>1. Click on highlight(Presionamos el menu de opciones)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/6039e392-b171-4431-8404-b85442dd6431/870374e8-a05c-47d2-ace0-842d9a871705.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.0845&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=34&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9ODgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
</div>

<div>
    <h3>2. Click on Guia(Escogemos guia)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/fafac8ee-a85c-4b51-a441-7ff9e64c4896/67c64cc1-ad59-4640-a69c-e2fe12df52a3.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4912&fp-y=0.2796&fp-z=1.1317&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=91&mark-y=221&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDE4Jmg9NjcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Guia" />
</div>

<div>
    <h3>3. Select ACUICULTURA from Selecciona un programa:(Se filtra acuicultura)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/56a62fcd-696e-49ae-b970-484b7b2f0dc1/c732a3f2-60cf-45d5-b35b-d5bc4ff4a43c.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.2535&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=269&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD04NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select ACUICULTURA from Selecciona un programa:" />
</div>

<div>
    <h3>4. Click on Filtrar(Al no tener datos no mostrara informacion)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/78822fe2-1cf8-45c1-9c71-370d0ebd7c59/29c41f04-92e8-42b5-9b32-57c3fd1bdd67.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.3794&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=344&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD0xMTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Filtrar" />
</div>

<div>
    <h3>5. Select AGROBIOTECNOLOGÍA from Selecciona un programa:(Elegimos otra opcion)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/bed808ec-781a-4f80-a0e3-c7eb71153ece/97c29451-72f2-474f-83a8-5d1d00f515b5.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.2535&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=269&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD04NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select AGROBIOTECNOLOGÍA from Selecciona un programa:" />
</div>

<div>
    <h3>6. Click on Filtrar(Presionamos filtrar)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/5c117fb7-67e1-47c1-a46c-34e85e57cadb/d6c138e7-d667-4860-896b-0b209c8583fa.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.3794&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=344&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD0xMTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Filtrar" />
</div>

<div>
    <h3>7. Click on Título(En una tabla establecemos valores)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/61a536a5-f5d4-4715-a63c-b9211ec7c500/96cee7fb-f865-40b5-945b-c346ed5363c1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1766&fp-y=0.4777&fp-z=2.3325&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=314&mark-y=330&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0zNjAmaD0xNDQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Título" />
</div>

<div>
    <h3>8. Click on w(Este dato es el titulo)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/98bcf1ed-5d93-4968-8301-c688b89605aa/f6538b7c-a985-4ec7-b771-d83c384a2daa.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1766&fp-y=0.5407&fp-z=2.3325&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=314&mark-y=330&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0zNjAmaD0xNDQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on w" />
</div>

<div>
    <h3>9. Click on Programa(En una tabla establecemos valores)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/d70fddf4-0c72-4a85-ae8d-4c532e275fb0/bd574f29-8a85-494d-a124-1fcda260880f.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.6205&fp-y=0.4777&fp-z=1.7915&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=216&mark-y=347&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03NjgmaD0xMTEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Programa" />
</div>

<div>
    <h3>10. Click on AGROBIOTECNOLOGÍA(Este dato pertenece al nombre del programa)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/ca22c328-1696-4aa6-9364-a021f2bab020/f91ed083-b2d3-4d68-96ea-938e54f5a979.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.6205&fp-y=0.5407&fp-z=1.7915&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=216&mark-y=347&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03NjgmaD0xMTEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on AGROBIOTECNOLOGÍA" />
</div>

<div>
    <h3>11. Click on   |   (Esto representa el campo de visualizar y descargar archivos)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/540b650d-071d-4728-bda9-355ea041090b/bb996bad-1458-41f3-b92f-06307558549e.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.8718&fp-y=0.5407&fp-z=2.6539&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=534&mark-y=320&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz01MTUmaD0xNjQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on    |   " />
</div>
<h1>Como buscar un Glosario</h1>
<div>
    <h3>1. Click on highlight(Pulsamos menu)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/a43720c8-7313-4d15-9a33-e40fb8c57a89/332af700-e952-4090-9b4f-a76e8580898d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.0845&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=34&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9ODgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
</div>

<div>
    <h3>2. Click on Glosario(Selecionamos glosario)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/abd1725f-219d-4e61-a4ce-4c24502c3e78/676fc026-996e-4dd3-8898-a6bde6baca1d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.3410&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=280&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9NjgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Glosario" />
</div>

<div>
    <h3>3. Select ANALISIS Y DESARROLLO DE SOFTWARE from Selecciona un programa:(En la barra de busqueda elegimos el programa)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/19d28bf7-ef78-4d72-b646-68a2aaf7e46b/e57d7388-16a2-431e-b937-16bddfb82714.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.2535&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=269&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD04NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select ANALISIS Y DESARROLLO DE SOFTWARE from Selecciona un programa:" />
</div>

<div>
    <h3>4. Click on Filtrar(Una vez la selecion se pulsa filtrar)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/e1c13a2c-af80-4c62-aeba-a763baf0c1a7/81a938b4-c115-4e89-9266-a8da35f07540.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.3794&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=344&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD0xMTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Filtrar" />
</div>

<div>
    <h3>5. Click on Programa(Esta tabla muestra la informacion)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/e33aa2d0-d2d1-46e0-9938-3d8cb657dfe6/c213bf5d-16c5-4379-9eb1-321d47dce34c.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.7147&fp-y=0.4777&fp-z=1.9114&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=54&mark-y=343&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDkxJmg9MTE4JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Programa" />
</div>

<div>
    <h3>6. Click on ANALISIS Y DESARROLLO DE SOFTWARE(Este es el nombre del programa)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/71948db2-6cd4-4711-af4e-40f29f9d264a/117ee29f-d61f-4459-90f0-992c1542a55f.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.7147&fp-y=0.5407&fp-z=1.9114&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=54&mark-y=343&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDkxJmg9MTE4JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on ANALISIS Y DESARROLLO DE SOFTWARE" />
</div>

<div>
    <h3>7. Click on Traducción(Esta tabla muestra la informacion)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/fbdab6b5-2eb8-4749-a40c-3afe601f3dfb/d351ebbb-bc7f-4a8a-856c-72590ef97b86.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.2430&fp-y=0.4777&fp-z=2.1611&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=389&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz00MjImaD0xMzQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Traducción" />
</div>

<div>
    <h3>8. Click on arrow(Este es el dato de la busqueda)</h3>
    <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/68f174bd-117f-4989-b04d-cb834b37aad5/99bae532-ac42-4de1-9742-9eb0ba0a99f1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.2430&fp-y=0.5407&fp-z=2.1611&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=389&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz00MjImaD0xMzQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on arrow" />
</div>

@endsection