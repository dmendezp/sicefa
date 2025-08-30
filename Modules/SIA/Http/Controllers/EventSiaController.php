<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\EventSia;
use Auth;

class EventSiaController extends Controller
{
    public function index()
    {
        $view = ['titlePage' => 'Gestión de Eventos', 'titleView' => 'Gestión de Eventos'];
        $events = EventSia::orderBy('start_date', 'desc')->get();
        return view('sia::event_sia.index', compact('events', 'view'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable',
            'status' => 'required|in:Programado,Completado,Cancelado',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $event = new EventSia();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->organizer = $request->organizer;
        $event->contact_email = $request->contact_email;
        $event->contact_phone = $request->contact_phone;
        $event->status = $request->status;

        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('events', 'public');
            $event->event_image = 'storage/' . $imagePath;
        }

        $event->save();

        return redirect()->back()->with('success', 'Evento creado correctamente.');
    }

    public function update(Request $request, $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:Programado,Completado,Cancelado',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $event = EventSia::find($event);
        $event->update($request->only([
            'name',
            'description',
            'location',
            'start_date',
            'end_date',
            'organizer',
            'contact_email',
            'contact_phone',
            'status'
        ]));

        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('events', 'public');
            $event->event_image = 'storage/' . $imagePath;
            $event->save();
        }

        return redirect()->back()->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($event)
    {
        $event = EventSia::find($event);
        $event->delete();
        return redirect()->back()->with('success', 'Evento eliminado correctamente.');
    }
}
