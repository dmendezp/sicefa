@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('cefamaps.admin.dashboard') }}">
            <i class="fas fa-solid fa-user-tie"></i>
                {{ trans('cefamaps::sector.Breadcrumb_Sector') }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('cefamaps.admin.config.sector.index') }}">
            <i class="fas fa-solid fa-vector-square"></i> {{ trans('cefamaps::sector.Breadcrumb_Active_Sector') }}
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
                            <h3 class="m-0">{{ trans('cefamaps::sector.Title_Card_Sectors') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('cefamaps::sector.1T_Number') }}</th>
                                            <th>{{ trans('cefamaps::sector.1T_Name') }}</th>
                                            <th>{{ trans('cefamaps::sector.1T_Description') }}</th>
                                            <th>
                                                <a href="{{ route('cefamaps.admin.config.sector.add') }}"
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-square-plus"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sector as $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{ $s->name }}</td>
                                                <td>{{ $s->description }}</td>
                                                <td>
                                                    <a href="{{ url('/cefamaps/sector/edit/' . $s->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-map-signs"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-sector" href="#" type="submit"
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
            $(document).on("click", ".delete-sector", function() {
                var id = $(this).data('object');
                var url = "{{ url('/cefamaps/sector/delete/') }}/" + id;
                Swal.fire({
                    title: '{{ trans('cefamaps::sector.delete_alert_title') }}',
                    text: '{{ trans('cefamaps::sector.delete_alert_text') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ trans('cefamaps::sector.Btn_Accept') }}',
                    cancelButtonText: '{{ trans('cefamaps::sector.Btn_Cancel') }}'
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
