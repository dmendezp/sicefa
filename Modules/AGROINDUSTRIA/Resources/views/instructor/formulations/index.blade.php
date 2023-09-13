<table id="formulation" class="hover" style="width: 90%">
    <thead>
        <tr>
            <th>Creador</th>
            <th>Producto</th>
            <th>Proceso</th>
            <th>Cantidad de Producción</th>
            <th>Ingredientes</th>
            <th>Cantidad</th>
            <th>Utencilios</th>
            <th>Cantidad</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($formulations as $f)        
        <tr>
            <td>{{$f->person->first_name . ' ' . $f->person->first_last_name . ' ' . $f->person->second_last_name}}</td>
            <td>{{$f->element->name}}</td>
            <td>{{$f->proccess}}</td>
            <td>{{$f->amount}}</td>
            <td>
                @foreach ($f->ingredients as $ingredient)
                    {{$ingredient->element->name}}<br>
                @endforeach
            </td>
            <td>
                @foreach ($f->ingredients as $ingredient)
                    {{$ingredient->amount}}<br>
                @endforeach
            </td>
            <td>
                @foreach ($f->utensils as $utensil)
                    {{$utensil->element->name}}<br>
                @endforeach
            </td>
            <td>
                @foreach ($f->utensils as $utensil)
                    {{$utensil->amount}}<br>
                @endforeach
            </td>
            <td>
                <button class="btn btn-primary float-end mb-2" style="width: 45px; height: 35px;" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="fa-solid fa-pen-to-square fa-sm"></i>
                </button>     
                <button type="submit"  style="width: 45px; height: 35px;"  class="btn btn-danger">
                    <i class="fa-solid fa-trash fa-sm"></i>
                </button>                                   
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
