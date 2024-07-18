@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::class.Breadcrumb_Class') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.class.index') }}"><i
                class="fas fa-solid fa-vector-square"></i> {{ trans('cefamaps::class.Breadcrumb_Active_Class') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::class.Breadcrumb_Active_Edit_Class') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i>{{ $editclass->id }}</i> {{ $editclass->name }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::class.Title_Card_Edit_Class') }} {{ $editclass->name }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <form action="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.class.update') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $editclass->id }}">
                                    <!-- inicio del nombre -->
                                    <div class="form-group">
                                        <label for="name">{{ trans('cefamaps::class.Label_Name_Class') }}</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $editclass->name }}" required>
                                    </div>
                                    <!-- fin del nombre -->
                                    <!-- inicio del boton de agregar -->
                                    <div class="d-grip gap-2">
                                        <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">
                                            {{ trans('cefamaps::class.Edit_Edit_Class') }}
                                        </button>
                                    </div>
                                    <!-- fin del boton de agregar -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
