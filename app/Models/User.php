<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Traits\UserTrait;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements Auditable
{

    use SoftDeletes, // Borrado suave
        HasApiTokens, // Trait que permite la autenticación del usuario a través de tokens API.
        Notifiable, // Trait que permite el envío de notificaciones a través de diferentes canales, como correo electrónico, SMS y notificaciones push.
        UserTrait, // Trait para validar permisos defenidos o full_access del usuario
        \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'nickname',
        'person_id',
        'email',
        'image',
        'password',
    ];

    protected $hidden = [ // Atributos ocultos
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $casts = [ // Serialización o casteo de atributos (define en qué forma se debe recuperar el dato de la base de datos)
        'email_verified_at' => 'datetime'
    ];

    protected $dates = [ // Atributos que deben ser tratados como objetos Carbon
        'deleted_at'
    ];

    // RELACIONES
    public function person(){ // Accede a la información de la persona asociada a este usuario
        return $this->belongsTo(Person::class);
    }
    public function roles(){ // Accede a todos los roles que pertenecen a este usuario (PIVOTE)
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    // CONFIGURACIONES PREESTABLECIDAS PARA MÉTODOS ELOQUENT
    /**
     * The "booting" method of the model.
     *
     * @return void
    */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (empty($user->password)) { // Verificar si se recibe una contraseña por defecto para así crear una por defecto
                $first_name = Str::ascii($user->person->first_name); // Eliminar caracteres especiales del nombre
                $first_last_name = Str::ascii($user->person->first_last_name); // Eliminar caracteres especiales del primer apellido
                $password = Hash::make( // Encriptar contraseña generada
                    ucfirst( // Convertir el primer caracter en mayúscula
                        strtolower( // Convertir todo en minúsculas
                            substr($first_name, 0, 2) // Extraer los dos primeros caracteres del nombre
                            .substr($first_last_name, 0, 2) // Extraer los dos primeros caracteres del primer apellido
                            .substr($user->person->document_number, -4) // Extraer los cuatro últimos caracteres del número de documento
                        )
                    )
                );
                $user->password =$password;

                // Obtener el ID de usuario
                $user_id =$user->person->id;

                // Guardar la contraseña en la sesión asociada al ID de usuario
                session(['passwords.' . $user_id => $password]);

                // Acceder a la contraseña del usuario actual
                $password = session('passwords.' . $user_id);
       
            }
        });
    }

}
