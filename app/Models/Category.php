<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

     // Relasi: Category memiliki banyak artikel
     public function articles()
     {
         return $this->hasMany(Article::class);
     }
 
     // Relasi: Category memiliki banyak artikel eksternal
     public function articleEksternals()
     {
         return $this->hasMany(ArticleEksternal::class);
     }
}
