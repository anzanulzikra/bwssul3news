<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnersLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
        'website_url',
        'order',
    ];
}
