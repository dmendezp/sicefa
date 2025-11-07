@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.dashboard') }}">
            <i class="fas fa-solid fa-user-tie"></i>
                {{ trans('cefamaps::class.Breadcrumb_Class') }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.class.index') }}">
            <i class="fas fa-solid fa-vector-square"></i> {{ trans('cefamaps::class.Breadcrumb_Active_Class') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::class.Title_Card_Class') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('cefamaps::class.1T_Number') }}</th>
                                            <th>{{ trans('cefamaps::class.1T_Name') }}</th>
                                            <th>
                                                <a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.class.add') }}"
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-square-plus"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classenviron as $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{ $s->name }}</td>
                                                <td>
                                                    <a href="{{ url('/cefamaps/' . getRoleRouteName(Route::currentRouteName()) . '/class/edit/' . $s->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-map-signs"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-class" href="#" type="submit"
                                                        data-action="delete" data-object="{{ $s->id }}"
                                                        data-path="/cefamaps/farm/delete/">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-class", function() {
                var id = $(this).data('object');
                var url = "{{ url('/cefamaps/' . getRoleRouteName(Route::currentRouteName()) . '/class/delete/') }}/" + id;
                Swal.fire({
                    title: '{{ trans('cefamaps::class.delete_alert_title') }}',
                    text: '{{ trans('cefamaps::class.delete_alert_text') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ trans('cefamaps::class.Btn_Accept') }}',
                    cancelButtonText: '{{ trans('cefamaps::class.Btn_Cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url
                    }
                })
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                order: [
                    [3, 'desc']
                ],
            });
        });
    </script>
@endsection
