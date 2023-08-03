@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-orange card-outline shadow col-md-6">
                <div class="card-header">
                    <h3 class="card-title">Agregar Usuarios</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{ route('sica.admin.security.user.add') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="document_number" class="col-md-4 col-form-label text-md-right">{{ __('Document number') }}</label>
                            <div class="input-group col-md-6">
                                <input id="document_number" type="text" class="form-control" name="document_number" value="{{ old('document_number') }}" required autocomplete="document_number" autofocus>
                                <span class="input-group-append">
                                <button id="btnSearch" type="button" class="btn btn-info "><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div id="divperson">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

</script>
@endsection    
