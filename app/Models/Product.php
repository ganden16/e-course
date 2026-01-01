<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = \Illuminate\Support\Str::slug($product->title);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('title') && empty($product->slug)) {
                $product->slug = \Illuminate\Support\Str::slug($product->title);
            }
        });
    }
}
