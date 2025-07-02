<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\Group;
use Auth;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Muestra la lista de grupos.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_group_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_group_index_title_view'),
        ];
        $groups = Group::withTrashed()->paginate(10);
        return view('sia::groups.index', compact('view', 'groups'));
    }

    /**
     * Muestra el formulario para crear un nuevo grupo.
     */
    public function create()
    {
        $this->authorize('create', Group::class);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_group_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_group_create_title_view'),
        ];
        return view('sia::groups.create', compact('view'));
    }

    /**
     * Almacena un nuevo grupo en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Group::class);
        $rules = [
            'name' => 'required|string|max:100|unique:groups,name',
            'description' => 'required|string|max:800',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_group_name_required'),
            'name.max' => trans('sia::controllers.SIA_group_name_max'),
            'name.unique' => trans('sia::controllers.SIA_group_name_unique'),
            'description.required' => trans('sia::controllers.SIA_group_description_required'),
            'description.max' => trans('sia::controllers.SIA_group_description_max'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request) {
            Group::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
        });

        return redirect()->route('sia.groups.index')
            ->with('message_sia', trans('sia::controllers.SIA_group_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar un grupo existente.
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_group_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_group_edit_title_view'),
        ];
        return view('sia::groups.edit', compact('view', 'group'));
    }

    /**
     * Actualiza un grupo en la base de datos.
     */
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);
        $rules = [
            'name' => 'required|string|max:100|unique:groups,name,' . $group->id,
            'description' => 'required|string|max:800',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_group_name_required'),
            'name.max' => trans('sia::controllers.SIA_group_name_max'),
            'name.unique' => trans('sia::controllers.SIA_group_name_unique'),
            'description.required' => trans('sia::controllers.SIA_group_description_required'),
            'description.max' => trans('sia::controllers.SIA_group_description_max'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $group) {
            $group->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
        });

        return redirect()->route('sia.groups.index')
            ->with('message_sia', trans('sia::controllers.SIA_group_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina un grupo de la base de datos.
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        if ($group->delete()) {
            return redirect()->route('sia.groups.index')
                ->with('message_sia', trans('sia::controllers.SIA_group_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.groups.index')
            ->with('message_sia', trans('sia::controllers.SIA_group_destroy_error'))
            ->with('message_sia_type', 'error');
    }
}