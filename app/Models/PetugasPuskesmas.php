<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetugasPuskesmas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'petugas_puskesmas';

    protected $guarded = ['id'];

    /**
     * Get the User associated with the Petugas.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Puskesmas that owns the Petugas.
     */
    public function puskesmas(): BelongsTo
    {
        return $this->belongsTo(Puskesmas::class);
    }

    /**
     * Get the Validasis handled by the Petugas.
     */
    public function validasis(): HasMany
    {
        return $this->hasMany(Validasi::class, 'petugas_id');
    }

    /**
     * Get the Notifications for the Petugas.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'petugas_id');
    }
}
