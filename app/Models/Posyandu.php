<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Posyandu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posyandus';

    protected $guarded = ['id'];

    /**
     * Get the Puskesmas that owns the Posyandu.
     */
    public function puskesmas(): BelongsTo
    {
        return $this->belongsTo(Puskesmas::class);
    }

    /**
     * Get the Kaders for the Posyandu.
     */
    public function kaders(): HasMany
    {
        return $this->hasMany(Kader::class);
    }

    /**
     * Get the Pengukurans for the Posyandu.
     */
    public function pengukurans(): HasMany
    {
        return $this->hasMany(Pengukuran::class);
    }

    /**
     * Get the Jadwals for the Posyandu.
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    /**
     * Get all Balitas associated with this Posyandu through Kaders or directly.
     * Note: Since Balita belongs to Ibu, and Ibu doesn't belong to Posyandu, 
     * this relationship might need to be resolved via Pengukuran if we strictly follow the ERD.
     * But we can also retrieve Balitas that have been measured here.
     */
    public function balitasYangDiukur()
    {
        return Balita::whereHas('pengukurans', function ($query) {
            $query->where('posyandu_id', $this->id);
        });
    }
}
