<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'satuan_kerja',
        'realisasi_fisik',
        'last_updated',
    ];

    protected $casts = [
        'last_updated' => 'datetime',
        'realisasi_fisik' => 'decimal:2',
    ];

    // Auto update last_updated saat create dan update
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->last_updated = now();
        });

        static::updating(function ($model) {
            $model->last_updated = now();
        });
    }
}