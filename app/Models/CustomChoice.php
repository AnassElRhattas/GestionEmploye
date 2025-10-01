<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomChoice extends Model
{
    protected $fillable = [
        'type',
        'value',
    ];

    /**
     * Scope a query to only include culture choices.
     */
    public function scopeCultures($query)
    {
        return $query->where('type', 'culture');
    }

    /**
     * Scope a query to only include specialite choices.
     */
    public function scopeSpecialites($query)
    {
        return $query->where('type', 'specialite');
    }
}
