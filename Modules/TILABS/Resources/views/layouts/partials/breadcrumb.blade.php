    <div class="content-header">
        <div class="container-fluid">
            <div id="divbreadcrumb" class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">TI-LABS</li>
                        <li class="breadcrumb-item active">{{ $view['titleView'] }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @if (Session::has('message'))
        <div class="container">
            <div class="alert alert-{{ Session::get('typealert') }}" style="display:block; margin-bottom: 16px;">
                {{ Session::get('message') }}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @if (Session::has('message'))
            @foreach (old() as $k => $o)
                <input type="hidden" class="old" id="{{ $k }}" value="{{ old($k) }}">
            @endforeach

            <script type="text/javascript">
                window.onload = function() {
                    {{ Session::get('scriptJS') }}
                }
            </script>
        @endif
    @endif
