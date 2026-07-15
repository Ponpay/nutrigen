<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ibu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ibus';

    protected $guarded = ['id'];

    /**
     * Get the Balitas that belong to the Ibu.
     */
    public function balitas(): HasMany
    {
        return $this->hasMany(Balita::class);
    }

    /**
     * Get the Notifications for the Ibu.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
