@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3>{{ $view['titleView'] }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="apprentices_table">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Nombre Completo</th>
                        <th>Correo Personal</th>
                        <th>Teléfono</th>
                        <th>Curso</th>
                        <th>Estado</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#apprentices_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sia.admin.human_talent.apprentice.data') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'document', name: 'document' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'telephone', name: 'telephone' },
                { data: 'course', name: 'course' },
                { data: 'status', name: 'status' },
            ]
        });
    });
</script>
@endpush
