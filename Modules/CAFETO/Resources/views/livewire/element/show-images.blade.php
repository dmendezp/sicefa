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
                            <div class="text-center text-muted my-2">
                                @if(count($elements) == 1) Mostrando <strong>1</strong> resultado @else Mostrando <strong>{{ count($elements) }}</strong> resultados @endif
                                @if (!empty($category))
                                    para la categoría <strong>{{ $category }}</strong>
                                @endif
                            </div>
                            <div class="d-inline-flex">
                                <div class="row  justify-content-center mx-auto">
                                    @foreach ($elements as $e)
                                        <div class="col-auto">
                                            <div class="card-image" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url('@if($e->image && file_exists(public_path($e->image))) {{ asset($e->image) }} @else {{ asset('modules/sica/images/sinImagen.png') }} @endif');">
                                                <div class="card-category text-center"><strong>{{ $e->name }}</strong></div>
                                                <div class="card-description">
                                                    <p class="mt-1">
                                                        {{ $e->category->name }}
                                                        <a href="{{ route('cafeto.element.edit', $e) }}" class="text-light float-right">
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
                            <div class="text-center text-muted my-3">
                                <strong>No se encontraron resultados</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Categorías -->
            <div class="col-auto" id="sidebar">
                <h4>Categorías</h4>
                @if($categories->count())
                    <style> /* Stilos para el hover por categorías */
                        .list-group-item:hover {
                            background-color: #a5acb3;
                            cursor: pointer;
                        }
                    </style>
                    <ul class="list-group my-1 overflow-auto" style="max-height: 500px;">
                        <li class="list-group-item py-1 mb-1 list-group-item-action rounded-3 text-center" wire:click="defaultSearch()">
                            Sin categoría
                        </li>
                        @foreach ($categories as $c)
                            @if($c->elements->count()) {{-- Mostrar categorías que almenos tenga un elemento asociado --}}
                                <li class="list-group-item py-1 list-group-item-action rounded-3" wire:click="searchByCategory({{ $c->id }})">
                                    {{ $c->name }} <span class="badge mr-1 bg-success float-right">{{ $c->elements->count() }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    No hay categorías.
                @endif
            </div>

        </div>
    </div>

</div>
