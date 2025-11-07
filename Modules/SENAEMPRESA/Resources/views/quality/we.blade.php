@extends('senaempresa::layouts.master')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-8">CENTRO DE FORMACIÓN AGROINDUSTRIAL "LA ANGOSTURA"!</h1>
            <p class="lead">El Centro de Formación Agroindustrial del Huila tiene como función principal
                impartir
                formación profesional integral con calidad a todos los Colombianos; con el fin de desarrollar
                competencias laborales que permitan la inserción laboral del personal no vinculado en el sector
                productivo y la cualificación del talento humano en las empresas. De igual forma articula
                entidades
                y procesos para contribuir con el desarrollo económico de la Región.</p>
        </div>
    </div>

    <br>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div class="my-card"> <img class="my-card-img"
                        src="{{ asset('modules/senaempresa/images/produccion_agricola.jpg') }}" />
                    <div class="my-card-body trainer-card-body">
                        <h5>Tecnologo en Producción Agrícola</h5>
                        <p>Planificar, organizar y supervisar el proceso de siembra, cultivo,
                            riego,
                            fertilización y cosecha de diferentes tipos de cultivos, como cereales, hortalizas,
                            frutas, entre otros.</p><br>
                        <a href="#" class="my-card-btn">More</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="my-card"> <img class="my-card-img"
                        src="{{ asset('modules/senaempresa/images/Gestión_Empresas_Agropecuarias.jpg') }}" />
                    <div class="my-card-body trainer-card-body">
                        <h5>Tecnologo en Gestión de Empresas Agropecuarias
                        </h5>
                        <p>Gestionar eficientemente los recursos disponibles en las
                            explotaciones agropecuarias, como tierras, agua, insumos, maquinaria y personal,
                            para maximizar la productividad y rentabilidad.</p><br>
                        <a href="#" class="my-card-btn">More</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="my-card"> <img class="my-card-img"
                        src="{{ asset('modules/senaempresa/images/Acuicultura.jpg') }}" />
                    <div class="my-card-body trainer-card-body">
                        <h5>Tecnologo en Acuicultura
                        </h5>
                        <p>Vigilar la salud de los animales acuáticos, detectar y prevenir
                            enfermedades, y aplicar tratamientos adecuados cuando sea necesario.</p><br>
                        <a href="#" class="my-card-btn">More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="my-card"> <img class="my-card-img"
                        src="{{ asset('modules/senaempresa/images/Ambiental.jpg') }}" />
                    <div class="my-card-body trainer-card-body">
                        <h5>Tecnologo en Control Ambiental</h5>
                        <p>Realizar seguimiento y análisis de parámetros ambientales como
                            calidad del aire, calidad del agua, niveles de ruido, contaminación del suelo, entre
                            otros, para evaluar el estado del medio ambiente.</p><br>
                        <a href="#" class="my-card-btn">More</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="my-card"> <img class="my-card-img"
                        src="{{ asset('modules/senaempresa/images/Alimentos.jpg') }}" />
                    <div class="my-card-body trainer-card-body">
                        <h5>Tecnologo en Control de Calidad de Alimentos</h5>
                        <p>Realiza pruebas y análisis para evaluar la calidad de los
                            alimentos, desde la materia prima hasta el producto final, asegurándose de que
                            cumplan con los estándares establecidos.</p><br>
                        <a href="#" class="my-card-btn">More</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="my-card"> <img class="my-card-img"
                        src="{{ asset('modules/senaempresa/images/Mercados.jpg') }}" />
                    <div class="my-card-body trainer-card-body">
                        <h5>Tecnologo en Gestión de Mercados</h5>
                        <p> Diseñar planes estratégicos que incluyan la definición de objetivos, segmentación de
                            mercado, posicionamiento y tácticas para alcanzar el éxito comercial.</p><br>
                        <a href="#" class="my-card-btn">More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
