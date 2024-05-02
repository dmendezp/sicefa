@extends('hangarauto::layouts.master')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header">
                    <h4>Chequeo</h4>
                </div><br>
                <a href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.add.index') }}">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                </a><br><br>
                <div class="card">
                    <div class="card-body">
                        <table id="checkups" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th class="col-1">Conductor</th>
                                <th>Vehiculo</th>
                                <th>Fecha</th>
                                <th class="col-1">Kilometro Inicial</th>
                                <th class="col-1">Kilometro Final</th>
                                <th class="col-1">Hora Inicial</th>
                                <th class="col-1">Hora Final</th>
                                <th>Elementos Chequeo</th>
                                @if (Auth::user()->havePermission('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.edit'))
                                <th>Acciones</th>
                                @endif
                            </thead>
                            <tbody>
                                @foreach($chequeos as $checkup)
                                    <tr>
                                        <td>{{$checkup->driver->person->fullname}}</td>
                                        <td>{{$checkup->vehicle->name}}</td>
                                        <td>{{$checkup->date}}</td>
                                        <td>{{$checkup->initial_kilometer}}</td>
                                        <td>{{$checkup->final_kilometer}}</td>
                                        <td>{{$checkup->initial_hour}}</td>
                                        <td>{{$checkup->final_hour}}</td>
                                        <td>
                                            <ul>
                                                @foreach($checkup->check_lists as $item)
                                                    <li>{{$item->inspection}} - {{$item->complete}} - {{$item->observation}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @php
                                                // Verificar si la fecha actual es un día mayor que la fecha de creación del registro
                                                $currentDate = now();
                                                $disableButton = $currentDate->diffInDays($checkup->created_at) >= 1;
                                            @endphp

                                            @if (!$disableButton || !checkRol('hangarauto.driver'))
                                                @if (Auth::user()->havePermission('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.edit'))
                                                <a href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.edit', $checkup->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                                                @endif
                                                @if (Auth::user()->havePermission('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.delete'))
                                                <form action="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.delete', $checkup->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                                @endif
                                            @endif
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
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#checkups').DataTable();
        });
    </script>
@endpush
