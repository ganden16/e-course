<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'bio',
        'image',
        'specialization',
        'experience',
        'rating',
        'students_taught',
        'email',
        'phone',
        'is_active'
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'students_taught' => 'integer',
        'is_active' => 'boolean'
    ];

    public function bootcamps()
    {
        return $this->belongsToMany(Bootcamp::class, 'bootcamp_mentor');
    }
}
