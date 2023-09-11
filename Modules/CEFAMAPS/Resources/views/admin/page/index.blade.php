@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::page.Breadcrumb_Pages') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.page.index') }}"><i
                class="fas fa-regular fa-file-lines"></i> {{ trans('cefamaps::page.Breadcrumb_Active_Pages') }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::page.Title_Card_Pages') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <form action="{{ route('cefamaps.admin.config.page.index') }}" method="get">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('cefamaps::page.1T_Number') }}</th>
                                                <th>{{ trans('cefamaps::page.1T_Page') }}</th>
                                                <th>{{ trans('cefamaps::page.1T_Content') }}</th>
                                                <th>{{ trans('cefamaps::page.1T_Environment') }}</th>
                                                <th>
                                                    <a href="{{ route('cefamaps.admin.config.page.add') }}"
                                                        class="btn btn-success">
                                                        <i class="fa-solid fa-square-plus"></i>
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($final as $r)
                                                <tr>
                                                    <td>{{ $r->id }}</td>
                                                    <td>{{ $r->name }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-default" data-toggle="modal"
                                                            data-target="#modal{{ $r->id }}">
                                                            {{ trans('cefamaps::page.Label_Name_Content_Page_N') }} : {{ $r->id }}
                                                        </button>
                                                        <div class="modal fade" id="modal{{ $r->id }}">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h4 class="modal-title">
                                                                            {{ trans('cefamaps::page.Label_Name_Content_Page_N') }} :
                                                                            {{ $r->id }}</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/rivoakkk.json"
                                                                                trigger="hover"
                                                                                colors="primary:#000000,secondary:#000000"
                                                                                style="width:32px;height:32px"></lord-icon>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{!! $r->content !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $r->environment->name }}</td>
                                                    <td>
                                                        <a href="{{ url('/cefamaps/page/edit/' . $r->id) }}"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-map-signs"></i>
                                                        </a>
                                                        <a class="btn btn-danger delete-page" href="#" type="submit"
                                                            data-action="delete" data-object="{{ $r->id }}"
                                                            data-path="/cefamaps/page/delete/">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
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
            $('#example1').DataTable({
                order: [
                    [3, 'desc']
                ],
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-page", function() {
                var id = $(this).data('object');
                var url = "{{ url('/cefamaps/page/delete/') }}/" + id;
                Swal.fire({
                    title: 'Estas seguro de elimar',
                    text: "Aca no sirve el control Z",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url
                    }
                })
            })
        })
    </script>
@endsection
