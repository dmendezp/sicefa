<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SIA\Entities\EventSia;
use Illuminate\Support\Facades\Storage;

class EventSiaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sia::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sia::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'in:scheduled,ongoing,completed,cancelled',
            'imagen_evento' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
   
         $eventData = $validated;
        $eventData['user_id'] = auth()->id();

         if ($request->hasFile('imagen_evento')) {
            $path = $request->file('imagen_evento')->store('events', 'public');
            $eventData['imagen_evento'] = $path;
        }

        $event = EventSia::create($eventData);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

     public function update(Request $request, EventSia $event)
    {
        if (auth()->user()->role === 'Inst.Inv' && ($event->user_id !== auth()->id())) {
            abort(403, 'No autorizado');
        }
        if ($event->user_id === null && auth()->user()->role !== 'ADM') {
            abort(403, 'Solo ADM puede editar este evento');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'in:scheduled,ongoing,completed,cancelled',
            'imagen_evento' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $eventData = $validated;

        if ($request->hasFile('imagen_evento')) {
            if ($event->imagen_evento) {
                Storage::disk('public')->delete($event->imagen_evento);
            }
            $path = $request->file('imagen_evento')->store('events', 'public');
            $eventData['imagen_evento'] = $path;
        }

        $event->update($eventData);

        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
    }

    public function destroy(EventSia $event)
    {
        if (auth()->user()->role === 'Inst.Inv' && ($event->user_id !== auth()->id())) {
            abort(403, 'No autorizado');
        }
        if ($event->user_id === null && auth()->user()->role !== 'ADM') {
            abort(403, 'Solo ADM puede eliminar este evento');
        }

        if ($event->imagen_evento) {
            Storage::disk('public')->delete($event->imagen_evento);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito');
}


/**
 * Show the specified resource.
 * @param int $id
 * @return Renderable
 */
public function show($id)
    {
        return view('sia::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sia::edit');
    }


}
