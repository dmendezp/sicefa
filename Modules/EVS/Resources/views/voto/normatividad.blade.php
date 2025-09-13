@extends('evs::layouts.master')

@section('title', 'Normatividad')

@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('cefa.evs.voto.normatividad') }}">
            <i class="far fa-file-alt"></i> {{ __('Normativity') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="content py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow border-0 rounded-lg">
                        <div class="card-header text-center rounded-top" style="background-color: #6f42c1;">
                            <h4 class="mb-0 font-weight-bold text-white">{{ __('Normativity') }}</h4>
                        </div>

                        
                        <div class="card-body px-4 py-5">
                  
                            <h4 class="text-center font-weight-bold text-primary mb-4">
                                Acuerdo 009 de 2024
                            </h4>
                         
                            <p class="text-justify mb-4">
                                Dentro del Reglamento de Aprendiz Acuerdo 009 de 2024, Capítulo II, artículo 7
                                <strong>Representatividad de los aprendices</strong>, refiere la representatividad como una
                                estrategia
                                institucional, siendo un ejercicio democrático, participativo, plural y flexible que permite
                                la participación libre y espontánea de los aprendices en formación laboral o tecnológica,
                                para responder adecuadamente a las necesidades de las poblaciones, fortaleciendo el
                                bienestar integral de nuestros aprendices.
                                La representatividad se materializa mediante tres rutas:
                            </p>

                            
                            <ul class="list-group list-group-flush mb-5">
                                <li class="list-group-item">
                                    <strong>1.</strong> Elección de representantes de aprendices de los centros de formación
                                    por jornada y modalidad, esta estrategia permite elegir y ser elegido mediante voto.
                                </li>
                                <li class="list-group-item">
                                    <strong>2.</strong> Elección de voceros de grupos de formación.
                                </li>
                                <li class="list-group-item">
                                    <strong>3.</strong> Elección de voceros de las poblaciones identificadas con enfoque
                                    diferencial en cada centro de formación.
                                </li>
                            </ul>

                            
                            <div class="text-center my-4">
                                <h5 class="text-primary font-weight-bold">
                                    Elección de representantes:
                                </h5>
                            </div>

                            <p class="text-justify mb-4">
                                Una elección es el medio a través del cual se hacen efectivos los derechos políticos de los
                                ciudadanos de elegir y ser elegidos. Es el proceso de toma de decisiones democrático en el
                                que los ciudadanos votan por una opción ante una pregunta de carácter relevante, o por los
                                candidatos inscritos en la contienda.
                            </p>

                          
                            <h5 class="font-weight-bold text-primary mt-5 mb-3">
                                Elecciones representantes de aprendices
                            </h5>

                            <h6 class="font-weight-bold mb-2">
                                Requisitos y procedimiento para ser Representante de los aprendices del centro de formación
                                profesional
                            </h6>

                            <p class="mb-3">
                                El aprendiz que desee postularse como representante, deberá de reunir los siguientes
                                requisitos:
                            </p>

                            
                            <ul class="list-unstyled pl-4 mb-5">
                                <li class="mb-2"><strong>A.</strong> Acreditar registro académico “en formación” en los
                                    niveles técnico o tecnólogo en etapa lectiva.</li>
                                <li class="mb-2"><strong>B.</strong> No haber cursado más de (3) tres trimestres en su
                                    programa de formación (9 meses).</li>
                                <li class="mb-2"><strong>C.</strong> Postularse para la modalidad y jornada en la que está
                                    cursando su programa.</li>
                                <li class="mb-2"><strong>D.</strong> Diligenciar el formulario de inscripción habilitado
                                    para tal fin.</li>
                                <li class="mb-2"><strong>E.</strong> No presentar sanciones disciplinarias, ni académicas
                                    durante el programa de formación que cursa actualmente.</li>
                                <li class="mb-2"><strong>F.</strong> Tener aprobados todos los resultados de aprendizaje y
                                    competencias según ruta de aprendizaje, al momento de postularse.</li>
                                <li class="mb-2"><strong>G.</strong> No ser servidor público del SENA, como tampoco estar
                                    postulándose a un cargo de elección popular.</li>
                                <li class="mb-2"><strong>H.</strong> Presentar una propuesta programática que debe
                                    proyectarse en el marco de los principios, valores y procederes éticos institucionales,
                                    teniendo en cuenta el Reglamento del Aprendiz, el Plan Nacional Integral de Bienestar al
                                    Aprendiz y el Plan de Acción de Bienestar al Aprendiz del centro de formación
                                    profesional.</li>
                            </ul>

                            
                            <h6 class="font-weight-bold text-primary mb-3">
                                Periodo de representación como Representantes de aprendices
                            </h6>

                            <p class="text-justify mb-4">
                                El periodo de representación de los aprendices del centro de formación profesional integral,
                                electos será el tiempo que va desde el momento en que queda suscrita la resolución de
                                designación y hasta el momento en el cual se designe un nuevo representante. En ningún caso
                                el representante ejercerá su rol por un periodo superior a dieciocho (18) meses.
                            </p>

                            <p class="text-justify mb-4">
                                En caso de que el representante de aprendiz culmine su etapa lectiva antes del periodo
                                determinado para ser representante y en caso de no existir representante suplente, este será
                                elegido en reunión de voceros de la jornada o la modalidad correspondiente quienes
                                postularán sus candidatos, entre ellos se hará una votación cerrada con la observación del
                                comité electoral. Se deberá llevar estricto registro por medio de acta del desarrollo de la
                                reunión y se debe generar el acto administrativo, el cual debe ser informado al grupo de
                                Bienestar al Aprendiz y Atención al Egresado o que haga sus veces de la Dirección de
                                Formación Profesional.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
