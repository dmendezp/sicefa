@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::sector.Breadcrumb_Sector') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.sector.index') }}"><i
                class="fas fa-solid fa-vector-square"></i> {{ trans('cefamaps::sector.Breadcrumb_Active_Sector') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-square-plus"></i> {{ trans('cefamaps::sector.Breadcrumb_Active_Add_Sector') }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::sector.Title_Card_Add_Sector') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <form action="{{ route('cefamaps.admin.config.sector.add') }}" method="post">
                                    @csrf
                                    <!-- inicio del nombre -->
                                    <div class="form-group">
                                        <label for="name">{{ trans('cefamaps::sector.Label_Name_Sector') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <!-- fin del nombre -->
                                    <!-- inicio de la descripcion -->
                                    <div class="form-group">
                                        <label for="description">{{ trans('cefamaps::sector.Label_Description_Sector') }}</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            required>
                                    </div>
                                    <!-- fin de la descripcion -->
                                    <!-- inicio del boton -->
                                    <div class="d-grip gap-2">
                                        <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">
                                            {{ trans('cefamaps::sector.Btn_Add_Sector') }}
                                    </div>
                                    <!-- fin del boton -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
