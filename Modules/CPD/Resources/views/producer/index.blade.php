@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">Home</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ $view->titleView }}</h5>
                        </div>
                        <div class="card-body">
                            Contenido de datos de producción en cacao.
                        </div>
                    </div>
                </div> <!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')

@endsection
