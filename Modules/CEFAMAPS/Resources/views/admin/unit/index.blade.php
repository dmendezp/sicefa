@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::unit.Breadcrumb_Unit') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.unit.index') }}"><i
                class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::unit.Breadcrumb_Active_Unit') }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::unit.Title_Card_Units') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('cefamaps::unit.1T_Number') }}</th>
                                            <th>{{ trans('cefamaps::unit.1T_Name') }}</th>
                                            <th>{{ trans('cefamaps::unit.1T_Person_Charge') }}</th>
                                            <th>{{ trans('cefamaps::unit.1T_Sector') }}</th>
                                            <th>{{ trans('cefamaps::unit.1T_Farm') }}</th>
                                            <th>{{ trans('cefamaps::unit.1T_Description') }}</th>
                                            <th>{{ trans('cefamaps::unit.1T_Icon') }}</th>
                                            <th>
                                                <a href="{{ route('cefamaps.admin.config.unit.add') }}"
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-square-plus"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unit as $u)
                                            <tr>
                                                <td>{{ $u->id }}</td>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->person->full_name }}</td>
                                                <td>{{ $u->sector->name }}</td>
                                                <td>{{ $u->farm->name }}</td>
                                                <td>{{ $u->description }}</td>
                                                <td>
                                                    <i class="{{ $u->icon }}"></i>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/cefamaps/unit/edit/' . $u->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-map-signs"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-unit" href="#" type="submit"
                                                        data-action="delete" data-object="{{ $u->id }}"
                                                        data-path="/cefamaps/unit/delete/">
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
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-unit", function() {
                var id = $(this).data('object');
                var url = "{{ url('/cefamaps/unit/delete/') }}/" + id;
                Swal.fire({
                    title: '{{ trans('cefamaps::unit.Title_Alert') }}',
                    text: '{{ trans('cefamaps::unit.Text_Alert') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ trans('cefamaps::unit.Btn_Accept') }}',
                    cancelButtonText: '{{ trans('cefamaps::unit.Btn_Cancel') }}'
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
