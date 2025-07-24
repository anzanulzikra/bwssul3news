<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
    ];

    // Relasi: Page belongs to Pages Category
    public function category()
    {
        return $this->belongsTo(PagesCategory::class);
    }
}
