<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\Alliance;
use Auth;

class AllianceController extends Controller
{

    /**
     * Muestra la lista de alianzas.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_alliance_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_alliance_index_title_view'),
        ];
        $alliances = Alliance::paginate(10);
        return view('sia::alliances.index', compact('view', 'alliances'));
    }

    /**
     * Muestra el formulario para crear una nueva alianza.
     */
    public function create()
    {
        $this->authorize('create', Alliance::class);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_alliance_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_alliance_create_title_view'),
        ];
        return view('sia::alliances.create', compact('view'));
    }

    /**
     * Almacena una nueva alianza en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Alliance::class);
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'organization' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_alliance_name_required'),
            'name.max' => trans('sia::controllers.SIA_alliance_name_max'),
            'description.required' => trans('sia::controllers.SIA_alliance_description_required'),
            'organization.required' => trans('sia::controllers.SIA_alliance_organization_required'),
            'organization.max' => trans('sia::controllers.SIA_alliance_organization_max'),
            'email.required' => trans('sia::controllers.SIA_alliance_email_required'),
            'email.email' => trans('sia::controllers.SIA_alliance_email_valid'),
            'email.max' => trans('sia::controllers.SIA_alliance_email_max'),
            'start_date.required' => trans('sia::controllers.SIA_alliance_start_date_required'),
            'start_date.date' => trans('sia::controllers.SIA_alliance_start_date_valid'),
            'end_date.date' => trans('sia::controllers.SIA_alliance_end_date_valid'),
            'end_date.after' => trans('sia::controllers.SIA_alliance_end_date_after'),
            'status.required' => trans('sia::controllers.SIA_alliance_status_required'),
            'status.in' => trans('sia::controllers.SIA_alliance_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request) {
            Alliance::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'organization' => $request->input('organization'),
                'email' => $request->input('email'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $request->input('status'),
            ]);
        });

        return redirect()->route('sia.alliances.index')
            ->with('message_sia', trans('sia::controllers.SIA_alliance_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar una alianza existente.
     */
    public function edit(Alliance $alliance)
    {
        $this->authorize('update', $alliance);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_alliance_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_alliance_edit_title_view'),
        ];
        return view('sia::alliances.edit', compact('view', 'alliance'));
    }

    /**
     * Actualiza una alianza en la base de datos.
     */
    public function update(Request $request, Alliance $alliance)
    {
        $this->authorize('update', $alliance);
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'organization' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_alliance_name_required'),
            'name.max' => trans('sia::controllers.SIA_alliance_name_max'),
            'description.required' => trans('sia::controllers.SIA_alliance_description_required'),
            'organization.required' => trans('sia::controllers.SIA_alliance_organization_required'),
            'organization.max' => trans('sia::controllers.SIA_alliance_organization_max'),
            'email.required' => trans('sia::controllers.SIA_alliance_email_required'),
            'email.email' => trans('sia::controllers.SIA_alliance_email_valid'),
            'email.max' => trans('sia::controllers.SIA_alliance_email_max'),
            'start_date.required' => trans('sia::controllers.SIA_alliance_start_date_required'),
            'start_date.date' => trans('sia::controllers.SIA_alliance_start_date_valid'),
            'end_date.date' => trans('sia::controllers.SIA_alliance_end_date_valid'),
            'end_date.after' => trans('sia::controllers.SIA_alliance_end_date_after'),
            'status.required' => trans('sia::controllers.SIA_alliance_status_required'),
            'status.in' => trans('sia::controllers.SIA_alliance_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $alliance) {
            $alliance->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'organization' => $request->input('organization'),
                'email' => $request->input('email'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $request->input('status'),
            ]);
        });

        return redirect()->route('sia.alliances.index')
            ->with('message_sia', trans('sia::controllers.SIA_alliance_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina una alianza de la base de datos.
     */
    public function destroy(Alliance $alliance)
    {
        $this->authorize('delete', $alliance);

        if ($alliance->delete()) {
            return redirect()->route('sia.alliances.index')
                ->with('message_sia', trans('sia::controllers.SIA_alliance_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.alliances.index')
            ->with('message_sia', trans('sia::controllers.SIA_alliance_destroy_error'))
            ->with('message_sia_type', 'error');
    }
}