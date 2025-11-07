@if (!empty($environments) && count($environments) > 0)
<div class="table-responsive">
    <table id="table_environments" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Imágen</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Clase</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Finca</th>
                <th class="text-center">Coordenadas</th>
                <th class="text-center">Pagina</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($environments as $e)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $e->name }}</td>
                    <td><img src="{{ asset('modules/cefamaps/images/uploads/' . $e->picture) }}" width="100" height="100"></td>
                    <td class="text-center">{{ $e->description }}</td>
                    <td class="text-center">{{ $e->class_environment->name }}</td>
                    <td class="text-center">{{ $e->type_environment }}</td>
                    <td class="text-center">{{ $e->farm->name }}</td>
                    <td class="col-1">
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modal-info-{{ $e->id }}">Coordenadas
                        </button>
                        <div class="modal fade" id="modal-info-{{ $e->id }}">
                            <div class="modal-dialog modal-l">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>{{ $e->name }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</h5>
                                                <p>{{ $e->length }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</h5>
                                                <p>{{ $e->latitude }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="modal-title">{{ trans('cefamaps::environment.1M_Environment_Polygon') }} : <em>{{ $e->name }}</em></h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</h5>
                                                @foreach ($e->coordinates as $c)
                                                    <p>{{ $c->length }}</p>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6">
                                                <h5>{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</h5>
                                                @foreach ($e->coordinates as $c)
                                                    <p>{{ $c->latitude }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#modal-pag-{{ $e->id }}">Pagina
                        </button>
                        <div class="modal fade" id="modal-pag-{{ $e->id }}">
                            <div class="modal-dialog modal-l">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>{{ $e->name }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if (isset($e->page))
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>Pagina</h5>
                                                    @foreach ($e->pages as $c)
                                                        <p>{{ $c->name}}</p>
                                                    @endforeach
                                                </div>
                                                <div class="col-md-8">
                                                    <h5>Contenido</h5>
                                                    @foreach ($e->pages as $c)
                                                        <p>{!! $c->content !!}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <h5>No contiene pagina</h5>
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

@else
@if (isset($environments))
No se encontraron ambientes
@endif
    
@endif