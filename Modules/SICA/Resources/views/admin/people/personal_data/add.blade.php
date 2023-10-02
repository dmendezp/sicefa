@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="card card-orange card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Agregar Datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body box-profile">
                    {!! Form::open(['url' => route('sica.admin.people.personal_data.add')]) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="text-left">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('sica/images/blanco.png') }}" alt="User profile picture">
                                    <br />
                                    {!! Form::file('avatar', ['class' => 'form-control-file', ' aria-label' => 'file
                                    example']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Timelime example  -->

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Primer nombre</label>
                                {!! Form::text('first_name', null,
                                ['class' => 'form-control', 'placeholder' => 'Ingrese su primer nombre','required']) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label>Primer Apellido</label>
                                {!! Form::text('first_last_name', null,
                                ['class' => 'form-control', 'placeholder' => 'Ingrese su primer apellido','required']) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label>Segundo Apellido</label>
                                {!! Form::text('second_last_name', null,
                                ['class' => 'form-control', 'placeholder' => 'Ingrese su segundo apellido','required']) !!}
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tipo documento *</label>
                                {!! Form::select('document_type', getEnumValues('people', 'document_type','required'),
                                null,['class' => 'form-control']
                                ,['placeholder' => 'Pick a size...']) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label>Documento</label>
                                {!! Form::number('document_number',$doc, ['class' => 'form-control', 'placeholder'
                                =>
                                'Documento','required'])
                                !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Fecha de expedición</label>
                                {!! Form::date('date_of_issue',null, ['class' => 'form-control'])
                                !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Fecha de nacimiento</label>
                                {!! Form::date('date_of_birth',null, ['class' => 'form-control'])
                                !!}
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Tipo de sangre</label>
                                {!! Form::select('blood_type',getEnumValues('people', 'blood_type'),null, ['class' =>
                                'form-control','placeholder' => 'Selecciona...'])
                                !!}
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label>Genero</label>
                                {!! Form::select('gender',getEnumValues('people', 'gender'),'No registra', ['class' =>
                                'form-control'])
                                !!}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Eps</label>
                                {!! Form::select('eps_id',$eps, [],['class' => 'form-control'
                                ,'placeholder' => 'Selecciona...','required']) !!}
                                {{-- {{$people}} --}}

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Estado civil</label>
                                {!! Form::select('marital_status', getEnumValues('people', 'marital_status'),
                                null,['class' => 'form-control'
                                ,'placeholder' => 'Selecciona...']) !!}

                                </select>
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label>Tarjeta militar</label>
                                {!! Form::text('military_card', null,['class' => 'form-control'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Estrato social</label>
                                {!! Form::select('socioeconomical_status',getEnumValues('people', 'socioeconomical_status'),
                                null,['class' => 'form-control']
                                ,['placeholder' => 'Pick a size...']) !!}

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Dirección</label>
                                {!! Form::text('address', null,['class' => 'form-control' ,'placeholder' =>
                                'Dirección'])
                                !!}

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label>Celular</label>
                                {!! Form::number('telephone1',null, ['class' => 'form-control', 'placeholder' =>'Ingrese un numero de telefono']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email</label>
                                {!! Form::email('email', null,['class' => 'form-control','required'] ) !!}

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Misena Email</label>
                                {!! Form::email('misena_email', null,['class' => 'form-control'] ) !!}

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Grupo poblacional</label>
                                {!! Form::select('population_group_id', $population_groups, null,['class' =>
                                'form-control'
                                ,'placeholder' => 'Seleccione...','required']) !!}

                                </select>
                            </div>
                        </div>
                        {!! Form::submit('Registrar',['class' => 'btn btn-success'] ) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection