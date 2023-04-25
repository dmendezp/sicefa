<div>

    <div class="container-fluid">
        <div class="row">
            <!-- Búsqueda e imágenes -->
            <div class="col">
                {{-- <form>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Buscar productos">
                        <button class="btn btn-outline-success" type="button">Buscar</button>
                    </div>
                </form> --}}
                <form wire:submit.prevent="searchElements">
                    <div class="input-group input-group-sm">
                        <input wire:model.debounce.500ms="search" wire:keydown.enter.prevent="searchElements" type="text" class="form-control" placeholder="Buscar productos">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </div>
                </form>
                <hr class="text-success" style="margin-bottom: 0px">
                <div class="text-center text-success my-1">
                    {{-- <span><strong>Mostrando @if(count($elements) == 1) 1 resultado @else {{ count($elements) }} resultados @endif</strong></span> --}}
                </div>

                @if ($elements->isEmpty())
                    <div class="text-center text-muted my-3">No se encontraron resultados</div>
                @else
                    <div class="text-center text-muted my-1">@if(count($elements) == 1) 1 resultado encontrado @else {{ count($elements) }} resultados encontrados @endif</div>
                    <div class="d-inline-flex">
                        <div class="row  justify-content-center mx-auto">
                            {{ $search }}
                            @foreach ($elements as $e)
                                <div class="col-auto">
                                    <div class="card-image" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url('@if($e->image && file_exists(public_path($e->image))) {{ asset($e->image) }} @else {{ asset('modules/sica/images/sinImagen.png') }} @endif');">
                                        <div class="card-category text-center"><strong>{{ $e->name }}</strong></div>
                                        <div class="card-description">
                                            <p class="mt-1">
                                                {{ $e->category->name }}
                                                <a href="{{ route('ptventa.element.edit', $e) }}" class="text-light float-right">
                                                    <i class="fa-solid fa-pen-to-square fs-6"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


            </div>
            <!-- Categorías -->
            <div class="col-auto" id="sidebar">
                <h4>Categorías</h4>
                <ul class="list-group mt-3">
                    <li class="list-group-item">Categoría 1 <span class="badge bg-success float-right">10</span></li>
                    <li class="list-group-item">Categoría 2 <span class="badge bg-success float-right">20</span></li>
                    <li class="list-group-item">Categoría 3 <span class="badge bg-success float-right">15</span></li>
                </ul>
            </div>
        </div>
    </div>

</div>
