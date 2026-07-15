<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Balita extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'balitas';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the Ibu that owns the Balita.
     */
    public function ibu(): BelongsTo
    {
        return $this->belongsTo(Ibu::class);
    }

    /**
     * Get the Pengukurans for the Balita.
     */
    public function pengukurans(): HasMany
    {
        return $this->hasMany(Pengukuran::class);
    }
}
