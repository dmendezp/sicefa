<div>

    <div class="container-fluid">
        <div class="row">

            <!-- Búsqueda e imágenes -->
            <div class="col">
                <div class="input-group input-group-sm">
                    <input wire:model.debounce.500ms="name" type="text" class="form-control" placeholder="Buscar productos por nombre">
                </div>
                <div class="text-center">
                    <!-- Spinner para el loader -->
                    <div class="p-3" wire:loading>
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div><br>
                        <strong>Cargando...</strong>
                    </div>
                    {{-- Galería de imágenes --}}
                    <div wire:loading.remove>
                        @if ($elements->count())
                            <div class="text-center text-muted my-2">@if(count($elements) == 1) Mostrando 1 resultado @else Mostrando {{ count($elements) }} resultados @endif</div>
                            <div class="d-inline-flex">
                                <div class="row  justify-content-center mx-auto">
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
                        @else
                            <div class="text-center text-muted my-3">No se encontraron resultados</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Categorías -->
            <div class="col-auto" id="sidebar">
                <h4>Categorías</h4>
                <ul class="list-group mt-3">
                    <li class="list-group-item">Test <span class="badge mr-1 bg-success float-right">10</span></li>
                </ul>
            </div>

        </div>
    </div>

</div>
