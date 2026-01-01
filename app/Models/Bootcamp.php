<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bootcamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'price',
        'original_price',
        'image',
        'rating',
        'students',
        'duration',
        'level',
        'schedule',
        'start_date',
        'description',
        'features',
        'curriculum',
        'learning_outcomes',
        'career_support',
        'requirements',
        'is_active',
        'lynkid',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'start_date' => 'date',
        'features' => 'array',
        'curriculum' => 'array',
        'learning_outcomes' => 'array',
        'career_support' => 'array',
        'requirements' => 'array',
        'is_active' => 'boolean'
    ];

    protected $appends = [
        'formatted_price',
        'formatted_original_price',
        'discount_percentage'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class, 'bootcamp_mentor');
    }

    public function modules()
    {
        return $this->hasMany(ModuleBootcamp::class);
    }

    /**
     * Get the formatted price attribute.
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the formatted original price attribute.
     */
    public function getFormattedOriginalPriceAttribute()
    {
        return 'Rp ' . number_format($this->original_price, 0, ',', '.');
    }

    /**
     * Get the discount percentage attribute.
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price > 0) {
            return round((1 - $this->price / $this->original_price) * 100);
        }
        return 0;
    }
}
