<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use App\Models\User;
use Modules\SIGAC\Entities\Profession;

class Administrator extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'administrators';

    protected $fillable = [
        'person_id',
        'profession_id',
        'user_id',
        'research_skills',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relación con la tabla people (uno a uno).
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Relación con la tabla users (uno a uno).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con la tabla professions (uno a uno).
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    /**
     * Sincroniza el rol por defecto 'sia.admin' con el usuario asociado.
     */
    public function syncDefaultRole()
    {
        $role = \Modules\SICA\Entities\Role::where('slug', 'sia.admin')->first();
        if ($role && $this->user) {
            $this->user->syncRoles([$role->id]);
        }
    }

    /**
     * Método para eliminar lógicamente el registro y su relación con el usuario.
     */
    public function remove()
    {
        if ($this->delete()) {
            if ($this->user) {
                $this->user->delete();
            }
            return true;
        }
        return false;
    }

    /**
     * Muestra la información del administrador.
     */
    public function mostrarInformacion()
    {
        return [
            'tipo_documento' => $this->person->document_type ?? trans('sia::general.not_defined'),
            'numero_documento' => $this->person->document_number ?? trans('sia::general.not_defined'),
            'nombre_completo' => $this->person->fullName ?? trans('sia::general.not_defined'),
            'genero' => $this->person->gender ?? trans('sia::general.not_defined'),
            'numero_celular' => $this->person->telephone1 ?? trans('sia::general.not_defined'),
            'profesion' => $this->profession->name ?? trans('sia::general.not_defined'),
            'correo' => $this->user->email ?? trans('sia::general.not_defined'),
            'habilidades_investigacion' => $this->research_skills ?? trans('sia::general.not_defined'),
        ];
    }
}