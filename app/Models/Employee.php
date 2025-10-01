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
        'telephone',
        'identifiant',
        'experience_annees',
        'experience_cultures',
        'specialites',
        'disponible',
        'evaluation_stars',
        'evaluation_remark'
    ];
    
    protected $casts = [
        'experience_cultures' => 'array',
        'specialites' => 'array',
        'disponible' => 'boolean',
        'evaluation_stars' => 'integer',
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
