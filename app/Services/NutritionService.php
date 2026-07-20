<?php

namespace App\Services;

use App\Models\Balita;

class NutritionService
{
    /**
     * Get the main meal recommendation based on the latest measurement status.
     */
    public function getHeroMeal(Balita $balita): array
    {
        // For MVP, we provide a static hero meal, but in the future,
        // this will query the database based on the Balita's specific nutritional needs.
        return [
            'image' => 'placeholder.jpg',
            'title' => 'Sup Ayam Makaroni Sayur',
            'calories' => '350 Kkal',
            'duration' => '30 Menit'
        ];
    }

    /**
     * Get alternative meals for the day.
     */
    public function getAlternatives(Balita $balita): array
    {
        // For MVP, static alternative meals.
        return [
            [
                'image' => 'placeholder.jpg',
                'title' => 'Nugget Ayam Wortel',
                'calories' => '320 Kkal'
            ],
            [
                'image' => 'placeholder.jpg',
                'title' => 'Omelet Bayam Keju',
                'calories' => '280 Kkal'
            ],
            [
                'image' => 'placeholder.jpg',
                'title' => 'Perkedel Daging',
                'calories' => '300 Kkal'
            ]
        ];
    }

    /**
     * Get a recommendation message.
     */
    public function getRecommendationMessage(Balita $balita): array
    {
        $latest = $balita->pengukurans()->latest('tanggal_ukur')->first();
        
        $message = 'Protein hewani sangat baik untuk pertumbuhannya.';
        if ($latest && strtolower($latest->status_gizi) === 'kurang') {
            $message = 'Sangat disarankan meningkatkan asupan protein tinggi (telur, ayam, ikan).';
        }

        return [
            'message' => $message,
            'cta' => 'Lihat Menu Hari Ini'
        ];
    }

    /**
     * Get the trust banner message for the nutrition page.
     */
    public function getTrustBannerMessage(Balita $balita): string
    {
        $latest = $balita->pengukurans()->latest('tanggal_ukur')->first();
        $dateStr = $latest ? \Carbon\Carbon::parse($latest->tanggal_ukur)->format('d M') : 'baru-baru ini';
        
        return "Berdasarkan hasil ukur terakhir ($dateStr), sistem memilihkan menu tinggi protein untuk menjaga tren positif.";
    }
}
