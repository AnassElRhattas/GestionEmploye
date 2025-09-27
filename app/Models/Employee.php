<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
