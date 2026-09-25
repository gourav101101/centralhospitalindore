<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'tag',
        'image',
        'content',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'date',
    ];

    /**
     * Keep legacy storage-disk uploads working on hosts without a public/storage link.
     */
    public function getImageAttribute($value)
    {
        if (Str::startsWith($value, 'storage/blogs/')) {
            return 'media/blogs/' . basename($value);
        }

        return $value;
    }

    /**
     * Scope to get only published blogs.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Auto-generate slug from title if not set.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            // Ensure slug is unique
            $originalSlug = $blog->slug;
            $count = 1;
            while (static::where('slug', $blog->slug)->exists()) {
                $blog->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title') && !$blog->isDirty('slug')) {
                $blog->slug = Str::slug($blog->title);
                $originalSlug = $blog->slug;
                $count = 1;
                while (static::where('slug', $blog->slug)->where('id', '!=', $blog->id)->exists()) {
                    $blog->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }
}
