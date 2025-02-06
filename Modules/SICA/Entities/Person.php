<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\EVS\Entities\Jury;
use Modules\EVS\Entities\Authorized;
use App\Models\User;
use Modules\HDC\Entities\FamilyPersonFootprint;
use Modules\SICA\Entities\Event;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
use Modules\SIGAC\Entities\AcademicProgramming;
use Modules\SIGAC\Entities\Attendance;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\RequestExternal;
use Modules\AGROCEFA\Entities\Executor;
use Modules\SIGAC\Entities\CompetencePerson;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\InstitucionalRequest;
use Modules\SIGAC\Entities\Profession;
use Modules\SIGAC\Entities\AttendanceApprentice;
use Modules\SIGAC\Entities\EvaluativeJudgment;
use Modules\PQRS\Entities\Pqrs;
class Person extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'document_type',
        'document_number',
        'date_of_issue',
        'first_name',
        'first_last_name',
        'second_last_name',
        'date_of_birth',
        'blood_type',
        'gender',
        'eps_id',
        'marital_status',
        'military_card',
        'socioeconomical_status',
        'sisben_level',
        'address',
        'telephone1',
        'telephone2',
        'telephone3',
        'personal_email',
        'misena_email',
        'sena_email',
        'avatar',
        'biometric_code',
        'population_group_id',
        'pension_entity_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function getAgeAttribute(){ // Obtener la edad actual a partir de la fecha nacimiento (ACCESOR)
        if($this->date_of_birth!=''):
            $dias = explode("-", $this->date_of_birth, 3);
            $dias = mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
            $edad = (int)((time()-$dias)/31556926 );
            return $edad;
        else:
            return "--";
        endif;
    }
    public function getFullNameAttribute(){ // Obtener el nombre completo de la persona first_name + first_last_name + second_last_name (ACCESOR)
        return $this->first_name.' '.$this->first_last_name.' '.$this->second_last_name;
    }
    public function getIdentificationTypeNumberAttribute(){ // Obtener de manera abreviada del tipo y número de identificación
        // Arreglo de mapeo entre tipos de documentos y sus abreviaturas
        $document_type_abbreviations = [
            'Cédula de ciudadanía' => 'CC',
            'Tarjeta de identidad' => 'TI',
            'Cédula de extranjería' => 'CE',
            'Pasaporte' => 'PP',
            'Documento nacional de identidad' => 'DNI',
            'Registro civil' => 'RC',
            'Número de Identificación Tributaria' => 'NIT'
        ];
        return $document_type_abbreviations[$this->attributes['document_type']].'-'.$this->attributes['document_number'];
    }
    public function setAddressAttribute($value){ // Convierte el primer carácter en mayúscula del dato address (MUTADOR)
        $this->attributes['address'] = ucfirst($value);
    }
    public function setFirstLastNameAttribute($value){ // Convertir a mayúsculas en valor del dato first_last_name (MUTADOR)
        return $this->attributes['first_last_name'] = mb_strtoupper($value);
    }
    public function setFirstNameAttribute($value){ // Convertir a mayúsculas en valor del dato first_name (MUTADOR)
        return $this->attributes['first_name'] = mb_strtoupper($value);
    }
    public function setSecondLastNameAttribute($value){ // Convertir a mayúsculas en valor del dato second_last_name (MUTADOR)
        return $this->attributes['second_last_name'] = mb_strtoupper($value);
    }

    public function setFirstLastNameAttributeNIT($value){// Establecer first_last_name como null cuando el tipo de documento sea "Número de Identificación Tributaria"
        if ($this->document_type === 'Número de Identificación Tributaria') {
            $this->attributes['first_last_name'] = null;
        } else {
            $this->attributes['first_last_name'] = mb_strtoupper($value);
        }
    }

    // RELACIONES
    public function academic_programmings(){ // Accede a todos los registros de programaciones academicas asociadas a este persona designada como instructor
        return $this->hasMany(AcademicProgramming::class, 'instructor_id');
    }
    public function apprentices(){ // Accede a todos aprendices que han sido asociados con esta persona
        return $this->hasMany(Apprentice::class);
    }
    public function attendances(){ // Accede a todos aprendices que han sido asociados con esta persona
        return $this->hasMany(Attendance::class);
    }
    public function attendance_apprentices()
    {
        return $this->hasMany(AttendanceApprentice::class);
    }
    public function authorizeds(){ // Accede a todas los registros de las personas que han sido autorizados para votar
        return $this->hasMany(Authorized::class);
    }
    public function cash_counts(){ // Accede a todas las sesiones de caja asociados a esta persona
        return $this->hasMany(CashCount::class);
    }
    public function courses(){ // Accede a todos los cursos que han sido asociados con esta persona
        return $this->hasMany(Course::class);
    }
    public function evaluative_judgments(){ // Accede a todos los juicios evaluativos de esta persona
        return $this->hasMany(EvaluativeJudgment::class);
    }
    public function learning_outcomes(){ //Accede a todas los resultados de aprendizaje que pertenecen a este perfil (PIVOTE)
        return $this->belongsToMany(LearningOutcome::class, 'learning_outcome_people');
    }
    public function learning_outcome_people(){ // Accede a todos los registros de contratistas que le pertenecen a esta persona
        return $this->hasMany(LearningOutcomePerson::class);
    }
    public function contractors(){ // Accede a todos los registros de contratistas que le pertenecen a esta persona
        return $this->hasMany(Contractor::class);
    }
    public function supervisor_contractors(){ // Accede a todos los registros de supervisores de contratación que le pertenecen a esta persona
        return $this->hasMany(Contractor::class, 'supervisor_id');
    }
    public function employees(){ // Accede a todos los registros de empleados que pertenecen a esta persona
        return $this->hasMany(Employee::class);
    }
    public function e_p_s(){ // Accede a la EPS que se encuentra asociado(a)
        return $this->belongsTo(EPS::class, 'eps_id'); // Se debe agregar el campo eps_id de people para que la convensión no lo tome como e_p_s_id
    }
    public function events(){ // Accede a todos los eventos que ha asistido esta persona (PIVOTE)
        return $this->belongsToMany(Event::class, 'event_attendances')->withTimestamps();
    }
    public function executors(){
        return $this->hasMany(Executor::class,);
    }
    public function farms(){ // Accede a todas las granjas que lidera esta persona
        return $this->hasMany(Farm::class);
    }
    public function familypersonfootprints(){ // Accede a todas las familias que consumen este recuerso
        return $this->hasMany(FamilyPersonFootprint::class);
    }
    public function formulations(){ // Accede a todos los registros de formulaciones que tiene esta persona.
        return $this->hasMany(Formulation::class);
    }
    public function inventories(){ // Accede a todos los registros de inventarios que estan a cargo de esta persona
        return $this->hasMany(Inventory::class);
    }
    public function institucional_requests(){
        return $this->hasMany(InstitucionalRequest::class);
    }
    public function instructor_programs(){ // Accede a todas las programaciones de este instructor
        return $this->hasMany(InstructorProgram::class);
    }
    public function juries(){ // Accede a todos los jurados que están registrados con esta persona
        return $this->hasMany(Jury::class);
    }
    public function labors(){ // Accede a todas las labores que han sido asignados a esta persona
        return $this->hasMany(Labor::class);
    }
    public function movement_responsibilities(){ // Accede a todos los registros de responsables de movimiento que ha sido participe esta persona
        return $this->hasMany(MovementResponsibility::class);
    }
    public function municipality_events(){ // Accede a todos los registros de eventos en municipios que le pertenecen a esta persona
        return $this->hasMany(MunicipalityEvent::class);
    }
    public function pension_entity(){ // Accede a la entidad de pensiones al que pertenece
        return $this->belongsTo(PensionEntity::class);
    }
    public function population_group(){ // Accede al grupo poblacional que pertenece
        return $this->belongsTo(PopulationGroup::class);
    }
    public function pqrs(){ // Accede a todos los pqrs que pertenecen a esta persona (PIVOTE)
        return $this->belongsToMany(Pqrs::class)->withPivot('date_time', 'type')->withTimestamps();
    }
    public function productive_units(){ // Accede a todas las unidades productivas que lidera esta persona
        return $this->hasMany(ProductiveUnit::class);
    }
    public function professions(){ //Accede a todas las profesiones que tiene esta persona.
        return $this->belongsToMany(Profession::class, 'person_professions');
    }
    public function request_externals(){ // Accede a todas las solicitudes externas que le pertenecen esta persona
        return $this->hasMany(RequestExternal::class);
    }
    public function tecnomecanics(){ // Accede a todas las unidades productivas que lidera esta persona
         return $this->hasMany(Tecnomecanic::class);
     }
    public function users(){ // Accede a todos los usuarios registrados con esta persona
        return $this->hasMany(User::class);
    }
    


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\PersonFactory::new();
    }

}
