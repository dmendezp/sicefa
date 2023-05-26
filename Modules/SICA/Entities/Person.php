<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\Apprentice;
use Modules\EVS\Entities\Jury;
use Modules\EVS\Entities\Authorized;
use App\Models\User;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Event;

class Person extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    use HasFactory; // Generación de datos de prueba

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
        'population_group_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setFirstNameAttribute($value){ // Convertir a mayúsculas en valor del dato first_name (MUTADOR)
        return $this->attributes['first_name'] = mb_strtoupper($value);
    }
    public function setFirstLastNameAttribute($value){ // Convertir a mayúsculas en valor del dato first_last_name (MUTADOR)
        return $this->attributes['first_last_name'] = mb_strtoupper($value);
    }
    public function setSecondLastNameAttribute($value){ // Convertir a mayúsculas en valor del dato second_last_name (MUTADOR)
        return $this->attributes['second_last_name'] = mb_strtoupper($value);
    }
    public function setAddressAttribute($value){ // Convierte el primer carácter en mayúscula del dato address (MUTADOR)
        $this->attributes['address'] = ucfirst($value);
    }
    public function getFullNameAttribute(){ // Obtener el nombre completo de la persona first_name + first_last_name + second_last_name (ACCESOR)
        return $this->first_name.' '.$this->first_last_name.' '.$this->second_last_name;
    }
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

    // RELACIONES
    public function e_p_s(){ // Accede a la EPS que se encuentra asociado(a)
        return $this->belongsTo(EPS::class, 'eps_id'); // Se debe agregar el campo eps_id de people para que la convensión no lo tome como e_p_s_id
    }
    public function population_group(){ // Accede al grupo poblacional que pertenece
        return $this->belongsTo(PopulationGroup::class);
    }
    public function users(){ // Accede a todos los usuarios registrados con esta persona
        return $this->hasMany(User::class);
    }
    public function apprentices(){ // Accede a todos los registros de aprendices que han sido asociados a esta persona
        return $this->hasMany(Apprentice::class);
    }
    public function authorizeds(){ // Accede a todas los registros de las personas que han sido autorizados para votar
        return $this->hasMany(Authorized::class);
    }
    public function juries(){ // Accede a todos los jurados que están registrados con esta persona
        return $this->hasMany(Jury::class);
    }
    public function productive_units(){ // Accede a todas las unidades productivas que tiene a cargo
        return $this->hasMany(ProductiveUnit::class);
    }
    public function events(){ // Accede a todos los eventos que se le han sigdo asignados
        return $this->belongsToMany(Event::class, 'event_attendances')->withTimestamps();
    }
    public function inventories(){ // Accede a todos los registros de inventarios que están relacionados con esta persona
        return $this->hasMany(Inventory::class);
    }
    public function movement_responsabilities(){ // Accede a todos los registros de responsables de movimiento que esten asociados con esta persona
        return $this->hasMany(MovementResponsability::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\PersonFactory::new();
    }

}
