<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PagesCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    // Relasi: Pages Category memiliki banyak pages
    public function pages()
    {
        return $this->hasMany(Page::class, 'category_id');
    }
}
