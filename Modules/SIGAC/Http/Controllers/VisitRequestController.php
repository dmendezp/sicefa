<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\Company;
use Modules\SICA\Entities\Environment;

class VisitRequestController extends Controller
{
    /**
     * Listado de solicitudes.
     * OJO: asegúrate de que tu ruta apunte a application_index si usas este nombre.
     */
    public function application_index()
    {
        $visitRequests = VisitRequest::with([
            'company',
            'person',
            'schedules.environment',
        ])->orderByDesc('id')->get();

        $environments = Environment::orderBy('name')->pluck('name', 'id');

        // No necesitas $lastSchedule global: la vista usa $visit->schedules->last() por fila
        return view('sigac::visitrequest.index', [
            'visitRequests' => $visitRequests,
            'environments'  => $environments,
            'titlePage'     => 'Solicitudes de visita',
            'titleView'     => 'Solicitudes de visita',
        ]);
    }

    /**
     * Mostrar formulario de creación.
     */
    public function application_create()
    {
        $companies = Company::all();

        return view('sigac::visitrequest.create', [
            'companies' => $companies,
            'titlePage' => 'Crear solicitud de visita',
            'titleView' => 'Crear solicitud de visita',
        ]);
    }

    /**
     * Guardar nueva solicitud.
     */
    public function application_store(Request $request)
    {
        $validated = $request->validate([
            // Empresa
            'company_name'          => 'required|string|max:255',
            'company_nit'           => 'nullable|string|max:100',
            'company_contact_name'  => 'nullable|string|max:120',
            'company_contact_phone' => 'nullable|string|max:30',
            'company_contact_email' => 'nullable|email|max:160',
            'company_address'       => 'nullable|string|max:255',
            // Solicitud
            'date_received'         => 'nullable|date',
            'response_date'         => 'nullable|date|after_or_equal:date_received',
            'response_method'       => 'nullable|string|max:120',
            'number_of_people'      => 'nullable|integer|min:1',
            'people_list'           => 'nullable|file|mimes:xlsx,csv',
            'observations'          => 'nullable|string|max:2000',
            // Contacto directo
            'contact_name'          => 'required|string|max:120',
            'contact_phone'         => 'required|string|max:30',
            'contact_email'         => 'required|email|max:160',
            // Tipo y requerimientos
            'type'                  => 'required|in:visita,practica',
            'practice_requirements' => 'nullable|string|max:2000',
        ], [
            'company_name.required'  => 'El nombre de la empresa es obligatorio.',
            'contact_name.required'  => 'El nombre de contacto es obligatorio.',
            'contact_phone.required' => 'El teléfono de contacto es obligatorio.',
            'contact_email.required' => 'El correo de contacto es obligatorio.',
            'contact_email.email'    => 'El correo de contacto no es válido.',
            'type.required'          => 'Selecciona si es Visita o Práctica.',
            'type.in'                => 'El tipo debe ser "visita" o "practica".',
        ]);

        if ($validated['type'] === 'practica' && empty($validated['practice_requirements'])) {
            return back()->withErrors([
                'practice_requirements' => 'Describe los requerimientos para la práctica.',
            ])->withInput();
        }

        // Empresa
        $company = Company::firstOrCreate(
            ['name' => $validated['company_name']],
            [
                'nit'           => $validated['company_nit'] ?? null,
                'contact_name'  => $validated['company_contact_name'] ?? null,
                'contact_phone' => $validated['company_contact_phone'] ?? null,
                'contact_email' => $validated['company_contact_email'] ?? null,
                'address'       => $validated['company_address'] ?? null,
            ]
        );
        // Actualiza datos si vinieron
        $company->nit           = $validated['company_nit']           ?? $company->nit;
        $company->contact_name  = $validated['company_contact_name']  ?? $company->contact_name;
        $company->contact_phone = $validated['company_contact_phone'] ?? $company->contact_phone;
        $company->contact_email = $validated['company_contact_email'] ?? $company->contact_email;
        $company->address       = $validated['company_address']       ?? $company->address;
        $company->save();

        // Usuario
        $user = Auth::user();

        // Crear solicitud
        $visitRequest = new VisitRequest();
        $visitRequest->company_id       = $company->id;
        $visitRequest->person_id        = $user->person->id ?? null; // ajusta si tu usuario podría no tener person
        $visitRequest->user_id          = $user->id;

        $visitRequest->date_received    = $validated['date_received'] ?? now()->toDateString();
        $visitRequest->response_date    = $validated['response_date'] ?? null;
        $visitRequest->response_method  = $validated['response_method'] ?? null;
        $visitRequest->state            = 'Sin agendar';
        $visitRequest->number_of_people = $validated['number_of_people'] ?? null;

        if ($request->hasFile('people_list')) {
            $visitRequest->people_list_path = $request->file('people_list')->store('visit_people_lists');
        }

        $visitRequest->contact_name     = $validated['contact_name'];
        $visitRequest->contact_phone    = $validated['contact_phone'];
        $visitRequest->contact_email    = $validated['contact_email'];

        $visitRequest->type                  = $validated['type']; // visita | practica
        $visitRequest->practice_requirements = $validated['type'] === 'practica'
            ? ($validated['practice_requirements'] ?? null)
            : null;

        $visitRequest->observations = $validated['observations'] ?? null;

        $visitRequest->save();

        return redirect()
            ->route('sigac.academic_coordination.visitrequest.create')
            ->with('created_visit_request', [
                'id'            => $visitRequest->id,
                'company'       => $company->name,
                'contact_name'  => $visitRequest->contact_name,
                'contact_phone' => $visitRequest->contact_phone,
                'contact_email' => $visitRequest->contact_email,
                'type'          => $visitRequest->type,
                'requirements'  => $visitRequest->practice_requirements,
                'state'         => $visitRequest->state,
                'created_at'    => $visitRequest->created_at?->format('Y-m-d H:i'),
            ])
            ->with('success', 'La solicitud de visita se ha registrado correctamente');
    }

    /**
     * Actualizar una solicitud existente.
     */
    public function application_update(Request $request)
    {
        $request->validate([
            'id'                    => ['required','exists:visit_requests,id'],
            'company_id'            => ['required','exists:companies,id'],
            'date_received'         => ['nullable','date'],
            'response_date'         => ['nullable','date','after_or_equal:date_received'],
            'response_method'       => ['nullable','string','max:120'],
            'state'                 => ['required','string','max:40'],
            'number_of_people'      => ['nullable','integer','min:1'],
            'people_list'           => ['nullable','file','mimes:xlsx,csv'],
            'observations'          => ['nullable','string','max:2000'],
            // Nuevos
            'contact_name'          => ['required','string','max:120'],
            'contact_phone'         => ['required','string','max:30'],
            'contact_email'         => ['required','email','max:160'],
            'type'                  => ['required','in:visita,practica'],
            'practice_requirements' => ['nullable','string','max:2000'],
        ]);

        $vr = VisitRequest::findOrFail($request->id);

        if ($request->type === 'practica' && empty($request->practice_requirements)) {
            return back()->withErrors([
                'practice_requirements' => 'Describe los requerimientos para la práctica.',
            ])->withInput();
        }

        $vr->company_id       = $request->company_id;
        $vr->date_received    = $request->date_received ?? $vr->date_received;
        $vr->response_date    = $request->response_date ?? $vr->response_date;
        $vr->response_method  = $request->response_method ?? $vr->response_method;
        $vr->state            = $request->state ?? $vr->state;
        $vr->number_of_people = $request->number_of_people ?? $vr->number_of_people;

        if ($request->hasFile('people_list')) {
            $vr->people_list_path = $request->file('people_list')->store('visit_people_lists');
        }

        $vr->contact_name     = $request->contact_name;
        $vr->contact_phone    = $request->contact_phone;
        $vr->contact_email    = $request->contact_email;
        $vr->type             = $request->type;
        $vr->practice_requirements = $request->type === 'practica'
            ? ($request->practice_requirements ?? null)
            : null;

        $vr->observations = $request->observations ?? $vr->observations;

        $vr->save();

        return back()->with('success', 'Solicitud actualizada correctamente');
    }
}
