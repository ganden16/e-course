<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'product_category_id',
        'instructor',
        'price',
        'original_price',
        'image',
        'rating',
        'students',
        'duration',
        'level',
        'description',
        'features',
        'curriculum',
        'requirements',
        'what_you_will_build',
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
        'features' => 'array',
        'curriculum' => 'array',
        'requirements' => 'array',
        'what_you_will_build' => 'array',
        'is_active' => 'boolean'
    ];

    protected $appends = [
        'formatted_price',
        'formatted_original_price',
        'discount_percentage'
    ];

    /**
     * Get the product category that owns the product.
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
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
     * Get the canonical URL for this product.
     */
    public function getCanonicalUrlAttribute()
    {
        $locale = app()->getLocale();
        return url($locale . '/product/' . $this->id);
    }

    /**
     * Scope a query to only include active products.
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

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('title') && empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }
}
