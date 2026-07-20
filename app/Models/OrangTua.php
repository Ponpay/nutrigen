<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrangTua extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik_ibu',
        'nama_ibu',
        'nama_ayah',
        'no_hp_whatsapp',
        'alamat',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function balitas(): HasMany
    {
        return $this->hasMany(Balita::class);
    }
}
