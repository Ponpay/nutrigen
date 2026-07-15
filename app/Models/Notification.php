<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory; // No soft deletes per migration

    protected $table = 'notifications';

    protected $guarded = ['id'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Get the Ibu associated with the Notification.
     */
    public function ibu(): BelongsTo
    {
        return $this->belongsTo(Ibu::class);
    }

    /**
     * Get the Petugas Puskesmas associated with the Notification.
     */
    public function petugasPuskesmas(): BelongsTo
    {
        return $this->belongsTo(PetugasPuskesmas::class, 'petugas_id');
    }
}
