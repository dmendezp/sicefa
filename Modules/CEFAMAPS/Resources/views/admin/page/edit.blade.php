@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::page.Breadcrumb_Pages') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.page.index') }}"><i
                class="fas fa-regular fa-file-lines"></i> {{ trans('cefamaps::page.Breadcrumb_Active_Pages') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::page.Breadcrumb_Active_Edit_Pages') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i>{{ $editpage->id }}</i> {{ $editpage->name }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::page.Title_Card_Edit_Page') }}</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('cefamaps.admin.config.page.edit') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editpage->id }}">
                                <div class="row align-items-start">
                                    <!-- inicio del nombre -->
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">{{ trans('cefamaps::page.Label_Name_Page') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $editpage->name }}">
                                        </div>
                                    </div>
                                    <!-- fin del nombre -->
                                    <!-- inicio de los id de los environments -->
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="environ">{{ trans('cefamaps::page.Label_Name_Environment_Page') }}</label>
                                            {!! Form::select('environment_id', $environ, $editpage->environment_id, [
                                                'class' => 'form-control',
                                                'placeholder' => 'Seleccione...',
                                                'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <!-- fin de los id de los environments -->
                                </div>
                                <!-- inicio de agregar el contenido -->
                                <div class="form-group">
                                    <label for="content">{{ trans('cefamaps::page.Label_Name_Content_Page_N') }}</label>
                                    <textarea id="summernote" name="content">
                    {{ $editpage->content }}
                  </textarea>
                                </div>
                                <!-- fin de agregar el contenido -->
                                <!-- inicio del boton de guardar -->
                                <div class="d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::page.Btn_Edit_Page') }}</button>
                                </div>
                                <!-- fin del boton de guardar -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#summernote').summernote({
                height: 300,
            })
        });
    </script>
@endsection
