<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengukurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')->constrained('balitas')->cascadeOnDelete();
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwals')->cascadeOnDelete();
            $table->foreignId('kader_id')->constrained('kaders')->cascadeOnDelete();
            $table->foreignId('posyandu_id')->constrained('posyandus')->cascadeOnDelete();
            $table->date('tanggal_ukur')->index();
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('z_score_bb_u', 5, 2)->nullable();
            $table->decimal('z_score_tb_u', 5, 2)->nullable();
            $table->decimal('z_score_bb_tb', 5, 2)->nullable();
            $table->enum('status_stunting', ['Sangat Pendek', 'Pendek', 'Normal', 'Tinggi']);
            $table->enum('status_gizi', ['Buruk', 'Kurang', 'Baik', 'Lebih', 'Obesitas']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengukurans');
    }
};
