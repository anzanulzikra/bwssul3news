<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'order',
        'url',
        'linkable_type',
        'linkable_id',
    ];

    // Relasi: Menu Item memiliki parent (self-referencing)
    public function parent()
    {
        return $this->belongsTo(MenuItems::class, 'parent_id');
    }

    // Relasi: Menu Item memiliki banyak children
    public function children()
    {
        return $this->hasMany(MenuItems::class, 'parent_id');
    }
}