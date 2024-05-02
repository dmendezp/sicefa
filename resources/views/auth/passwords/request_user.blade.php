
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-8">
                <div class="card d-flex mx-auto my-5">
                    <div class="row">
                        
                        <div class="col-md-7 col-sm-12 col-xs-12 c2 px-5 pt-5">
                            <div class="row"> 
                                <a href="{{ route('login', ['redirect' => url()->current()]) }}" ><i class="fa fa-arrow-left fa-2x" ></i></a>
                            </div>
                            <br>
                            <div class="row mb-3 m-3"> 
                                <a href="{{ route('cefa.welcome') }}"><img src="{{ asset('general/images/Group1.png')}}" width="40%" height="auto" alt=""></a> 
                            </div>
                            {!! Form::open(['url' => route('cefa.user.register.store')]) !!}
                            <div class="d-flex">
                                <h3 class="font-weight-bold">Registrarse</h3>
                            </div>
                            <label>Número de documento</label>
                            {!! Form::number('document_number', null, [
                                'class' => 'form-control input',
                                'placeholder' => 'Documento',
                                'id' => 'document_number',
                                'required'
                            ]) !!}
                            <input type="hidden" name="role" id="role">
                            <div class="row">
                                <div class="col-sm-12" >
                                    <br>
                                    <div id="name" class="text-center text-bold"></div>
                                    <br>
                                    <div id="rol" class="text-center text-bold"></div>
                                    <br>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                {!! Form::submit('Solicitar Usuario', ['class' => 'btn btn-primary bt', 'id' => 'solicitar', 'disabled' => 'disabled']) !!}
                            </div>
                        {!! Form::close() !!}
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12 c1 p-3">
                            <div id="hero" class="bg-transparent h-auto order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                                <img class="img-fluid animated"
                                src="{{ asset('general/images/Daco_227767.png')}}"
                                alt="">
                            </div>
                            <div class="row justify-content-center">
                                <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                    <h1 class="wlcm">Solicitar Usuario</h1> <span class="sp1"> <span
                                            class="px-3 bg-danger rounded-pill"></span> <span
                                            class="ml-2 px-1 rounded-circle"></span> <span
                                            class="ml-2 px-1 rounded-circle"></span> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#document_number').on('change', function() {
            var document_number = $(this).val();
            var role = $('#role').val();

            if (document_number) {
                $.ajax({
                    url: '{{ route('cefa.user.register.searchperson') }}',
                    method: 'GET',
                    data: {
                        document_number: document_number,
                        role: role
                    },
                    success: function(response) {
                        $('#name').text('');
                        $('#rol').text('');

                        $('#solicitar').prop('disabled', true);

                        if (response.person && response.rol) {
                            $('#name').text(response.person.first_name + ' ' + response.person.first_last_name + ' ' + response.person.second_last_name);

                            if (response.rol == 'Instructor') {
                                $('#rol').text('Rol : Instructor');
                                $('#solicitar').prop('disabled', false)
                            } else if (response.rol == 'Aprendiz') {
                                $('#rol').text('Rol : Aprendiz');
                                $('#solicitar').prop('disabled', false)
                            } else {
                                $('#rol').text('No eres instructor o aprendiz');
                                $('#solicitar').prop('disabled', true)
                            }
                        }
                        

                        if (response.error) {
                            $('#solicitar').prop('disabled', true);
                            $('#name').text(response.error);

                        }
                        
                        $('#role').val(response.rol);
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
            } else {
                
            }
        });
    });
</script>


