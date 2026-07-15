<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengukuran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengukurans';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_ukur' => 'date',
        'berat_badan' => 'float',
        'tinggi_badan' => 'float',
    ];

    /**
     * Get the Balita that owns the Pengukuran.
     */
    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class);
    }

    /**
     * Get the Kader who did the Pengukuran.
     */
    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class);
    }

    /**
     * Get the Posyandu where the Pengukuran took place.
     */
    public function posyandu(): BelongsTo
    {
        return $this->belongsTo(Posyandu::class);
    }

    /**
     * Get the Validasi associated with the Pengukuran.
     */
    public function validasi(): HasOne
    {
        return $this->hasOne(Validasi::class);
    }
}
