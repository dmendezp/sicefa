@extends('pqrs::layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Seguimiento PQRS</h3>
                </div>
                <div class="card-body">
                    <table id="tracking" class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Numero Radicación</th>
                                <th>NIS</th>
                                <th>Fecha Radicación</th>
                                <th>Fecha limite respuesta</th>
                                <th>Asunto</th>
                                <th>Cod Dep Responsable</th>
                                <th>Funcionario</th>
                                <th>Estado</th>
                                <th>Acciones 
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPQRS">
                                        <i class="fas fa-plus-circle fa-fw"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pqrs as $p)      
                                <tr>
                                    <td>{{ $p->filing_number }}</td>
                                    <td>{{ $p->nis }}</td>
                                    <td>{{ $p->filing_date }}</td>
                                    <td>{{ $p->end_date }}</td>
                                    <td>{{ $p->type_pqrs_id }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $p->state }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pqrs::tracking.create')

@endsection

@section('script')
<script>
   $("#tracking").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
</script>

<script>
    $(document).ready(function() {
        var baseUrl = '{{ route("pqrs.tracking.searchOfficial") }}';
        const responsibleSelect = document.querySelectorAll('.responsible');
        
        $(responsibleSelect).select2({
            placeholder: 'Ingrese numero de documento',
            minimumInputLength: 3,
            ajax: {
                url: baseUrl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection