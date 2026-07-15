<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Puskesmas;
use App\Models\Posyandu;
use App\Models\PetugasPuskesmas;
use App\Models\Kader;
use App\Models\Ibu;
use App\Models\Balita;
use App\Models\Jadwal;
use App\Models\Pengukuran;
use App\Models\Validasi;
use App\Models\Notification;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin
        $admin = User::factory()->create([
            'name' => 'Administrator Dinas',
            'email' => 'admin@nutrigen.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Puskesmas & Petugas
        $puskesmas = Puskesmas::factory()->create([
            'kode_puskesmas' => 'P123456',
            'nama' => 'Puskesmas Sukamaju',
        ]);

        $petugasUser = User::factory()->create([
            'name' => 'dr. Siti',
            'email' => 'petugas@nutrigen.com',
            'password' => Hash::make('password'),
            'role' => 'puskesmas',
        ]);

        $petugas = PetugasPuskesmas::factory()->create([
            'user_id' => $petugasUser->id,
            'puskesmas_id' => $puskesmas->id,
            'jabatan' => 'Kepala Gizi',
        ]);

        // 3. Posyandu
        $posyandu1 = Posyandu::factory()->create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Melati',
        ]);
        $posyandu2 = Posyandu::factory()->create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Anggrek',
        ]);

        // 4. Kader
        $kaderUser1 = User::factory()->create([
            'name' => 'Ibu Kader 1',
            'email' => 'kader1@nutrigen.com',
            'password' => Hash::make('password'),
            'role' => 'kader',
        ]);
        $kader1 = Kader::factory()->create([
            'user_id' => $kaderUser1->id,
            'posyandu_id' => $posyandu1->id,
        ]);

        $kaderUser2 = User::factory()->create([
            'name' => 'Ibu Kader 2',
            'email' => 'kader2@nutrigen.com',
            'password' => Hash::make('password'),
            'role' => 'kader',
        ]);
        $kader2 = Kader::factory()->create([
            'user_id' => $kaderUser2->id,
            'posyandu_id' => $posyandu2->id,
        ]);

        // 5. Ibu & Balita (5 Pairs)
        $ibus = [];
        $balitas = [];
        for ($i = 1; $i <= 5; $i++) {
            $ibu = Ibu::factory()->create([
                'nama' => 'Bunda Balita ' . $i,
                'token_whatsapp' => 'demo-token-' . $i,
            ]);
            $ibus[] = $ibu;

            $balita = Balita::factory()->create([
                'ibu_id' => $ibu->id,
                'nama' => 'Anak Balita ' . $i,
                'tanggal_lahir' => Carbon::now()->subMonths(rand(12, 36)),
            ]);
            $balitas[] = $balita;
        }

        // Specifically set the first Ibu to have token "demo-token" for the Landing Page demo button
        $ibus[0]->update(['token_whatsapp' => 'demo-token']);

        // 6. Jadwal (Past & Active)
        $jadwalAktif = Jadwal::factory()->create([
            'posyandu_id' => $posyandu1->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
        ]);

        // 7. Pengukuran (Historis + Current)
        foreach ($balitas as $balita) {
            $beratAwal = 5.0; // Base weight
            $tinggiAwal = 60.0; // Base height

            // 6 Months Historical Data
            for ($month = 6; $month >= 1; $month--) {
                $jadwalHistoris = Jadwal::factory()->create([
                    'posyandu_id' => $posyandu1->id,
                    'tanggal' => Carbon::now()->subMonths($month)->format('Y-m-d'),
                ]);

                $beratBadan = $beratAwal + ((7 - $month) * 0.5);
                $tinggiBadan = $tinggiAwal + ((7 - $month) * 1.2);

                $pengukuran = Pengukuran::factory()->create([
                    'balita_id' => $balita->id,
                    'kader_id' => $kader1->id,
                    'posyandu_id' => $posyandu1->id,
                    'tanggal_ukur' => Carbon::now()->subMonths($month)->format('Y-m-d'),
                    'berat_badan' => $beratBadan,
                    'tinggi_badan' => $tinggiBadan,
                ]);

                // All historical data is valid
                Validasi::factory()->create([
                    'pengukuran_id' => $pengukuran->id,
                    'petugas_id' => $petugas->id,
                    'status_validasi' => 'valid',
                    'catatan' => 'Validasi historis',
                ]);
            }

            // Current Month Data (Pending Validasi)
            // This satisfies the demo requirement: Kader input -> Pending -> Puskesmas validates
            $pengukuranBaru = Pengukuran::factory()->create([
                'balita_id' => $balita->id,
                'kader_id' => $kader1->id,
                'posyandu_id' => $posyandu1->id,
                'tanggal_ukur' => Carbon::now()->format('Y-m-d'),
                'berat_badan' => $beratAwal + (7 * 0.5),
                'tinggi_badan' => $tinggiAwal + (7 * 1.2),
            ]);

            Validasi::factory()->create([
                'pengukuran_id' => $pengukuranBaru->id,
                'petugas_id' => null,
                'status_validasi' => 'pending',
                'catatan' => null,
            ]);

            // Notification for the new measurement
            Notification::factory()->create([
                'ibu_id' => $balita->ibu_id,
                'petugas_id' => null,
                'title' => 'Pengukuran Baru Selesai',
                'type' => 'info',
                'message' => "Data pengukuran {$balita->nama} bulan ini sedang divalidasi oleh Puskesmas.",
            ]);
        }
    }
}
