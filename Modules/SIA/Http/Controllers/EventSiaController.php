<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\EventSia;
use Auth;

class EventSiaController extends Controller
{
    /**
     * Muestra la lista de eventos.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_event_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_event_index_title_view'),
        ];
        $events = Auth::user()->hasRole('admin') 
            ? EventSia::withTrashed()->paginate(10) 
            : EventSia::where('created_by', Auth::id())->withTrashed()->paginate(10); // Nota: Sin created_by, esto será ajustado
        return view('sia::events.index', compact('view', 'events'));
    }

    /**
     * Muestra el formulario para crear un nuevo evento.
     */
    public function create()
    {
        $this->authorize('create', EventSia::class);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_event_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_event_create_title_view'),
        ];
        return view('sia::events.create', compact('view'));
    }

    /**
     * Almacena un nuevo evento en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', EventSia::class);
        $rules = [
            'name' => 'required|string|max:255',
            'event_image' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:events_sia,contact_email',
            'contact_phone' => 'nullable|numeric|digits:10',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_event_name_required'),
            'event_image.required' => trans('sia::controllers.SIA_event_image_required'),
            'location.required' => trans('sia::controllers.SIA_event_location_required'),
            'start_date.required' => trans('sia::controllers.SIA_event_start_date_required'),
            'start_date.after_or_equal' => trans('sia::controllers.SIA_event_start_date_valid'),
            'end_date.required' => trans('sia::controllers.SIA_event_end_date_required'),
            'end_date.after_or_equal' => trans('sia::controllers.SIA_event_end_date_valid'),
            'organizer.required' => trans('sia::controllers.SIA_event_organizer_required'),
            'contact_email.required' => trans('sia::controllers.SIA_event_contact_email_required'),
            'contact_email.unique' => trans('sia::controllers.SIA_event_contact_email_unique'),
            'contact_phone.digits' => trans('sia::controllers.SIA_event_contact_phone_digits'),
            'status.required' => trans('sia::controllers.SIA_event_status_required'),
            'status.in' => trans('sia::controllers.SIA_event_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request) {
            EventSia::create([
                'name' => $request->input('name'),
                'event_image' => $request->input('event_image'),
                'location' => $request->input('location'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'organizer' => $request->input('organizer'),
                'contact_email' => $request->input('contact_email'),
                'contact_phone' => $request->input('contact_phone'),
                'status' => $request->input('status'),
            ]);
        });

        return redirect()->route('sia.admin.events.index')
            ->with('message_sia', trans('sia::controllers.SIA_event_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar un evento existente.
     */
    public function edit(EventSia $event)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Unauthorized action'); // Solo admin puede editar cualquier evento
        }
        $view = [
            'titlePage' => trans('sia::controllers.SIA_event_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_event_edit_title_view'),
        ];
        return view('sia::events.edit', compact('view', 'event'));
    }

    /**
     * Actualiza un evento en la base de datos.
     */
    public function update(Request $request, EventSia $event)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Unauthorized action'); // Solo admin puede actualizar
        }

        $rules = [
            'name' => 'required|string|max:255',
            'event_image' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:events_sia,contact_email,' . $event->id,
            'contact_phone' => 'nullable|numeric|digits:10',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_event_name_required'),
            'event_image.required' => trans('sia::controllers.SIA_event_image_required'),
            'location.required' => trans('sia::controllers.SIA_event_location_required'),
            'start_date.required' => trans('sia::controllers.SIA_event_start_date_required'),
            'start_date.after_or_equal' => trans('sia::controllers.SIA_event_start_date_valid'),
            'end_date.required' => trans('sia::controllers.SIA_event_end_date_required'),
            'end_date.after_or_equal' => trans('sia::controllers.SIA_event_end_date_valid'),
            'organizer.required' => trans('sia::controllers.SIA_event_organizer_required'),
            'contact_email.required' => trans('sia::controllers.SIA_event_contact_email_required'),
            'contact_email.unique' => trans('sia::controllers.SIA_event_contact_email_unique'),
            'contact_phone.digits' => trans('sia::controllers.SIA_event_contact_phone_digits'),
            'status.required' => trans('sia::controllers.SIA_event_status_required'),
            'status.in' => trans('sia::controllers.SIA_event_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $event) {
            $event->update([
                'name' => $request->input('name'),
                'event_image' => $request->input('event_image'),
                'location' => $request->input('location'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'organizer' => $request->input('organizer'),
                'contact_email' => $request->input('contact_email'),
                'contact_phone' => $request->input('contact_phone'),
                'status' => $request->input('status'),
            ]);
        });

        return redirect()->route('sia.admin.events.index')
            ->with('message_sia', trans('sia::controllers.SIA_event_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina un evento de la base de datos.
     */
    public function destroy(EventSia $event)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Unauthorized action'); // Solo admin puede eliminar
        }

        if ($event->remove()) {
            return redirect()->route('sia.admin.events.index')
                ->with('message_sia', trans('sia::controllers.SIA_event_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.admin.events.index')
            ->with('message_sia', trans('sia::controllers.SIA_event_destroy_error'))
            ->with('message_sia_type', 'error');
    }
}