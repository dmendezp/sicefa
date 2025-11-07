<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SICA\Entities\Apprentice;
use Modules\SIGAC\Entities\ApprenticePermission;
use Illuminate\Support\Facades\Validator;
use Modules\SIGAC\Entities\Intern;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\InstructorProgram;
use Illuminate\Validation\Rule;
use Svg\Tag\Rect;

class ApprenticePermissionsController extends Controller
{

   
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user()->load(['person','roles']); //hace una consulta en la tabla de user para acceder alas relaciones con peron y roles
        $apprentice = Apprentice::where('person_id', $user->person->id)
                            ->with(['person', 'course']) // eager loading
                            ->first();

        $hoy = Carbon::parse('2024-07-08');
        $ahora = Carbon::now()->format('H:i:s');//fecha y hora actual

        $course_id = $apprentice->course->id;
        $schedules = \Modules\SIGAC\Entities\InstructorProgram::where('course_id', $course_id)
                ->orderBy('date')
                    ->whereTime('start_time', '<=', $ahora)
                    ->whereTime('end_time', '>=', $ahora)
                ->with('instructor_program_people.person')
                ->whereDate ('date',$hoy) // opcional: ordena por fecha
                ->get();

     return view('sigac::LeaveRequests.apprentice.permissions.index', [
        'titlePage' => 'Permisos del Aprendiz',
        'titleView' => 'Solicitud de Permisos',
        'user'      => $user,
        'rol'      => $user->roles->first(),
        'apprentice' =>$apprentice,
        'schedules' => $schedules


    ]);
    }

public function getInstructor(Request $request)
{
    $user = Auth::user()->load(['person']);
    $personId = $user->person->id;

    // 🧩 Validar formato de fecha y hora
    try {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->date)) {
            throw new \Exception('Formato de fecha inválido');
        }
        $date = Carbon::createFromFormat('Y-m-d', $request->date)->format('Y-m-d');

        if (!preg_match('/^\d{2}:\d{2}$/', $request->start)) {
            throw new \Exception('Formato de hora inválido');
        }
        $time = Carbon::createFromFormat('H:i', $request->start)->format('H:i:s');
    } catch (\Exception $e) {
        return response()->json(['name' => 'Fecha u hora inválida']);
    }

    // 🟦 1. Verificar si el aprendiz es pasante activo en esa fecha
    $intern = Intern::where('person_id', $personId)
        ->whereDate('start_date', '<=', $date)
        ->whereDate('end_date', '>=', $date)
        ->first();

    if ($intern) {
        // 🧠 Es pasante: buscar supervisor
        $supervisor = Person::find($intern->assigned_supervisor_id);

        if ($supervisor) {
            $name = trim("{$supervisor->first_name} {$supervisor->first_last_name} {$supervisor->second_last_name}");
            return response()->json([
                'name' => $name,
                'id' => $supervisor->id,
                'role' => 'supervisor'
            ]);
        }

        return response()->json(['name' => 'Pasante sin supervisor asignado']);
    }

    // 🟦 2. Si no es pasante, buscar instructor normal
    $apprentice = Apprentice::where('person_id', $personId)->with('course')->first();

    if (!$apprentice || !$apprentice->course) {
        return response()->json(['name' => 'No se encontró el curso del aprendiz']);
    }

    $course_id = $apprentice->course->id;

    $schedule = InstructorProgram::where('course_id', $course_id)
        ->whereDate('date', $date)
        ->whereTime('start_time', '<=', $time)
        ->whereTime('end_time', '>=', $time)
        ->with('instructor_program_people.person')
        ->first();

    if (!$schedule) {
        return response()->json(['name' => 'No hay horario asignado']);
    }

    $instructorPerson = optional($schedule->instructor_program_people->first())->person;

    if (!$instructorPerson) {
        return response()->json(['name' => 'Horario sin instructor']);
    }

    $name = trim("{$instructorPerson->first_name} {$instructorPerson->first_last_name} {$instructorPerson->second_last_name}");

    return response()->json([
        'name' => $name,
        'id' => $instructorPerson->id,
        'role' => 'instructor'
    ]);
}
public function store(Request $request)
{
    // Paso 1: Verifica que el request llega
    // dd('Entró al método store', $request->all());

    // Paso 2: Validación base
    $validator = Validator::make($request->all(), [
        'date' => 'required|date',
        'time_start' => 'required|date_format:H:i',
        'time_finish' => 'required|date_format:H:i|after:time_start',
        'reason' => 'required|string',
        'detail_citation' => 'nullable|string',
        'detail_calamity' => 'nullable|string',
        'disease_detail' => 'nullable|string',
        'detail_diligence' => 'nullable|string',
        'detail_other' => 'nullable|string',
        'evidence_url' => [
            'nullable',
            'file',
            Rule::requiredIf($request->reason === 'Cita Médica'),
        ],
        'instructor_id' => 'nullable|exists:people,id',
        'course_id' => 'required|exists:courses,id',
    ]);

    // Paso 3: Validación condicional según la razón
    $reason = $request->input('reason');

    switch ($reason) {
        case 'Cita Médica':
            $validator->addRules(['detail_citation' => 'required|string']);
            break;
        case 'Calamidad':
            $validator->addRules(['detail_calamity' => 'required|string']);
            break;
        case 'Enfermedad':
            $validator->addRules(['disease_detail' => 'required|string']);
            break;
        case 'Diligencia personal':
            $validator->addRules(['detail_diligence' => 'required|string']);
            break;
        case 'Otro':
            $validator->addRules(['detail_other' => 'required|string']);
            break;
    }

    // Paso 4: Ejecuta validación
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Paso 5: Selección del detalle según la razón
    $detail = match ($reason) {
        'Cita Médica' => $request->detail_citation,
        'Calamidad' => $request->detail_calamity,
        'Enfermedad' => $request->disease_detail,
        'Diligencia personal' => $request->detail_diligence,
        'Otro' => $request->detail_other,
        default => null,
    };

    // Paso 6: Manejo del archivo de evidencia (si existe)
    $evidencePath = null;
    if ($request->hasFile('evidence_url')) {
        $file = $request->file('evidence_url');
        $filename = time() . '_' . $file->getClientOriginalName();
        // Se guarda en storage/app/public/sigac/evidences/
        $path = $file->storeAs('public/sigac/evidences', $filename);
        // Ruta accesible públicamente (storage/sigac/evidences/...)
        $evidencePath = str_replace('public/', 'storage/', $path);
    }

    // Paso 7: Preparar datos para guardar
    $data = [
        'person_id' => Auth::user()->person_id,
        'date' => $request->date,
        'time_start' => $request->time_start,
        'time_finish' => $request->time_finish,
        'permission_reason' => $reason,
        'permission_detail' => $detail,
        'evidence_url' => $evidencePath, // se guarda la ruta pública
        'instructor_id' => $request->instructor_id,
        'course_id' => $request->course_id,
    ];

    // Paso 8: Guardar en la base de datos
    $permiso = ApprenticePermission::create($data);

    // Paso 9: Redirigir con éxito
    return redirect()->back()->with('success', 'Permiso registrado correctamente.');
}public function statuses(Request $request)
{
    $user = Auth::user();
    $person = $user->person;

    $query = ApprenticePermission::with([
        'permissionValidations' => function ($q) {
            $q->with('validator');
        }
    ])->where('person_id', $person->id);

    // 🔹 Filtros por rango de fechas
    if ($request->filled('from')) {
        $query->whereDate('date', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('date', '<=', $request->to);
    }

    // 🔹 Obtenemos los permisos
    $permissions = $query->latest()->get();

    // 🔹 Traducciones de estado
    $statusTranslations = [
        'earring'   => 'Pendiente',
        'approved'  => 'Aprobado',
        'rejected'  => 'Rechazado',
        'process'   => 'En Proceso',
        'cancelled' => 'Cancelado',
    ];

    // 🔹 Calculamos el estado final
    foreach ($permissions as $permission) {
        $validations = $permission->permissionValidations;
        $totalValidations = $validations->count();
        $approvedCount = $validations->where('validation_status', 'approved')->count();
        $rejectedCount = $validations->where('validation_status', 'rejected')->count();
        $pendingCount = $validations->where('validation_status', 'earring')->count();

        // 🔸 1. Cancelado
        if ($permission->status === 'cancelled') {
            $permission->final_status = 'cancelled';

        // 🔸 2. Rechazado (si el registro principal o alguna validación está rechazada)
        } elseif ($permission->status === 'rejected' || $rejectedCount > 0) {
            $permission->final_status = 'rejected';

        // 🔸 3. Aprobado (si el registro principal está aprobado y todas las validaciones también)
        } elseif (
            $permission->status === 'approved' &&
            $totalValidations > 0 &&
            $approvedCount === $totalValidations
        ) {
            $permission->final_status = 'approved';

        // 🔸 4. En proceso (si hay validaciones hechas pero aún faltan por aprobar)
        } elseif ($totalValidations > 0 && ($approvedCount < $totalValidations)) {
            $permission->final_status = 'process';

        // 🔸 5. Pendiente (si no tiene validaciones o no se ha iniciado proceso)
        } else {
            $permission->final_status = 'earring';
        }

        // 🔹 Traducción del estado final
        $permission->final_status_translated =
            $statusTranslations[$permission->final_status] ?? ucfirst($permission->final_status);
    }

    // 🔹 Filtro por estado final (si se selecciona desde la vista)
    if ($request->filled('status')) {
        $permissions = $permissions->filter(fn($p) => $p->final_status === $request->status);
    }

    return view('sigac::LeaveRequests.apprentice.permissions.Leave_Request_Statuses', [
        'titlePage' => 'Permisos',
        'titleView' => 'Estado de solicitudes',
        'permissions' => $permissions,
    ]);
}


        
        
    
public function cancel($id)
{
    $permission = ApprenticePermission::findOrFail($id);

    $createdAt = $permission->created_at;
    $now = now();
    $diffHours = $createdAt->diffInHours($now);

    $status = $permission->status;

    // ❌ Si fue rechazado, no puede cancelar nunca
    if ($status === 'rejected') {
        return redirect()->back()->with('error', 'No puedes cancelar esta solicitud porque fue rechazada.');
    }

    // ❌ Si fue aprobado y pasaron 24 horas, tampoco puede cancelar
    if ($status === 'approved' && $diffHours >= 24) {
        return redirect()->back()->with('error', 'No puedes cancelar esta solicitud porque ya fue aprobada hace más de 24 horas.');
    }

    // ✅ Si no fue validado o fue aprobado hace menos de 24h, se permite cancelar
    $permission->status = 'cancelled';
    $permission->save();

    return redirect()->back()->with('success', 'La solicitud fue cancelada correctamente.');
}




    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sigac::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sigac::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sigac::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
