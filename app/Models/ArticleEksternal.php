<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleEksternal extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'link',
        'featured_image',
        'published_at',
        'status',
        'is_favorite',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_favorite' => 'boolean',
    ];

    // Relasi: Article Eksternal belongs to User (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relasi: Article Eksternal belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
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
