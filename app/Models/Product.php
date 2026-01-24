<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'image',
        'description',
        'category_id',
        'stock',
        'is_featured',
        'status',
        'aesthetic',
        'price_tier',
        'discover_score',
        'view_count',
        'wishlist_count',
        'recent_purchases',
        'brand_name',
        'occasions',
        'colors',
        'sizes',
    ];

    protected function casts(): array
    {
        return [
            'occasions' => 'array',
            'colors' => 'array',
            'sizes' => 'array',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeAesthetic($query, $aesthetic)
    {
        return $query->where('aesthetic', $aesthetic);
    }

    public static function getAestheticName($key)
    {
        return [
            'alt' => 'Alt Girly 🖤',
            'luxury' => 'Luxury Clean ✨',
            'soft' => 'Soft Femme 🌸',
            'mix' => 'Modern Mix 🎭'
        ][$key] ?? 'Modern Mix 🎭';
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
