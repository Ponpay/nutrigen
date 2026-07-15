<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kader extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kaders';

    protected $guarded = ['id'];

    /**
     * Get the User associated with the Kader.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Posyandu that the Kader belongs to.
     */
    public function posyandu(): BelongsTo
    {
        return $this->belongsTo(Posyandu::class);
    }

    /**
     * Get the Pengukurans done by the Kader.
     */
    public function pengukurans(): HasMany
    {
        return $this->hasMany(Pengukuran::class);
    }
}
