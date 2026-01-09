<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class Animal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'breed_id',
        'sex',
        'birth_date',
        'entry_date',
        'weight_kg',
        'production_stage',
        'age_group',
        'inventory_value',
        'lot',
        'note',
        'body_condition',
        'observations',
        'photo_path'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'entry_date' => 'date',
        'inventory_value' => 'decimal:2',
        'weight_kg' => 'decimal:2',
    ];

    // === ACCESSORS ===
    public function getAgeInMonthsAttribute()
    {
        if (!$this->birth_date) return null;
        return Carbon::parse($this->birth_date)->diffInMonths(now());
    }

    public function getAgeTextAttribute()
    {
        if (!$this->birth_date) return 'Sin fecha de nacimiento';

        $years = Carbon::parse($this->birth_date)->diffInYears(now());
        $months = Carbon::parse($this->birth_date)->diffInMonths(now()) % 12;

        if ($years == 0) return "$months meses";
        if ($months == 0) return "$years años";
        return "$years años y $months meses";
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo_path && Storage::disk('public')->exists($this->photo_path)) {
            return asset('storage/' . $this->photo_path);
        }
        return asset('images/default-cow.jpg'); // Crea esta imagen en public/images
    }

    // === RELACIONES ===
    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecordCattleRaising::class, 'animal_id');
    }

    public function milkProductions()
    {
        return $this->hasMany(MilkProduction::class, 'animal_id');
    }

    public function inseminations()
    {
        return $this->hasMany(Insemination::class, 'animal_id');
    }

    public function births()
    {
        return $this->hasMany(Birth::class, 'animal_id');
    }

    public function weightRecords()
    {
        return $this->hasMany(WeightRecord::class, 'animal_id');
    }

    // === SCOPES ===
    public function scopeFemales($query)
    {
        return $query->where('sex', 'FEMALE');
    }

    public function scopeMales($query)
    {
        return $query->where('sex', 'MALE');
    }

    public function scopeInProduction($query)
    {
        return $query->where('production_stage', 'MILKING');
    }
}
