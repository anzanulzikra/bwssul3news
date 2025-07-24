<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'link_url',
        'type',
    ];

    protected $casts = [
        'type' => 'string',
    ];
}
