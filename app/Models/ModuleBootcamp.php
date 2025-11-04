<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleBootcamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'bootcamp_id',
        'week_number',
        'module',
        'objective',
        'description',
        'topics',
        'duration_hours',
        'is_active'
    ];

    protected $casts = [
        'week_number' => 'integer',
        'duration_hours' => 'integer',
        'topics' => 'array',
        'is_active' => 'boolean'
    ];

    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class);
    }
}
