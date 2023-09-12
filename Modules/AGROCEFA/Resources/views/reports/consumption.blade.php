@extends('agrocefa::layouts.master')


@section('content')
    <div class="container">
        <h3>Reporte Consumo</h3>
        <form id="filterForm" method="POST" action="{{ route('agrocefa.reports.filterByDate') }}">
          @csrf
          <div class="form-group">
              <label for="startDate">Fecha de inicio:</label>
              <input type="date" class="form-control" name="startDate" id="startDate">
          </div>
      
          <div class="form-group">
              <label for="endDate">Fecha de fin:</label>
              <input type="date" class="form-control" name="endDate" id="endDate">
          </div>
      
          <button type="submit" class="btn btn-primary">Filtrar</button>
      </form>
      
        <div class="container my-5">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha del consumo</th>
                                    <th>Labor</th>
                                    <th>Elemento</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data['consumableId'] }}</td>
                                        <td>{{ $data['laborDate'] }}</td>
                                        <td>{{ $data['laborDescription'] }}</td>
                                        <td>{{ $data['elementName'] }}</td>
                                        <td>{{ $data['consumableAmount'] }}</td>
                                        <td>{{ $data['consumablePrice'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
