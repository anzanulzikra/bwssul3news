<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'published_at',
        'status',
        'is_favorite',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_favorite' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }

    // Scope: Hanya artikel yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope: Hanya artikel favorite
    public function scopeFavorite($query)
    {
        return $query->where('is_favorite', true);
    }
}
