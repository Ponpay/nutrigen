<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Puskesmas;
use App\Models\Posyandu;
use App\Models\Kader;
use App\Models\OrangTua;
use App\Models\Balita;
use App\Models\Pengukuran;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Puskesmas User & Data
        $userPuskesmas = User::create([
            'name' => 'Admin Puskesmas',
            'email' => 'puskesmas@nutrigen.com',
            'password' => Hash::make('password'),
            'role' => 'puskesmas',
        ]);

        $puskesmas = Puskesmas::create([
            'user_id' => $userPuskesmas->id,
            'nama' => 'Puskesmas Kecamatan Sehat',
            'kode_faskes' => 'PKS-001',
            'alamat' => 'Jl. Kesehatan No. 1, Kota Sehat',
        ]);

        // 2. Create Posyandus
        $posyandu1 = Posyandu::create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Mawar',
            'desa_kelurahan' => 'Desa Makmur',
            'alamat' => 'Balai Desa Makmur',
        ]);

        $posyandu2 = Posyandu::create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Melati',
            'desa_kelurahan' => 'Desa Sejahtera',
            'alamat' => 'Balai Desa Sejahtera',
        ]);

        $posyandus = [$posyandu1, $posyandu2];

        // 3. Create Kader
        $kaderData = [
            ['name' => 'Kader Mawar 1', 'email' => 'kader1@nutrigen.com', 'posyandu' => $posyandu1],
            ['name' => 'Kader Mawar 2', 'email' => 'kader2@nutrigen.com', 'posyandu' => $posyandu1],
            ['name' => 'Kader Melati 1', 'email' => 'kader3@nutrigen.com', 'posyandu' => $posyandu2],
        ];

        $kaders = [];
        foreach ($kaderData as $idx => $data) {
            $userKader = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'kader',
            ]);

            $kaders[] = Kader::create([
                'user_id' => $userKader->id,
                'posyandu_id' => $data['posyandu']->id,
                'nama' => $data['name'],
                'no_hp' => '08123456789' . $idx,
            ]);
        }

        // 4. Create OrangTua (10)
        $orangTuas = [];
        for ($i = 1; $i <= 10; $i++) {
            $userIbu = User::create([
                'name' => 'Ibu Budi ' . $i,
                'email' => 'ibu'.$i.'@nutrigen.com',
                'password' => Hash::make('password'),
                'role' => 'ibu',
            ]);

            $orangTuas[] = OrangTua::create([
                'user_id' => $userIbu->id,
                'nik_ibu' => '320101' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'nama_ibu' => 'Ibu Budi ' . $i,
                'nama_ayah' => 'Bapak Budi ' . $i,
                'no_hp_whatsapp' => '081100000' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'alamat' => 'Jl. Perumahan No. ' . $i,
            ]);
        }

        // 5. Create Balita (15) and Measurements
        // Distribution: 8 Normal, 4 Risiko, 3 Stunting
        $balitaProfiles = [
            ['status' => 'Normal', 'z_tbu_start' => -0.5, 'tb_start' => 75.0, 'bb_start' => 9.5],
            ['status' => 'Normal', 'z_tbu_start' => 0.2, 'tb_start' => 76.5, 'bb_start' => 10.0],
            ['status' => 'Normal', 'z_tbu_start' => 1.0, 'tb_start' => 78.0, 'bb_start' => 10.5],
            ['status' => 'Normal', 'z_tbu_start' => -1.0, 'tb_start' => 74.0, 'bb_start' => 9.0],
            ['status' => 'Normal', 'z_tbu_start' => 0.5, 'tb_start' => 77.0, 'bb_start' => 10.2],
            ['status' => 'Normal', 'z_tbu_start' => -0.8, 'tb_start' => 74.5, 'bb_start' => 9.2],
            ['status' => 'Normal', 'z_tbu_start' => 1.5, 'tb_start' => 79.0, 'bb_start' => 11.0],
            ['status' => 'Normal', 'z_tbu_start' => 0.0, 'tb_start' => 76.0, 'bb_start' => 9.8],
            ['status' => 'Risiko', 'z_tbu_start' => -1.8, 'tb_start' => 72.0, 'bb_start' => 8.5],
            ['status' => 'Risiko', 'z_tbu_start' => -1.9, 'tb_start' => 71.5, 'bb_start' => 8.3],
            ['status' => 'Risiko', 'z_tbu_start' => -1.6, 'tb_start' => 72.5, 'bb_start' => 8.7],
            ['status' => 'Risiko', 'z_tbu_start' => -1.7, 'tb_start' => 72.2, 'bb_start' => 8.6],
            ['status' => 'Stunting', 'z_tbu_start' => -2.5, 'tb_start' => 69.0, 'bb_start' => 7.5],
            ['status' => 'Stunting', 'z_tbu_start' => -2.8, 'tb_start' => 68.0, 'bb_start' => 7.2],
            ['status' => 'Stunting', 'z_tbu_start' => -3.1, 'tb_start' => 67.0, 'bb_start' => 6.8],
        ];

        $now = Carbon::now();

        foreach ($balitaProfiles as $index => $profile) {
            $ibu = $orangTuas[$index % 10];
            $posyandu = $posyandus[$index % 2];
            $kader = $kaders[$index % 3]; // The kader recording the measurement

            // Base age around 12 to 24 months
            $umurBulanSaatIni = 12 + ($index % 12); 
            $tanggalLahir = $now->copy()->subMonths($umurBulanSaatIni)->subDays(rand(1, 28));

            $balita = Balita::create([
                'orang_tua_id' => $ibu->id,
                'posyandu_id' => $posyandu->id,
                'nik' => '320101' . str_pad($index, 10, '0', STR_PAD_LEFT),
                'nama' => 'Anak ' . $ibu->nama_ibu,
                'jenis_kelamin' => $index % 2 == 0 ? 'L' : 'P',
                'tanggal_lahir' => $tanggalLahir,
                'berat_lahir' => 3.0 + ($index * 0.1),
                'panjang_lahir' => 50.0 + ($index * 0.5),
            ]);

            // Create 3 months of measurement history
            $currentTb = $profile['tb_start'];
            $currentBb = $profile['bb_start'];
            $currentZ = $profile['z_tbu_start'];

            for ($m = 2; $m >= 0; $m--) {
                $tanggalUkur = $now->copy()->subMonths($m)->startOfMonth()->addDays(rand(1, 5));
                $umurBulanUkur = $umurBulanSaatIni - $m;

                Pengukuran::create([
                    'balita_id' => $balita->id,
                    'kader_id' => $kader->id,
                    'tanggal_ukur' => $tanggalUkur,
                    'umur_bulan' => $umurBulanUkur,
                    'berat_badan' => $currentBb,
                    'tinggi_badan' => $currentTb,
                    'z_score_bbu' => $currentZ + 0.1, // Approximate
                    'z_score_tbu' => $currentZ,
                    'status_gizi' => $profile['status'],
                ]);

                // Simulate slight growth for the next month
                $growthRate = $profile['status'] === 'Stunting' ? 0.3 : ($profile['status'] === 'Risiko' ? 0.6 : 0.9);
                $currentTb += $growthRate;
                $currentBb += ($growthRate * 0.2);
            }
        }
    }
}
