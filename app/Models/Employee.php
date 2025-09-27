<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom',
        'prenom',
        'age',
        'zone_rurale',
        'experience_annees',
        'experience_cultures',
        'specialites',
        'disponible'
    ];
    
    protected $casts = [
        'experience_cultures' => 'array',
        'specialites' => 'array',
        'disponible' => 'boolean',
    ];

    /**
     * Les missions auxquelles cet employé est assigné
     */
    public function missions(): BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'employee_mission')
                    ->withTimestamps();
    }
}
