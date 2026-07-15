<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validasi extends Model
{
    use HasFactory; // No soft deletes per migration

    protected $table = 'validasis';

    protected $guarded = ['id'];

    /**
     * Get the Pengukuran that is being validated.
     */
    public function pengukuran(): BelongsTo
    {
        return $this->belongsTo(Pengukuran::class);
    }

    /**
     * Get the Petugas Puskesmas that performed the validation.
     */
    public function petugasPuskesmas(): BelongsTo
    {
        return $this->belongsTo(PetugasPuskesmas::class, 'petugas_id');
    }
}
