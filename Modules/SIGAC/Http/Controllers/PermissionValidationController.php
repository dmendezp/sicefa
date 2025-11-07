<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SIGAC\Entities\ApprenticePermission;
use Modules\SIGAC\Entities\PermissionValidation;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\Intern;
use Modules\SIGAC\Entities\BoardingSchool;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PermissionValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $person = $user->person;

        if (!$person) {
            return view('sigac::reports.instructors.permission_request.index', [
                'titlePage' => 'Permisos',
                'titleView' => 'Solicitud de Permisos',
                'permissions' => collect(),
            ]);
        }

        $roleName = $user->roles()->pluck('name')->first();
        $permissions = collect();
        $viewPath = '';

        switch ($roleName) {

            // =====================================================
            // 🟩 INSTRUCTOR → permisos de aprendices que le pertenecen
            // =====================================================
            case 'Instructor':
                $permissions = ApprenticePermission::with(['permissionValidations', 'person'])
                    ->where('instructor_id', $person->id)
                    ->whereDoesntHave('permissionValidations', function ($query) use ($person) {
                        $query->where('validated_by', $person->id)
                            ->whereIn('validation_status', ['approved', 'rejected']);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();


                $viewPath = 'sigac::LeaveRequests.instructors.permission_request.index';
                break;

            // =====================================================
            // 🟦 TUTOR → permisos de sus pasantes activos según fechas del permiso
            // =====================================================
            case 'Tutor':
                $permissions = ApprenticePermission::with(['permissionValidations', 'person.intern'])
                    ->whereHas('person.intern', function ($query) use ($person) {
                        $query->where('assigned_supervisor_id', $person->id)
                            ->whereColumn('start_date', '<=', 'apprentice_permissions.date')
                            ->whereColumn('end_date', '>=', 'apprentice_permissions.date');
                    })
                    ->whereDoesntHave('permissionValidations', function ($query) use ($person) {
                        $query->where('validated_by', $person->id)
                            ->whereIn('validation_status', ['approved', 'rejected']);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

                $viewPath = 'sigac::LeaveRequests.tutor.permission_request.index';
                break;

            // =====================================================
            // 🟧 BIENESTAR → ve permisos que requieren su validación o pendientes
            // =====================================================
            case 'Bienestar':
                $permissions = ApprenticePermission::with(['permissionValidations', 'person.intern'])
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->filter(function ($permission) {
                        // Debe estar aprobado por Instructor o Tutor
                        $validatedByInstructor = $permission->permissionValidations
                            ->whereIn('validator_role', ['Instructor', 'Tutor'])
                            ->where('validation_status', 'approved')
                            ->isNotEmpty();

                        if (!$validatedByInstructor) {
                            return false;
                        }

                        $person = $permission->person;
                        if (!$person) return false;

                        // Permiso dentro del internado
                        $isBoardingActive = false;
                        if (!empty($permission->date)) {
                            $isBoardingActive = \Modules\SIGAC\Entities\BoardingSchool::where('person_id', $person->id)
                                ->whereDate('start_date', '<=', $permission->date)
                                ->whereDate('end_date', '>=', $permission->date)
                                ->exists();
                        }

                        // Documentos menores de edad
                        $docType = mb_strtolower($person->document_type ?? '', 'UTF-8');
                        $minorDocuments = ['tarjeta de identidad', 'registro civil'];
                        $isMinor = in_array($docType, $minorDocuments);

                        // Razones especiales
                        $reason = mb_strtolower($permission->permission_reason ?? '', 'UTF-8');
                        $specialReasons = ['cita médica', 'enfermedad'];
                        $hasSpecialReason = in_array($reason, $specialReasons);

                        // ✅ Si Bienestar ya validó, no mostrar
                        $alreadyValidatedByWellbeing = $permission->permissionValidations
                            ->where('validator_role', 'Bienestar')
                            ->isNotEmpty();

                        if ($alreadyValidatedByWellbeing) return false;

                        return $isBoardingActive || $isMinor || $hasSpecialReason;
                    });

                $viewPath = 'sigac::LeaveRequests.wellbeing.permission_request.index';
                break;

            // =====================================================
            // 🟨 COORDINADOR ACADÉMICO → permisos listos para validación
            // =====================================================
            case 'Coordinador Académico':
                $permissions = ApprenticePermission::with(['permissionValidations', 'person'])
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->filter(function ($permission) {
                        $validations = $permission->permissionValidations;

                        // Verifica si el permiso ya ha sido aprobado por el Coordinador Académico
                        $approvedByCoordinator = $validations
                            ->where('validator_role', 'Coordinador Académico')
                            ->where('validation_status', 'approved')
                            ->isNotEmpty();

                        // Si ya fue validado por Coordinación, lo excluimos
                        if ($approvedByCoordinator) {
                            return false;
                        }

                        $approvedByInstructorOrTutor = $validations
                            ->whereIn('validator_role', ['Instructor', 'Tutor'])
                            ->where('validation_status', 'approved')
                            ->isNotEmpty();

                        $approvedByWellbeing = $validations
                            ->where('validator_role', 'Bienestar')
                            ->where('validation_status', 'approved')
                            ->isNotEmpty();

                        // 🔹 Aquí está el cambio: antes decía 'Coordinacion'
                        $pendingCoordinator = !$validations
                            ->where('validator_role', 'Coordinador Académico')
                            ->isNotEmpty();

                        $person = $permission->person;
                        if (!$person) return false;

                        // 🔹 Normalizamos los textos
                        $docType = mb_strtolower($person->document_type ?? '', 'UTF-8');
                        $reason = mb_strtolower($permission->permission_reason ?? '', 'UTF-8');

                        $minorDocs = ['tarjeta de identidad', 'registro civil'];
                        $isMinor = in_array($docType, $minorDocs);

                        $hasBoarding = \Modules\SIGAC\Entities\BoardingSchool::where('person_id', $person->id)
                            ->whereDate('start_date', '<=', $permission->date)
                            ->whereDate('end_date', '>=', $permission->date)
                            ->exists();

                        $specialReasons = ['cita médica', 'enfermedad'];
                        $requiresWellbeing = $isMinor || $hasBoarding || in_array($reason, $specialReasons);

                        if ($requiresWellbeing) {
                            return $approvedByInstructorOrTutor && $approvedByWellbeing && $pendingCoordinator;
                        } else {
                            return $approvedByInstructorOrTutor && $pendingCoordinator;
                        }
                    });

                $viewPath = 'sigac::LeaveRequests.coordinator.permission_request.index';
                break;


            default:
                $viewPath = 'sigac::LeaveRequests.instructors.permission_request.index';
                break;
        }

        // 🔄 Actualización automática de estado a “earring” si no tiene validaciones
        foreach ($permissions as $permission) {
            if ($permission->permissionValidations->isEmpty() && $permission->status !== 'earring') {
                $permission->status = 'earring';
                $permission->save();
            }
        }



        return view($viewPath, [
            'titlePage' => 'Permisos',
            'titleView' => 'Solicitud de Permisos',
            'permissions' => $permissions,
        ]);
    }


    public function index_security_personnel(Request $request)
    {
        // 🔹 Filtro por fecha ("today" o todos)
        $dateFilter = $request->get('filter', ''); // nuevo parámetro para el filtro de fecha

        // 🔹 Filtro por estado (mantiene tu lógica original)
        $statusFilter = $request->get('status', 'approved');

        $permissions = \Modules\SIGAC\Entities\PermissionValidation::select(
            'permission_validations.*',
            'ap.date as date',
            'ap.time_start as time_start',
            'ap.time_finish as time_finish',
            'ap.status as ap_status',
            'ap.person_id as ap_person_id',
            'ap.instructor_id as ap_instructor_id',
            'ap.course_id as ap_course_id'
        )
            ->join('apprentice_permissions as ap', 'ap.id', '=', 'permission_validations.apprentice_permission_id')
            ->where('permission_validations.validation_status', 'approved')
            ->where('ap.status', 'approved');

        // 🔹 Si el usuario selecciona "Hoy", filtramos por la fecha actual
        if ($dateFilter === 'today') {
            $permissions->whereDate('ap.date', \Carbon\Carbon::today()->toDateString());
        }

        $permissions = $permissions
            ->orderBy('permission_validations.validated_at', 'desc')
            ->get();

        return view('sigac::LeaveRequests.security_personnel.index', [
            'titlePage' => 'Historial de Permisos Aprobados',
            'titleView' => 'Permisos Aprobados (Seguridad)',
            'permissions' => $permissions,
            'statusFilter' => $statusFilter,
            'filter' => $dateFilter, // pasamos también el filtro de fecha a la vista
        ]);
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
    public function store(Request $request)
    {
        $request->validate([
            'apprentice_permission_id' => 'required|exists:apprentice_permissions,id',
            'validation_status' => 'required|in:approved,rejected',
            'observation' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $person = $user->person;
        $permission = ApprenticePermission::findOrFail($request->apprentice_permission_id);

        \Log::info('Inicio store', [
            'user_id' => $user->id,
            'person_id' => $person->id,
            'permission_id' => $permission->id,
            'permission_status' => $permission->status,
        ]);

        // 🧠 Determinar rol del validador
        $getValidatorRoleForPermission = function ($user, $permission) {
            $roleName = $user->roles()->pluck('name')->first();
            $person = $user->person;

            if ($roleName === 'Tutor') {
                $permissionDate = date('Y-m-d', strtotime($permission->date));
                $isTutor = \Modules\SIGAC\Entities\Intern::where('person_id', $permission->person_id)
                    ->where('assigned_supervisor_id', $person->id)
                    ->whereDate('start_date', '<=', $permissionDate)
                    ->whereDate('end_date', '>=', $permissionDate)
                    ->exists();
                if ($isTutor) return 'Tutor';
            }

            if ($roleName === 'Instructor' && $permission->instructor_id === $person->id) {
                return 'Instructor';
            }

            if (in_array($roleName, ['Bienestar', 'Coordinador Académico'])) {
                return $roleName;
            }

            return $roleName;
        };

        $validatorRole = $getValidatorRoleForPermission($user, $permission);

        // 🧾 Guardar o actualizar validación
        PermissionValidation::updateOrCreate(
            [
                'apprentice_permission_id' => $permission->id,
                'validated_by' => $person->id,
            ],
            [
                'validator_role' => $validatorRole,
                'validation_status' => $request->validation_status,
                'observation' => $request->observation,
                'validated_at' => now(),
            ]
        );

        // 🔄 FORZAR recarga para asegurar datos actualizados
        sleep(1); // micro pausa opcional para BD lentas
        $permission->refresh();
        $validations = PermissionValidation::where('apprentice_permission_id', $permission->id)->get();

        // 🧠 Condiciones especiales
        $personData = \Modules\SICA\Entities\Person::find($permission->person_id);
        $permissionDate = date('Y-m-d', strtotime($permission->date));

        $isPermissionDateInInternship = \Modules\SIGAC\Entities\Intern::where('person_id', $permission->person_id)
            ->whereDate('start_date', '<=', $permissionDate)
            ->whereDate('end_date', '>=', $permissionDate)
            ->exists();

        $isBoardingActive = \Modules\SIGAC\Entities\BoardingSchool::where('person_id', $permission->person_id)
            ->whereDate('start_date', '<=', $permissionDate)
            ->whereDate('end_date', '>=', $permissionDate)
            ->exists();

        $isMinor = $personData && in_array($personData->document_type, ['Tarjeta de identidad', 'Registro civil']);
        $hasSpecialReason = in_array($permission->permission_reason, ['Cita médica', 'Enfermedad']);
        $requiresWellbeing = $isBoardingActive || $isMinor || $hasSpecialReason;

        // ⚙️ Roles requeridos
        if ($isPermissionDateInInternship) {
            $requiredRoles = $requiresWellbeing
                ? ['Tutor', 'Bienestar', 'Coordinador Académico']
                : ['Tutor', 'Coordinador Académico'];
        } else {
            $requiredRoles = $requiresWellbeing
                ? ['Instructor', 'Bienestar', 'Coordinador Académico']
                : ['Instructor', 'Coordinador Académico'];
        }

        // Normalizar
        $normalize = fn($roles) => array_map(
            fn($r) => strtolower(str_replace(
                ['á', 'é', 'í', 'ó', 'ú', 'ñ'],
                ['a', 'e', 'i', 'o', 'u', 'n'],
                trim($r)
            )),
            $roles
        );

        // Roles detectados
        $approvedRoles = $normalize($validations->where('validation_status', 'approved')->pluck('validator_role')->toArray());
        $rejectedRoles = $normalize($validations->where('validation_status', 'rejected')->pluck('validator_role')->toArray());
        $requiredRolesLower = $normalize($requiredRoles);

        // 🚦 Nuevo estado
        if (!empty($rejectedRoles)) {
            $newStatus = 'rejected';
        } elseif (empty(array_diff($requiredRolesLower, $approvedRoles))) {
            $newStatus = 'approved';
        } else {
            $newStatus = 'earring';
        }

        // 💾 Actualizar permiso
        if ($permission->status !== $newStatus) {
            $permission->update(['status' => $newStatus]);
            \Log::info('✅ Estado de permiso actualizado', [
                'permission_id' => $permission->id,
                'nuevo_estado' => $newStatus,
            ]);
        } else {
            \Log::info('⚠️ El estado NO se actualizó porque es igual al actual', [
                'estado_actual' => $permission->status,
                'estado_evaluado' => $newStatus,
            ]);
        }

        // 🧪 Log detalle
        \Log::info('🧪 PRUEBA DE VALIDACIÓN', [
            'permission_id' => $permission->id,
            'estado_actual' => $permission->status,
            'estado_nuevo' => $newStatus,
            'roles_requeridos_originales' => $requiredRoles,
            'roles_aprobados_normalizados' => $approvedRoles,
            'roles_rechazados_normalizados' => $rejectedRoles,
            'rol_validador_actual' => $validatorRole,
            'validation_status_enviado' => $request->validation_status,
        ]);

        return back()->with('success', 'Validación registrada y estado actualizado correctamente.');
    }





    //VISTAS PARA LOS HISTORIALES DE INSTRUCTOR,TUTOR,BIENESTAR,COORDINACION ACADEMICA.

    // LAS VISTAS DEL HISTORIAL DE CADA ROL

    public function instructorValidationHistory(Request $request)
    {
        $user = Auth::user();
        $person = $user->person;

        // Filtro por estado
        $statusFilter = $request->get('status'); // 'approved' | 'rejected' | null

        $query = \Modules\SIGAC\Entities\PermissionValidation::with([
            'apprenticePermission.person', // aprendiz
            'apprenticePermission.course', // curso (si aplica)
        ])
            ->where('validator_role', 'Instructor')
            ->where('validated_by', $person->id)
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->orderBy('validated_at', 'desc');

        if ($statusFilter) {
            $query->where('validation_status', $statusFilter);
        }

        $permissions = $query->get();

        return view('sigac::LeaveRequests.instructors.permission_request.validation-history', [
            'titlePage' => 'Historial de Permisos',
            'titleView' => 'Validaciones Realizadas',
            'permissions' => $permissions,
            'statusFilter' => $statusFilter,
        ]);
    }


    // -------------------------------------------------------------
    //                       🔹 TUTOR
    // -------------------------------------------------------------


    public function tutorValidationHistory(Request $request)
    {
        $user = Auth::user();
        $person = $user->person;

        // Filtro por estado
        $statusFilter = $request->get('status'); // 'approved' | 'rejected' | null

        $query = \Modules\SIGAC\Entities\PermissionValidation::with([
            'apprenticePermission.person', // aprendiz
            'apprenticePermission.course', // curso (si aplica)
        ])
            ->where('validator_role', 'tutor')
            ->where('validated_by', $person->id)
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->orderBy('validated_at', 'desc');

        if ($statusFilter) {
            $query->where('validation_status', $statusFilter);
        }

        $permissions = $query->get();

        return view('sigac::LeaveRequests.tutor.permission_request.validation-history', [
            'titlePage' => 'Historial de Permisos',
            'titleView' => 'Validaciones Realizadas',
            'permissions' => $permissions,
            'statusFilter' => $statusFilter,
        ]);
    }



    // BIENESTAR


    public function wellnessValidationHistory(Request $request)
    {

        $user = Auth::user();
        $person = $user->person;

        // Filtro por estado
        $statusFilter = $request->get('status'); // 'approved' | 'rejected' | null

        $query = \Modules\SIGAC\Entities\PermissionValidation::with([
            'apprenticePermission.person', // aprendiz
            'apprenticePermission.course', // curso (si aplica)
        ])
            ->where('validator_role', 'Bienestar')
            ->where('validated_by', $person->id)
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->orderBy('validated_at', 'desc');

        if ($statusFilter) {
            $query->where('validation_status', $statusFilter);
        }

        $permissions = $query->get();

        return view('sigac::LeaveRequests.wellbeing.permission_request.validation-history', [
            'titlePage' => 'Historial de Permisos',
            'titleView' => 'Validaciones Realizadas',
            'permissions' => $permissions,
            'statusFilter' => $statusFilter,
        ]);
    }




    //COOORDINACION ACADEMICA


    public function academicCoordinationValidationHistory(Request $request)
    {

        $user = Auth::user();
        $person = $user->person;

        // Filtro por estado
        $statusFilter = $request->get('status'); // 'approved' | 'rejected' | null

        $query = \Modules\SIGAC\Entities\PermissionValidation::with([
            'apprenticePermission.person', // aprendiz
            'apprenticePermission.course', // curso (si aplica)
        ])
            ->where('validator_role', 'Coordinador Académico')
            ->where('validated_by', $person->id)
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->orderBy('validated_at', 'desc');

        if ($statusFilter) {
            $query->where('validation_status', $statusFilter);
        }

        $permissions = $query->get();

        return view('sigac::LeaveRequests.coordinator.permission_request.validation-history', [
            'titlePage' => 'Historial de Permisos',
            'titleView' => 'Validaciones Realizadas',
            'permissions' => $permissions,
            'statusFilter' => $statusFilter,
        ]);
    }





    //SON LAS FUNCIONES EN SI PARA ACTUALIZAR LOS ESTADOS DE CADA PERMISO





    public function instructorUpdateValidation(Request $request, $id)
    {
        $request->validate([
            'validation_status' => 'required|in:approved,rejected,cancelled',
            'observation' => 'required_if:validation_status,rejected|max:1000',
        ]);

        $user = Auth::user();
        $person = $user->person;

        // Obtener la validación actual
        $validation = PermissionValidation::where('id', $id)
            ->where('validator_role', 'Instructor')
            ->where('validated_by', $person->id)
            ->firstOrFail();

        // Obtener el permiso asociado
        $permission = $validation->apprenticePermission;

        // ✅ Verificar si, para este permiso específico, los demás ya validaron
        $otherValidated = PermissionValidation::where('apprentice_permission_id', $permission->id)
            ->where('validator_role', '!=', 'Instructor')
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->exists();

        // ❌ Si otro ya validó, bloquear cambios
        if ($otherValidated) {
            return back()->with('error', 'No puedes modificar este permiso, ya fue validado por otro rol.');
        }

        // ✅ Si nadie más ha validado, el instructor puede modificar libremente
        $previousStatus = $validation->validation_status;

        $validation->update([
            'validation_status' => $request->validation_status,
            'observation' => $request->observation,
            'validated_at' => now(),
        ]);

        // 🔹 Actualizar el permiso principal solo si cambió algo
        if ($previousStatus !== $request->validation_status) {
            if ($request->validation_status === 'rejected') {
                $permission->status = 'rejected';
            } elseif ($request->validation_status === 'approved') {
                $permission->status = 'earring'; // sigue pendiente de los demás
            } elseif ($request->validation_status === 'cancelled') {
                $permission->status = 'cancelled';
            }
            $permission->save();
        }

        return back()->with('success', 'Validación actualizada correctamente.');
    }



    public function tutorUpdateValidation(Request $request, $id)
    {
        $request->validate([
            'validation_status' => 'required|in:approved,rejected,cancelled',
            'observation' => 'required_if:validation_status,rejected|max:1000',
        ]);

        $user = Auth::user();
        $person = $user->person;

        $validation = PermissionValidation::where('id', $id)
            ->where('validator_role', 'tutor')
            ->where('validated_by', $person->id)
            ->firstOrFail();

        // 🔹 Obtener el permiso principal
        $permission = $validation->apprenticePermission;

        // ✅ Verificar si otros roles ya validaron (aprobado o rechazado)
        $otherValidated = PermissionValidation::where('apprentice_permission_id', $permission->id)
            ->where('validator_role', '!=', 'tutor')
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->exists();

        // ❌ Bloquear actualización si otro rol ya validó
        if ($otherValidated) {
            return back()->with('error', 'No puedes modificar este permiso, ya fue validado por otro rol.');
        }

        // Guardar el estado anterior
        $previousStatus = $validation->validation_status;

        // Actualizar la validación actual
        $validation->update([
            'validation_status' => $request->validation_status,
            'observation' => $request->observation,
            'validated_at' => now(),
        ]);

        // 🔹 Solo modificar apprentice_permissions si cambió de estado
        if ($previousStatus !== $request->validation_status) {

            if ($request->validation_status === 'cancelled') {
                $permission->status = 'cancelled';
            } elseif ($request->validation_status === 'rejected') {
                $permission->status = 'rejected';
            } elseif ($previousStatus === 'rejected' && $request->validation_status === 'approved') {
                // Si pasa de rechazado a aprobado → vuelve a pendiente (earring)
                $permission->status = 'earring';
            }

            $permission->save();
        }

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    public function wellnessUpdateValidation(Request $request, $id)
    {
        $request->validate([
            'validation_status' => 'required|in:approved,rejected,cancelled',
            'observation' => 'required_if:validation_status,rejected|max:1000',
        ]);

        $user = Auth::user();
        $person = $user->person;

        $validation = PermissionValidation::where('id', $id)
            ->where('validator_role', 'Bienestar')
            ->where('validated_by', $person->id)
            ->firstOrFail();

        // 🔹 Obtener el permiso principal
        $permission = $validation->apprenticePermission;

        // ✅ Verificar si Coordinador Académico ya validó (aprobado o rechazado)
        $coordinatorValidated = PermissionValidation::where('apprentice_permission_id', $permission->id)
            ->where('validator_role', 'Coordinador Académico')
            ->whereIn('validation_status', ['approved', 'rejected'])
            ->exists();

        // ❌ Bloquear actualización si el Coordinador Académico ya validó
        if ($coordinatorValidated) {
            return back()->with('error', 'No puedes modificar este permiso, el Coordinador Académico ya lo validó.');
        }

        // Guardar el estado anterior
        $previousStatus = $validation->validation_status;

        // Actualizar la validación actual
        $validation->update([
            'validation_status' => $request->validation_status,
            'observation' => $request->observation,
            'validated_at' => now(),
        ]);

        // 🔹 Solo modificar apprentice_permissions si cambió de estado
        if ($previousStatus !== $request->validation_status) {
            if ($request->validation_status === 'cancelled') {
                $permission->status = 'cancelled';
            } elseif ($request->validation_status === 'rejected') {
                $permission->status = 'rejected';
            } elseif ($previousStatus === 'rejected' && $request->validation_status === 'approved') {
                // Si pasa de rechazado a aprobado → vuelve a pendiente (earring)
                $permission->status = 'earring';
            }

            $permission->save();
        }

        return back()->with('success', 'Estado actualizado correctamente.');
    }
    public function academicCoordinationUpdateValidation(Request $request, $id)
    {
        $request->validate([
            'validation_status' => 'required|in:approved,rejected,cancelled',
            'observation' => 'required_if:validation_status,rejected|max:1000',
        ]);

        $user = Auth::user();
        $person = $user->person;

        $validation = PermissionValidation::where('id', $id)
            ->where('validator_role', 'Coordinador Académico')
            ->where('validated_by', $person->id)
            ->firstOrFail();

        $permission = $validation->apprenticePermission;

        // 🔹 Fechas y hora actual
        $now = Carbon::now('America/Bogota');
        $permissionDate = Carbon::parse($permission->date, 'America/Bogota')->endOfDay(); // hasta medianoche del día del permiso

        // 🔸 Restringir modificación después de medianoche del día del permiso
        if ($now->greaterThan($permissionDate)) {
            return back()->with('error', 'No puedes modificar este permiso, ya ha pasado la medianoche del día de la solicitud.');
        }

        // 🧾 Guardar o actualizar la validación
        PermissionValidation::updateOrCreate(
            [
                'apprentice_permission_id' => $permission->id,
                'validated_by' => $person->id,
            ],
            [
                'validator_role' => 'Coordinador Académico',
                'validation_status' => $request->validation_status,
                'observation' => $request->observation,
                'validated_at' => $now,
            ]
        );

        // 🔄 Refrescar datos
        $permission->refresh();
        $validations = PermissionValidation::where('apprentice_permission_id', $permission->id)->get();

        // 🧠 Lógica de roles
        $personData = Person::find($permission->person_id);
        $permissionDateString = date('Y-m-d', strtotime($permission->date));

        $isPermissionDateInInternship = Intern::where('person_id', $permission->person_id)
            ->whereDate('start_date', '<=', $permissionDateString)
            ->whereDate('end_date', '>=', $permissionDateString)
            ->exists();

        $isBoardingActive = BoardingSchool::where('person_id', $permission->person_id)
            ->whereDate('start_date', '<=', $permissionDateString)
            ->whereDate('end_date', '>=', $permissionDateString)
            ->exists();

        $isMinor = $personData && in_array($personData->document_type, ['Tarjeta de identidad', 'Registro civil']);
        $hasSpecialReason = in_array($permission->permission_reason, ['Cita médica', 'Enfermedad']);
        $requiresWellbeing = $isBoardingActive || $isMinor || $hasSpecialReason;

        // Roles requeridos
        $requiredRoles = $isPermissionDateInInternship
            ? ($requiresWellbeing ? ['Tutor', 'Bienestar', 'Coordinador Académico'] : ['Tutor', 'Coordinador Académico'])
            : ($requiresWellbeing ? ['Instructor', 'Bienestar', 'Coordinador Académico'] : ['Instructor', 'Coordinador Académico']);

        // Normalizar roles
        $normalize = fn($roles) => array_map(
            fn($r) => strtolower(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ñ'], ['a', 'e', 'i', 'o', 'u', 'n'], trim($r))),
            $roles
        );

        $approvedRoles = $normalize($validations->where('validation_status', 'approved')->pluck('validator_role')->toArray());
        $rejectedRoles = $normalize($validations->where('validation_status', 'rejected')->pluck('validator_role')->toArray());
        $requiredRolesLower = $normalize($requiredRoles);

        // 🚦 Determinar nuevo estado
        if (!empty($rejectedRoles)) {
            $newStatus = 'rejected';
        } elseif (empty(array_diff($requiredRolesLower, $approvedRoles))) {
            $newStatus = 'approved';
        } else {
            $newStatus = 'earring';
        }

        // 💾 Actualizar estado del permiso
        if ($permission->status !== $newStatus) {
            $permission->update(['status' => $newStatus]);
        }

        return back()->with('success', 'Validación registrada y estado actualizado correctamente.');
    }
    public function showEvidence($permissionId)
    {
        // 1. Buscar el permiso
        $permission = ApprenticePermission::findOrFail($permissionId);

        if (empty($permission->evidence_url)) {
            abort(404, 'Este permiso no tiene evidencia asociada.');
        }

        // 2. Normalizar la ruta guardada
        $rawPath = str_replace('\\', '/', trim($permission->evidence_url));
        $rawPath = ltrim($rawPath, '/');

        // Limpiar prefijos posibles (por si en BD quedó algo largo)
        $prefixes = [
            'storage/app/public/sigac/',
            'storage/app/public/',
            'app/public/sigac/',
            'app/public/',
            'public/sigac/',
            'public/',
            'storage/sigac/',
            'storage/',
            'sigac/',
        ];

        foreach ($prefixes as $prefix) {
            if (Str::startsWith($rawPath, $prefix)) {
                $rawPath = substr($rawPath, strlen($prefix));
                break;
            }
        }

        // 3. Construir ruta física REAL en storage
        // Aquí asumimos que siempre queremos leer desde: storage/app/public/sigac
        $fullPath = storage_path('app/public/sigac/' . $rawPath);

        if (!File::exists($fullPath)) {
            abort(404, 'No se encontró el archivo de evidencia en el servidor.');
        }

        // 4. Detectar MIME y servir el archivo en modo "inline"
        $mimeType = File::mimeType($fullPath);
        $fileName = basename($fullPath);

        return response()->file($fullPath, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }






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
