<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_url',
        'logo_url',
        'client_name',
        'category',
        'external_link',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function getCategories()
    {
        return self::distinct('category')
            ->orderBy('category')
            ->pluck('category')
            ->prepend('All');
    }

    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }

        return $query;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}
