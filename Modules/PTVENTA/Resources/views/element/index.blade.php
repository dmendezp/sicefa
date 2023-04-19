@extends('ptventa::layouts.master')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active">Imagenes</li>
@endsection

@section('content')

<div class="card card-primary card-outline col-9 mx-auto">
    <div class="card-header text-center">
        <a href="{{ route('ptventa.element.gallery') }}" class="btn btn-outline-success btn-sm">
            Ver galería de imágenes
        </a>
    </div>
    <div class="table table-responsive table-sm px-3 py-1">
        <table id="element">
            <thead class="table-dark mt-0 pt-0">
                <tr>
                    <th>Imagenes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $element)
                    <tr>
                        <td>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                          <div class="col-md-4">
                                            <img src="{{ asset($element->image) }}" class="img-fluid rounded-start" alt="...">
                                          </div>
                                          <div class="col-md-6">
                                            <div class="card-body">
                                              <p class="card-text">{{ $element->name }}</p>
                                              <p class="card-text">$8.000</p>
                                            </div>
                                          </div>
                                          <div class="col-md-2">
                                              <br>
                                            <a href="{{ route('ptventa.element.edit', $element) }}" class="btn btn-outline-warning btn-sm py-1" title="Actualizar Categoria">
                                                Actualizar
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable('#element', {
});
</script>

@endsection



