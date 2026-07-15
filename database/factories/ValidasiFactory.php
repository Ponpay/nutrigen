<?php

namespace Database\Factories;

use App\Models\Pengukuran;
use App\Models\PetugasPuskesmas;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValidasiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pengukuran_id' => Pengukuran::factory(),
            'petugas_id' => PetugasPuskesmas::factory(),
            'status_validasi' => $this->faker->randomElement(['pending', 'valid']),
            'catatan' => $this->faker->sentence(),
        ];
    }
}
