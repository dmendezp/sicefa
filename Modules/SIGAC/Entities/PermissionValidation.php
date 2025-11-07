<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionValidation extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'apprentice_permission_id',
        'validated_by',
        'validator_role',
        'validation_status',
        'observation',
        'validated_at',
    ];

    /**
     * Relación con el permiso del aprendiz.
     * Un registro de validación pertenece a un permiso.
     */
    public function apprenticePermission()
    {
        return $this->belongsTo(ApprenticePermission::class, 'apprentice_permission_id');
    }

    /**
     * Relación con la persona que valida (instructor, coordinación, etc.).
     */
  public function validator()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Person::class, 'validated_by');
    }

    /**
     * Accessor para mostrar un estado con estilo o traducción legible.
     * (Opcional: útil si planeas mostrarlo en vistas)
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->validation_status) {
            'approved' => 'Aprobado',
            'rejected' => 'Rechazado',
            'earring'  => 'Pendiente',
            default    => 'Desconocido',
        };
    }

    /**
     * Factory para pruebas o seeds automáticos.
     */
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\PermissionValidationFactory::new();
    }

protected static function booted()
{
    static::deleting(function ($validation) {
        $permission = $validation->apprenticePermission;
        if ($permission) {
            // Si se elimina la validación, se devuelve a estado pendiente
            $permission->status = 'earring';
            $permission->save();
        }
    });
}




}
