    <div class="content-header">
        <div class="container-fluid">
            <div id="divbreadcrumb" class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">SICA</li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @if (Session::has('message'))
        <div class="container">
            <div class="alert alert-{{ Session::get('typealert') }} py-1" style="display:block; margin-bottom: 16px;">
                {!! Session::get('message') !!}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
