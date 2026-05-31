<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

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
        'meta_title',
        'meta_description',
        'meta_keywords',
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

    /**
     * Get the SEO title (meta_title or generated from title).
     */
    public function getSeoTitleAttribute()
    {
        return $this->meta_title ?? $this->title;
    }

    /**
     * Get the SEO description (meta_description or generated from description).
     */
    public function getSeoDescriptionAttribute()
    {
        return $this->meta_description ?? Str::limit(strip_tags($this->description), 160);
    }

    /**
     * Get the full image URL for SEO.
     */
    public function getSeoImageAttribute()
    {
        if ($this->image) {
            return asset($this->image);
        }
        return asset('assets/images/logo1.png');
    }

    /**
     * Get the canonical URL for this bootcamp.
     */
    public function getCanonicalUrlAttribute()
    {
        $locale = app()->getLocale();
        return url($locale . '/bootcamp/' . $this->id);
    }

    /**
     * Scope a query to only include active bootcamps.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($bootcamp) {
            if (empty($bootcamp->slug)) {
                $bootcamp->slug = Str::slug($bootcamp->title);
            }
        });

        static::updating(function ($bootcamp) {
            if ($bootcamp->isDirty('title') && empty($bootcamp->slug)) {
                $bootcamp->slug = Str::slug($bootcamp->title);
            }
        });
    }
}
