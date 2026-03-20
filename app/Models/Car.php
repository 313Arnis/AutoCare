<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = [
        'user_id',
        'razotajs', 
        'modelis', 
        'gads', 
        'nobraukums',
        'octa_beigas', 
        'tehniska_beigas',
        'pedeja_ella_km',
        'ellas_intervals_km',
        'videjais_menes_km' 
    ];

    // Svarīgi: pasakām Laravel, ka šie ir datumi
    protected $casts = [
        'octa_beigas' => 'date',
        'tehniska_beigas' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}