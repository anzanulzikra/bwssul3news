<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'featured_photo_id',
        'description',
    ];


    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class);
    }

    
}
