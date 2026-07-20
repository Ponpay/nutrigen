<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Ibu;
use App\Models\PetugasPuskesmas;

class NotificationService
{
    /**
     * Create a notification for Ibu.
     */
    public function notifyIbu(Ibu $ibu, string $title, string $message, string $type = 'info'): Notification
    {
        return Notification::create([
            'ibu_id' => $ibu->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'is_read' => false
        ]);
    }

    /**
     * Create a notification for Petugas Puskesmas.
     */
    public function notifyPetugas(PetugasPuskesmas $petugas, string $title, string $message, string $type = 'warning'): Notification
    {
        return Notification::create([
            'petugas_id' => $petugas->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'is_read' => false
        ]);
    }
}
