<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'author',
        'category',
        'featured_images',
        'created_by',
        'modified_by'
    ];

    // ✅ Automatically generate unique slug on create/update
    protected static function booted()
    {
        static::creating(function ($blog) {
            $slug = Str::slug($blog->name);
            $original = $slug;
            $count = 1;

            // Ensure slug is unique
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $count++;
            }

            $blog->slug = $slug;
        });

        static::updating(function ($blog) {
            $slug = Str::slug($blog->name);
            $original = $slug;
            $count = 1;

            // Ensure slug is unique on update (excluding current record)
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $original . '-' . $count++;
            }

            $blog->slug = $slug;
        });
    }
}












