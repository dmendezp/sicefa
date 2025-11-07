<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Boton Agregar Elemento -->
            <div class="d-grid gap-2 d-md-block text-right">
                @if (Auth::user()->havePermission('cafeto.' . getRoleRouteName($current_route_name) . '.element.create'))
                    <a href="{{ route('cafeto.' . getRoleRouteName($current_route_name) . '.element.create') }}"
                        class="btn btn-success">
                        <i class="fa-solid fa-cart-flatbed fa-fade mr-1"></i>
                        {{ trans('cafeto::element.Btn_Register_Product') }}
                    </a>
                @endif
            </div>

            <br><br>

            <!-- Búsqueda e imágenes -->
            <div class="col">
                <div class="input-group input-group-sm">
                    <input wire:model.debounce.500ms="name" type="text" class="form-control"
                        placeholder={{ trans('cafeto::element.Placeholder_Search') }}>
                </div>
                <div class="text-center">
                    <!-- Spinner para el loader -->
                    <div class="p-3" wire:loading>
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div><br>
                        <strong>{{ trans('cafeto::element.Loader_Loading') }}</strong>
                    </div>
                    {{-- Galería de imágenes --}}
                    <div wire:loading.remove>
                        @if ($elements->count())
                            <div class="text-center text-muted my-2">
                                @if (count($elements) == 1)
                                    {{ trans('cafeto::element.Title_Form_Showing') }} <strong>1</strong>
                                    {{ trans('cafeto::element.Title_Form_Result') }}
                                @else
                                    {{ trans('cafeto::element.Title_Form_Showing') }}
                                    <strong>{{ count($elements) }}</strong>
                                    {{ trans('cafeto::element.Title_Form_Results') }}
                                @endif
                                @if (!empty($category))
                                    {{ trans('cafeto::element.Title_Form_Category') }}
                                    <strong>{{ $category }}</strong>
                                @endif
                            </div>
                            <div class="d-inline-flex">
                                <div class="row  justify-content-center mx-auto">
                                    @foreach ($elements as $e)
                                        <div class="col-auto">
                                            <div class="card-image"
                                                style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url('@if ($e->image && file_exists(public_path($e->image))) {{ asset($e->image) }} @else {{ asset('modules/sica/images/sinImagen.png') }} @endif');">
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon bg-warning">
                                                        <strong>{{ priceFormat($e->price) }}</strong>
                                                    </div>
                                                </div>
                                                <div class="card-category text-center">
                                                    <strong>{{ $e->name }}</strong>
                                                </div>
                                                <div class="card-description">
                                                    <p class="mt-1">
                                                        {{ $e->category->name }}
                                                        @if (Auth::user()->havePermission('cafeto.' . getRoleRouteName($current_route_name) . '.element.edit'))
                                                            <a href="{{ route('cafeto.' . getRoleRouteName($current_route_name) . '.element.edit', $e) }}"
                                                                class="text-light float-right">
                                                                <i class="fa-solid fa-pen-to-square fs-6"></i>
                                                            </a>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center text-muted my-3">
                                <strong>{{ trans('cafeto::element.Title_Form_No_Results') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Categorías -->
            <div class="col-md-3 col-12" id="sidebar">
                <h4>{{ trans('cafeto::element.Title_Panel_Category') }}</h4>
                @if ($categories->count())
                    <style>
                        /* Estilos para el hover por categorías */
                        .list-group-item:hover {
                            background-color: #a5acb3;
                            cursor: pointer;
                        }
                    </style>
                    <ul class="list-group my-1 overflow-auto" style="max-height: 500px;">
                        <li class="list-group-item py-1 mb-1 list-group-item-action rounded-3 text-center"
                            wire:click="defaultSearch()">
                            {{ trans('cafeto::element.Title_Panel_Uncategorized') }}
                        </li>
                        @foreach ($categories as $c)
                            @if ($c->elements->count())
                                {{-- Mostrar categorías que al menos tenga un elemento asociado --}}
                                <li class="list-group-item py-1 mb-1 list-group-item-action rounded-3 clearfix"
                                    wire:click="searchByCategory({{ $c->id }})">
                                    {{ $c->name }}
                                    <span class="badge bg-warning float-right">{{ $c->elements->count() }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    {{ trans('cafeto::element.Title_Panel_No_Categories') }}
                @endif
            </div>
        </div>
    </div>
</div>
