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
use App\Models\Jadwal;
use App\Services\GrowthCalculationService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with ultra-realistic clinical and administrative data.
     */
    public function run(): void
    {
        $calculator = new GrowthCalculationService();
        $now = Carbon::now();

        // -------------------------------------------------------------
        // 1. PUSKESMAS & PETUGAS GIZI (AHLI GIZI)
        // -------------------------------------------------------------
        $userPuskesmas = User::create([
            'name' => 'dr. Cut Nyak Sarah, S.Gz',
            'email' => 'puskesmas@nutrigen.com',
            'password' => Hash::make('password'),
            'role' => 'puskesmas',
        ]);

        $puskesmas = Puskesmas::create([
            'user_id' => $userPuskesmas->id,
            'nama' => 'Puskesmas Kuta Alam',
            'kode_faskes' => 'P11710101',
            'alamat' => 'Jl. T. Nyak Arief No. 24, Kuta Alam, Kota Banda Aceh',
        ]);

        // -------------------------------------------------------------
        // 2. POSYANDU DI WILAYAH KERJA PUSKESMAS
        // -------------------------------------------------------------
        $posyandu1 = Posyandu::create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Bunga Tanjung VII',
            'desa_kelurahan' => 'Gampong Lampulo',
            'alamat' => 'Balai Pertemuan Warga, Lr. Samudra No. 12, Lampulo',
        ]);

        $posyandu2 = Posyandu::create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Melati Sejahtera',
            'desa_kelurahan' => 'Gampong Peunayong',
            'alamat' => 'Kompleks Rukun Warga, Jl. Panglima Polem No. 45, Peunayong',
        ]);

        $posyandu3 = Posyandu::create([
            'puskesmas_id' => $puskesmas->id,
            'nama' => 'Posyandu Cempaka Harapan',
            'desa_kelurahan' => 'Gampong Bandar Baru',
            'alamat' => 'Balai Desa Bandar Baru, Jl. Seulanga No. 8, Bandar Baru',
        ]);

        $posyandus = [$posyandu1, $posyandu2, $posyandu3];

        // -------------------------------------------------------------
        // 3. KADER POSYANDU
        // -------------------------------------------------------------
        $kaderList = [
            [
                'name' => 'Cut Malahayati, A.Md.Keb',
                'email' => 'kader@nutrigen.com',
                'posyandu' => $posyandu1,
                'no_hp' => '081269001234',
            ],
            [
                'name' => 'Siti Rahmah, S.Pd',
                'email' => 'kader2@nutrigen.com',
                'posyandu' => $posyandu2,
                'no_hp' => '081377889901',
            ],
            [
                'name' => 'Nurul Fauziah',
                'email' => 'kader3@nutrigen.com',
                'posyandu' => $posyandu3,
                'no_hp' => '085260112233',
            ],
        ];

        $kaders = [];
        foreach ($kaderList as $k) {
            $userKader = User::create([
                'name' => $k['name'],
                'email' => $k['email'],
                'password' => Hash::make('password'),
                'role' => 'kader',
            ]);

            $kaders[] = Kader::create([
                'user_id' => $userKader->id,
                'posyandu_id' => $k['posyandu']->id,
                'nama' => $k['name'],
                'no_hp' => $k['no_hp'],
            ]);
        }

        // -------------------------------------------------------------
        // 4. DATA ORANG TUA (16 KELUARGA REALISTIS)
        // -------------------------------------------------------------
        $parentsData = [
            [
                'nama_ibu' => 'Cut Annisa Zahra',
                'nama_ayah' => 'Teuku Farhan Maulana',
                'email' => 'ibu.annisa@nutrigen.com',
                'nik_ibu' => '1171015504950001',
                'no_hp' => '081269112233',
                'alamat' => 'Gampong Lampulo, RT 02/RW 01, Kec. Kuta Alam, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Rina Agustina',
                'nama_ayah' => 'Muhammad Rizky Pratama',
                'email' => 'ibu.rina@nutrigen.com',
                'nik_ibu' => '1171016208940002',
                'no_hp' => '081370223344',
                'alamat' => 'Gampong Lampulo, Lr. Cakalang No. 14, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Nurhaliza, S.E.',
                'nama_ayah' => 'Dedi Syahputra',
                'email' => 'ibu.nurhaliza@nutrigen.com',
                'nik_ibu' => '1171014811960003',
                'no_hp' => '085260334455',
                'alamat' => 'Gampong Peunayong, Jl. T. Hasan Dek No. 5B, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Sri Wahyuni',
                'nama_ayah' => 'Bambang Haryanto',
                'email' => 'ibu.sri@nutrigen.com',
                'nik_ibu' => '1171015002930004',
                'no_hp' => '081269445566',
                'alamat' => 'Gampong Bandar Baru, Kompleks TVRI No. 8, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Maisarah, S.Pd',
                'nama_ayah' => 'Zulfikar Arifin',
                'email' => 'ibu.maisarah@nutrigen.com',
                'nik_ibu' => '1171016507970005',
                'no_hp' => '081377556677',
                'alamat' => 'Gampong Lampulo, Lr. Pukat Trawl No. 22, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Fitri Handayani',
                'nama_ayah' => 'Hendri Saputra',
                'email' => 'ibu.fitri@nutrigen.com',
                'nik_ibu' => '1171015809950006',
                'no_hp' => '085361667788',
                'alamat' => 'Gampong Peunayong, Lr. Khadijah No. 17, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Dewi Sartika',
                'nama_ayah' => 'Ahmad Fauzi',
                'email' => 'ibu.dewi@nutrigen.com',
                'nik_ibu' => '1171014301980007',
                'no_hp' => '081269778899',
                'alamat' => 'Gampong Bandar Baru, Jl. T. Nyak Arief No. 34, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Lestari Ningsih',
                'nama_ayah' => 'Irfan Hakim',
                'email' => 'ibu.lestari@nutrigen.com',
                'nik_ibu' => '1171016912940008',
                'no_hp' => '081370889900',
                'alamat' => 'Gampong Lampulo, RT 04/RW 02, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Eka Putri Rahayu',
                'nama_ayah' => 'Rahmat Hidayat',
                'email' => 'ibu.eka@nutrigen.com',
                'nik_ibu' => '1171015206960009',
                'no_hp' => '085260990011',
                'alamat' => 'Gampong Peunayong, Jl. Ahmad Yani No. 89, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Nurhasanah',
                'nama_ayah' => 'Faisal Tanjung',
                'email' => 'ibu.nurhasanah@nutrigen.com',
                'nik_ibu' => '1171014703950010',
                'no_hp' => '081269001122',
                'alamat' => 'Gampong Bandar Baru, Lr. Jeumpa No. 3, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Tia Rahmawati',
                'nama_ayah' => 'Agus Setiawan',
                'email' => 'ibu.tia@nutrigen.com',
                'nik_ibu' => '1171016105970011',
                'no_hp' => '081377112233',
                'alamat' => 'Gampong Lampulo, Lr. PPI Lampulo No. 5, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Rini Kusuma Wardani',
                'nama_ayah' => 'Dian Permana',
                'email' => 'ibu.rini@nutrigen.com',
                'nik_ibu' => '1171015408930012',
                'no_hp' => '085361223344',
                'alamat' => 'Gampong Peunayong, Jl. KH Ahmad Dahlan No. 12, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Cut Putri Mayang Sari',
                'nama_ayah' => 'M. Danial Syah',
                'email' => 'ibu.mayang@nutrigen.com',
                'nik_ibu' => '1171014910980013',
                'no_hp' => '081269334455',
                'alamat' => 'Gampong Bandar Baru, Kompleks Unsyiah Blok D-4, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Indah Permatasari',
                'nama_ayah' => 'Yusuf Pratama',
                'email' => 'ibu.indah@nutrigen.com',
                'nik_ibu' => '1171016604960014',
                'no_hp' => '081370445566',
                'alamat' => 'Gampong Lampulo, Lr. Samudra No. 9, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Siti Aminah',
                'nama_ayah' => 'Rizal Pahlevi',
                'email' => 'ibu.aminah@nutrigen.com',
                'nik_ibu' => '1171015109940015',
                'no_hp' => '085260556677',
                'alamat' => 'Gampong Peunayong, Jl. Kartini No. 27, Banda Aceh',
            ],
            [
                'nama_ibu' => 'Zahratul Ula',
                'nama_ayah' => 'M. Iqbal Ramadhan',
                'email' => 'ibu.zahra@nutrigen.com',
                'nik_ibu' => '1171016307990016',
                'no_hp' => '081269667788',
                'alamat' => 'Gampong Bandar Baru, Jl. Tgk Chik Ditiro No. 101, Banda Aceh',
            ],
        ];

        $orangTuas = [];
        foreach ($parentsData as $pd) {
            $userIbu = User::create([
                'name' => $pd['nama_ibu'],
                'email' => $pd['email'],
                'password' => Hash::make('password'),
                'role' => 'ibu',
            ]);

            $orangTuas[] = OrangTua::create([
                'user_id' => $userIbu->id,
                'nik_ibu' => $pd['nik_ibu'],
                'nama_ibu' => $pd['nama_ibu'],
                'nama_ayah' => $pd['nama_ayah'],
                'no_hp_whatsapp' => $pd['no_hp'],
                'alamat' => $pd['alamat'],
            ]);
        }

        // -------------------------------------------------------------
        // 5. DATA BALITA & RIWAYAT PENGUKURAN KMS LENGKAP (20 BALITA)
        // -------------------------------------------------------------
        $balitaProfiles = [
            // 1. Muhammad Al-Fatih Pratama (Normal, Sehat, Tumbuh Baik)
            [
                'nama' => 'Muhammad Al-Fatih Pratama',
                'jk' => 'L',
                'umur_bulan' => 14,
                'parent_idx' => 0,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 3.2,
                'panjang_lahir' => 50.0,
                'lk_lahir' => 34.0,
                'history' => [
                    ['m' => 3, 'bb' => 9.2, 'tb' => 76.0, 'lk' => 45.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Nafsu makan baik, motorik aktif.', 'cat_val' => 'Pertumbuhan normal sesuai usia.'],
                    ['m' => 2, 'bb' => 9.6, 'tb' => 77.5, 'lk' => 45.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Sudah bisa berdiri mandiri.', 'cat_val' => 'Bagus, pertahankan gizi seimbang.'],
                    ['m' => 1, 'bb' => 9.9, 'tb' => 78.8, 'lk' => 46.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan lahap 3x sehari + MPASI.', 'cat_val' => 'Status gizi baik.'],
                    ['m' => 0, 'bb' => 10.3, 'tb' => 80.2, 'lk' => 46.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Balita sangat sehat dan aktif.', 'cat_val' => 'Validasi lengkap, status gizi optimal.'],
                ],
            ],
            // 2. Aisyah Humaira Syahputra (Normal, Sehat, Bayi 8 Bulan)
            [
                'nama' => 'Aisyah Humaira Syahputra',
                'jk' => 'P',
                'umur_bulan' => 8,
                'parent_idx' => 1,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 3.0,
                'panjang_lahir' => 49.0,
                'lk_lahir' => 33.5,
                'history' => [
                    ['m' => 2, 'bb' => 7.2, 'tb' => 66.0, 'lk' => 42.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Mulai MPASI 6 bulan tekstur lumat.', 'cat_val' => 'Respon MPASI baik.'],
                    ['m' => 1, 'bb' => 7.7, 'tb' => 67.8, 'lk' => 43.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'ASI lanjut + bubur tim saring.', 'cat_val' => 'Kenaikan BB adekuat.'],
                    ['m' => 0, 'bb' => 8.1, 'tb' => 69.5, 'lk' => 43.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Ibu aktif bertanya menu prohe.', 'cat_val' => 'Pertumbuhan ideal.'],
                ],
            ],
            // 3. Teuku Rayyan Al-Ghifari (Risiko Stunting / T - Tidak Naik 2 Bulan)
            [
                'nama' => 'Teuku Rayyan Al-Ghifari',
                'jk' => 'L',
                'umur_bulan' => 22,
                'parent_idx' => 2,
                'posyandu_idx' => 1,
                'kader_idx' => 1,
                'berat_lahir' => 2.8,
                'panjang_lahir' => 48.0,
                'lk_lahir' => 33.0,
                'history' => [
                    ['m' => 3, 'bb' => 10.4, 'tb' => 81.5, 'lk' => 46.5, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Pernah demam dan batuk 4 hari.', 'cat_val' => 'Perlu monitoring pasca sakit.'],
                    ['m' => 2, 'bb' => 10.4, 'tb' => 82.0, 'lk' => 46.5, 'asi' => false, 'naik' => 'T', 'val' => 'approved', 'cat_kader' => 'BB tetap / tidak naik (GTM).', 'cat_val' => 'Edukasi variasi MPASI tinggi kalori.'],
                    ['m' => 1, 'bb' => 10.5, 'tb' => 82.3, 'lk' => 46.8, 'asi' => false, 'naik' => 'T', 'val' => 'approved', 'cat_kader' => 'Kenaikan BB di bawah KBM (<200g).', 'cat_val' => 'Konseling PMT Pemulihan Posyandu.'],
                    ['m' => 0, 'bb' => 10.7, 'tb' => 82.8, 'lk' => 47.0, 'asi' => false, 'naik' => 'N', 'val' => 'pending', 'cat_kader' => 'Mulai ada kenaikan setelah diberi telur & ikan.', 'cat_val' => null],
                ],
            ],
            // 4. Cut Nayla Khairunnisa (Bayi 5 Bulan - ASI Eksklusif)
            [
                'nama' => 'Cut Nayla Khairunnisa',
                'jk' => 'P',
                'umur_bulan' => 5,
                'parent_idx' => 3,
                'posyandu_idx' => 2,
                'kader_idx' => 2,
                'berat_lahir' => 3.1,
                'panjang_lahir' => 49.5,
                'lk_lahir' => 34.0,
                'history' => [
                    ['m' => 2, 'bb' => 5.8, 'tb' => 60.5, 'lk' => 40.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Full ASI eksklusif tanpa sufor.', 'cat_val' => 'Lanjutkan ASI eksklusif.'],
                    ['m' => 1, 'bb' => 6.4, 'tb' => 62.5, 'lk' => 41.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Bayi aktif, menyusu teratur.', 'cat_val' => 'Kenaikan BB sangat baik.'],
                    ['m' => 0, 'bb' => 6.9, 'tb' => 64.2, 'lk' => 41.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Persiapan edukasi MPASI 6 bulan.', 'cat_val' => 'Status gizi normal optimal.'],
                ],
            ],
            // 5. Khadijah Azzahra (Stunting / Pendek - Intervensi Puskesmas)
            [
                'nama' => 'Khadijah Azzahra',
                'jk' => 'P',
                'umur_bulan' => 18,
                'parent_idx' => 4,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 2.5,
                'panjang_lahir' => 46.5,
                'lk_lahir' => 32.0,
                'history' => [
                    ['m' => 3, 'bb' => 7.8, 'tb' => 73.0, 'lk' => 44.0, 'asi' => false, 'naik' => 'T', 'val' => 'approved', 'cat_kader' => 'Nafsu makan kurang, riwayat BBLR.', 'cat_val' => 'Diberikan paket PMT biskuit & susu.'],
                    ['m' => 2, 'bb' => 8.0, 'tb' => 73.8, 'lk' => 44.2, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Kunjungan rumah kader dilakukan.', 'cat_val' => 'TB/U masih di bawah -2 SD (Stunting).'],
                    ['m' => 1, 'bb' => 8.3, 'tb' => 74.5, 'lk' => 44.6, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'PMT rutin dikonsumsi harian.', 'cat_val' => 'Ada tren perbaikan tinggi badan.'],
                    ['m' => 0, 'bb' => 8.6, 'tb' => 75.4, 'lk' => 45.0, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Ibu rajin kontrol dan konsultasi.', 'cat_val' => 'Respon terapi nutrisi positif.'],
                ],
            ],
            // 6. Arkana Zikri Hidayat (Normal, Gizi Baik, 11 Bulan)
            [
                'nama' => 'Arkana Zikri Hidayat',
                'jk' => 'L',
                'umur_bulan' => 11,
                'parent_idx' => 5,
                'posyandu_idx' => 1,
                'kader_idx' => 1,
                'berat_lahir' => 3.3,
                'panjang_lahir' => 50.5,
                'lk_lahir' => 34.5,
                'history' => [
                    ['m' => 2, 'bb' => 8.7, 'tb' => 72.5, 'lk' => 44.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan MPASI 3x + selingan buah.', 'cat_val' => 'Gizi seimbang terpenuhi.'],
                    ['m' => 1, 'bb' => 9.1, 'tb' => 74.0, 'lk' => 45.2, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Merangkak cepat dan aktif.', 'cat_val' => 'Kenaikan BB di atas KBM.'],
                    ['m' => 0, 'bb' => 9.5, 'tb' => 75.8, 'lk' => 45.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Imunisasi lengkap sesuai jadwal.', 'cat_val' => 'Status gizi normal.'],
                ],
            ],
            // 7. Bilal Ramadhan Fauzi (Normal, Batita 28 Bulan)
            [
                'nama' => 'Bilal Ramadhan Fauzi',
                'jk' => 'L',
                'umur_bulan' => 28,
                'parent_idx' => 6,
                'posyandu_idx' => 2,
                'kader_idx' => 2,
                'berat_lahir' => 3.4,
                'panjang_lahir' => 51.0,
                'lk_lahir' => 35.0,
                'history' => [
                    ['m' => 2, 'bb' => 12.2, 'tb' => 89.0, 'lk' => 48.0, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan menu keluarga lancar.', 'cat_val' => 'Pertumbuhan ideal.'],
                    ['m' => 1, 'bb' => 12.6, 'tb' => 90.2, 'lk' => 48.3, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Aktif berlari dan bicara.', 'cat_val' => 'Status gizi baik.'],
                    ['m' => 0, 'bb' => 13.0, 'tb' => 91.5, 'lk' => 48.6, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Tinggi dan berat proporsional.', 'cat_val' => 'Bebas risiko stunting.'],
                ],
            ],
            // 8. Safiyya Salsabila Hakim (Gizi Kurang / Underweight - Pemantauan Khusus)
            [
                'nama' => 'Safiyya Salsabila Hakim',
                'jk' => 'P',
                'umur_bulan' => 15,
                'parent_idx' => 7,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 2.7,
                'panjang_lahir' => 48.0,
                'lk_lahir' => 33.0,
                'history' => [
                    ['m' => 2, 'bb' => 7.4, 'tb' => 74.0, 'lk' => 43.5, 'asi' => false, 'naik' => 'T', 'val' => 'approved', 'cat_kader' => 'Sering pilih-pilih makanan (picky eater).', 'cat_val' => 'Konseling feeding rules bagi ibu.'],
                    ['m' => 1, 'bb' => 7.6, 'tb' => 75.0, 'lk' => 43.8, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Diberikan suplemen vitamin & zinc.', 'cat_val' => 'BB/U masih rendah (-2.1 SD).'],
                    ['m' => 0, 'bb' => 7.9, 'tb' => 76.2, 'lk' => 44.2, 'asi' => false, 'naik' => 'N', 'val' => 'pending', 'cat_kader' => 'Kenaikan BB 300g bulan ini, membaik.', 'cat_val' => null],
                ],
            ],
            // 9. Kenzo Arshaka Tanjung (Normal, 9 Bulan)
            [
                'nama' => 'Kenzo Arshaka Tanjung',
                'jk' => 'L',
                'umur_bulan' => 9,
                'parent_idx' => 8,
                'posyandu_idx' => 1,
                'kader_idx' => 1,
                'berat_lahir' => 3.2,
                'panjang_lahir' => 50.0,
                'lk_lahir' => 34.0,
                'history' => [
                    ['m' => 2, 'bb' => 8.2, 'tb' => 69.0, 'lk' => 43.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Sudah tumbuh gigi seri bawah.', 'cat_val' => 'Pertumbuhan normal.'],
                    ['m' => 1, 'bb' => 8.6, 'tb' => 70.8, 'lk' => 44.3, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'MPASI tekstur cincang halus.', 'cat_val' => 'Adekuat.'],
                    ['m' => 0, 'bb' => 9.0, 'tb' => 72.5, 'lk' => 44.9, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Sehat dan ceria saat penimbangan.', 'cat_val' => 'Status gizi normal.'],
                ],
            ],
            // 10. Ameera Dzahin Setiawan (Bayi 4 Bulan - ASI Eksklusif)
            [
                'nama' => 'Ameera Dzahin Setiawan',
                'jk' => 'P',
                'umur_bulan' => 4,
                'parent_idx' => 9,
                'posyandu_idx' => 2,
                'kader_idx' => 2,
                'berat_lahir' => 3.0,
                'panjang_lahir' => 49.0,
                'lk_lahir' => 33.5,
                'history' => [
                    ['m' => 2, 'bb' => 5.1, 'tb' => 57.0, 'lk' => 38.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Imunisasi DPT 1 lancar.', 'cat_val' => 'ASI on demand teratur.'],
                    ['m' => 1, 'bb' => 5.8, 'tb' => 59.5, 'lk' => 39.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Kenaikan 700g, sangat bagus.', 'cat_val' => 'Bagus, pertahankan.'],
                    ['m' => 0, 'bb' => 6.4, 'tb' => 61.8, 'lk' => 40.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Full ASI eksklusif.', 'cat_val' => 'Pertumbuhan ideal bayi 4 bulan.'],
                ],
            ],
            // 11. Ziyad Atharizz Permana (Normal, Batita 30 Bulan)
            [
                'nama' => 'Ziyad Atharizz Permana',
                'jk' => 'L',
                'umur_bulan' => 30,
                'parent_idx' => 10,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 3.5,
                'panjang_lahir' => 51.5,
                'lk_lahir' => 35.0,
                'history' => [
                    ['m' => 2, 'bb' => 12.8, 'tb' => 91.0, 'lk' => 48.5, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan banyak sayur dan protein.', 'cat_val' => 'Pertumbuhan sangat baik.'],
                    ['m' => 1, 'bb' => 13.2, 'tb' => 92.4, 'lk' => 48.8, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Tumbuh kembang motorik halus baik.', 'cat_val' => 'Status gizi baik.'],
                    ['m' => 0, 'bb' => 13.6, 'tb' => 93.8, 'lk' => 49.1, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Balita cerdas dan lincah.', 'cat_val' => 'Pertumbuhan optimal.'],
                ],
            ],
            // 12. Cut Kayla Putri Danial (Stunting Berat / Sangat Pendek)
            [
                'nama' => 'Cut Kayla Putri Danial',
                'jk' => 'P',
                'umur_bulan' => 19,
                'parent_idx' => 11,
                'posyandu_idx' => 1,
                'kader_idx' => 1,
                'berat_lahir' => 2.4,
                'panjang_lahir' => 45.0,
                'lk_lahir' => 31.5,
                'history' => [
                    ['m' => 3, 'bb' => 7.2, 'tb' => 70.5, 'lk' => 43.0, 'asi' => false, 'naik' => 'T', 'val' => 'approved', 'cat_kader' => 'Riwayat diare berulang.', 'cat_val' => 'Rujukan ke Poli Gizi Puskesmas.'],
                    ['m' => 2, 'bb' => 7.4, 'tb' => 71.2, 'lk' => 43.2, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Mendapat F-100 & taburia.', 'cat_val' => 'Z-Score TB/U -2.8 SD (Sangat Pendek).'],
                    ['m' => 1, 'bb' => 7.7, 'tb' => 72.0, 'lk' => 43.6, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Ibu rutin masak formula padat gizi.', 'cat_val' => 'Kenaikan BB terpantau naik.'],
                    ['m' => 0, 'bb' => 8.0, 'tb' => 72.9, 'lk' => 44.0, 'asi' => false, 'naik' => 'N', 'val' => 'pending', 'cat_kader' => 'Perkembangan tinggi badan mulai terkejar.', 'cat_val' => null],
                ],
            ],
            // 13. Fathir Ahmad Pratama (Normal, 7 Bulan)
            [
                'nama' => 'Fathir Ahmad Pratama',
                'jk' => 'L',
                'umur_bulan' => 7,
                'parent_idx' => 12,
                'posyandu_idx' => 2,
                'kader_idx' => 2,
                'berat_lahir' => 3.1,
                'panjang_lahir' => 49.5,
                'lk_lahir' => 34.0,
                'history' => [
                    ['m' => 2, 'bb' => 7.4, 'tb' => 65.5, 'lk' => 42.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Mulai MPASI 6 bulan.', 'cat_val' => 'Tekstur saring halus.'],
                    ['m' => 1, 'bb' => 7.9, 'tb' => 67.2, 'lk' => 43.2, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan prohe hati ayam & telur.', 'cat_val' => 'Kenaikan adekuat.'],
                    ['m' => 0, 'bb' => 8.3, 'tb' => 68.8, 'lk' => 43.9, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Bayi montok dan ceria.', 'cat_val' => 'Status gizi normal.'],
                ],
            ],
            // 14. Shafira Nurul Izzah (Normal, 24 Bulan / 2 Tahun)
            [
                'nama' => 'Shafira Nurul Izzah',
                'jk' => 'P',
                'umur_bulan' => 24,
                'parent_idx' => 13,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 3.2,
                'panjang_lahir' => 50.0,
                'lk_lahir' => 34.0,
                'history' => [
                    ['m' => 2, 'bb' => 11.0, 'tb' => 84.5, 'lk' => 46.8, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Lulus ASI 2 tahun.', 'cat_val' => 'Transisi makanan padat lancar.'],
                    ['m' => 1, 'bb' => 11.4, 'tb' => 85.8, 'lk' => 47.1, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan mandiri pakai sendok.', 'cat_val' => 'Pertumbuhan baik.'],
                    ['m' => 0, 'bb' => 11.8, 'tb' => 87.0, 'lk' => 47.5, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Balita tumbuh sesuai kurva baku.', 'cat_val' => 'Status gizi normal.'],
                ],
            ],
            // 15. Ibrahim Malik Syah (Bayi 3 Bulan - Baru Terdaftar)
            [
                'nama' => 'Ibrahim Malik Syah',
                'jk' => 'L',
                'umur_bulan' => 3,
                'parent_idx' => 14,
                'posyandu_idx' => 1,
                'kader_idx' => 1,
                'berat_lahir' => 3.3,
                'panjang_lahir' => 50.0,
                'lk_lahir' => 34.5,
                'history' => [
                    ['m' => 1, 'bb' => 5.2, 'tb' => 56.5, 'lk' => 38.0, 'asi' => true, 'naik' => 'B', 'val' => 'approved', 'cat_kader' => 'Pendaftaran pertama balita baru.', 'cat_val' => 'Registrasi KMS baru berhasil.'],
                    ['m' => 0, 'bb' => 6.0, 'tb' => 59.2, 'lk' => 39.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Full ASI eksklusif, kenaikan 800g.', 'cat_val' => 'Status gizi baik.'],
                ],
            ],
            // 16. Zea Khalisa Farhan (Risiko Stunting / T - Butuh Pendampingan)
            [
                'nama' => 'Zea Khalisa Farhan',
                'jk' => 'P',
                'umur_bulan' => 13,
                'parent_idx' => 0,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 2.8,
                'panjang_lahir' => 47.5,
                'lk_lahir' => 33.0,
                'history' => [
                    ['m' => 2, 'bb' => 8.2, 'tb' => 71.5, 'lk' => 44.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Tumbuh gigi, sedikit rewel makan.', 'cat_val' => 'Beri porsi kecil tapi sering.'],
                    ['m' => 1, 'bb' => 8.2, 'tb' => 72.0, 'lk' => 44.2, 'asi' => true, 'naik' => 'T', 'val' => 'approved', 'cat_kader' => 'BB tidak naik bulan ini.', 'cat_val' => 'Periksa sanitasi & kebiasaan makan.'],
                    ['m' => 0, 'bb' => 8.4, 'tb' => 72.8, 'lk' => 44.5, 'asi' => true, 'naik' => 'N', 'val' => 'pending', 'cat_kader' => 'Mulai naik 200g setelah konseling.', 'cat_val' => null],
                ],
            ],
            // 17. Arsenio Daffa Pratama (Normal, 20 Bulan)
            [
                'nama' => 'Arsenio Daffa Pratama',
                'jk' => 'L',
                'umur_bulan' => 20,
                'parent_idx' => 1,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 3.4,
                'panjang_lahir' => 51.0,
                'lk_lahir' => 35.0,
                'history' => [
                    ['m' => 2, 'bb' => 11.2, 'tb' => 83.5, 'lk' => 47.0, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Makan lahap, suka ikan kembung.', 'cat_val' => 'Gizi seimbang.'],
                    ['m' => 1, 'bb' => 11.6, 'tb' => 84.8, 'lk' => 47.4, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Motorik kasar sangat aktif.', 'cat_val' => 'Pertumbuhan normal.'],
                    ['m' => 0, 'bb' => 12.0, 'tb' => 86.2, 'lk' => 47.8, 'asi' => false, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Balita sehat & ceria.', 'cat_val' => 'Status gizi normal.'],
                ],
            ],
            // 18. Mikayla Almahyra Syahputra (Normal, 16 Bulan)
            [
                'nama' => 'Mikayla Almahyra Syahputra',
                'jk' => 'P',
                'umur_bulan' => 16,
                'parent_idx' => 2,
                'posyandu_idx' => 1,
                'kader_idx' => 1,
                'berat_lahir' => 3.1,
                'panjang_lahir' => 49.0,
                'lk_lahir' => 33.8,
                'history' => [
                    ['m' => 2, 'bb' => 9.4, 'tb' => 77.0, 'lk' => 45.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Nafsu makan bagus.', 'cat_val' => 'Pertumbuhan normal.'],
                    ['m' => 1, 'bb' => 9.8, 'tb' => 78.5, 'lk' => 45.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Aktif berjalan lancar.', 'cat_val' => 'Kenaikan BB adekuat.'],
                    ['m' => 0, 'bb' => 10.1, 'tb' => 79.8, 'lk' => 46.0, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Balita sehat dan bugar.', 'cat_val' => 'Status gizi baik.'],
                ],
            ],
            // 19. Dzakiandra Rafisqy (Pengukuran Re-check / Ditolak validator untuk revisi)
            [
                'nama' => 'Dzakiandra Rafisqy',
                'jk' => 'L',
                'umur_bulan' => 10,
                'parent_idx' => 3,
                'posyandu_idx' => 2,
                'kader_idx' => 2,
                'berat_lahir' => 3.2,
                'panjang_lahir' => 50.0,
                'lk_lahir' => 34.0,
                'history' => [
                    ['m' => 2, 'bb' => 8.5, 'tb' => 70.0, 'lk' => 44.2, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Bayi sehat.', 'cat_val' => 'Normal.'],
                    ['m' => 1, 'bb' => 8.9, 'tb' => 71.5, 'lk' => 44.8, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Kenaikan teratur.', 'cat_val' => 'Normal.'],
                    ['m' => 0, 'bb' => 12.5, 'tb' => 72.8, 'lk' => 45.2, 'asi' => true, 'naik' => 'N', 'val' => 'rejected', 'cat_kader' => 'Timbangan terbaca 12.5kg (typo penulisan).', 'cat_val' => 'Anomali kenaikan 3.6kg dalam 1 bulan. Mohon timbang ulang balita.'],
                ],
            ],
            // 20. Nadzira Shaqueena (Bayi 6 Bulan - Baru Mulai MPASI)
            [
                'nama' => 'Nadzira Shaqueena',
                'jk' => 'P',
                'umur_bulan' => 6,
                'parent_idx' => 4,
                'posyandu_idx' => 0,
                'kader_idx' => 0,
                'berat_lahir' => 3.0,
                'panjang_lahir' => 48.5,
                'lk_lahir' => 33.5,
                'history' => [
                    ['m' => 2, 'bb' => 6.2, 'tb' => 61.5, 'lk' => 40.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'ASI eksklusif 4 bulan.', 'cat_val' => 'Kenaikan baik.'],
                    ['m' => 1, 'bb' => 6.8, 'tb' => 63.5, 'lk' => 41.5, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'ASI eksklusif 5 bulan.', 'cat_val' => 'Lulus ASI eksklusif.'],
                    ['m' => 0, 'bb' => 7.3, 'tb' => 65.2, 'lk' => 42.2, 'asi' => true, 'naik' => 'N', 'val' => 'approved', 'cat_kader' => 'Edukasi MPASI pertama hari ini di Posyandu.', 'cat_val' => 'Tumbuh kembang sangat baik.'],
                ],
            ],
        ];

        foreach ($balitaProfiles as $bIdx => $bp) {
            $ibu = $orangTuas[$bp['parent_idx']];
            $posyandu = $posyandus[$bp['posyandu_idx']];
            $kader = $kaders[$bp['kader_idx']];

            $tglLahir = $now->copy()->subMonths($bp['umur_bulan'])->subDays(rand(1, 20));
            $nikBalita = '117101' . $tglLahir->format('dmy') . str_pad($bIdx + 1, 4, '0', STR_PAD_LEFT);
            $bpjsBalita = '000' . rand(1000000000, 9999999999);

            $balita = Balita::create([
                'orang_tua_id' => $ibu->id,
                'posyandu_id' => $posyandu->id,
                'nik' => $nikBalita,
                'no_bpjs' => $bpjsBalita,
                'nama' => $bp['nama'],
                'jenis_kelamin' => $bp['jk'],
                'tanggal_lahir' => $tglLahir->format('Y-m-d'),
                'berat_lahir' => $bp['berat_lahir'],
                'panjang_lahir' => $bp['panjang_lahir'],
                'lingkar_kepala_lahir' => $bp['lk_lahir'],
            ]);

            // Riwayat Pengukuran
            foreach ($bp['history'] as $h) {
                $tglUkur = $now->copy()->subMonths($h['m'])->startOfMonth()->addDays(rand(3, 18));
                
                // Hitung Z-Score WHO Realistis
                $calcResult = $calculator->calculate(
                    $balita->tanggal_lahir,
                    $tglUkur,
                    $balita->jenis_kelamin,
                    $h['bb'],
                    $h['tb']
                );

                Pengukuran::create([
                    'balita_id' => $balita->id,
                    'kader_id' => $kader->id,
                    'tanggal_ukur' => $tglUkur,
                    'umur_bulan' => $calcResult['umur_bulan'],
                    'berat_badan' => $h['bb'],
                    'tinggi_badan' => $h['tb'],
                    'lingkar_kepala' => $h['lk'],
                    'asi_eksklusif' => $h['asi'],
                    'z_score_bbu' => $calcResult['z_score_bbu'],
                    'z_score_tbu' => $calcResult['z_score_tbu'],
                    'status_gizi' => $calcResult['status_gizi'],
                    'status_kenaikan' => $h['naik'],
                    'status_validasi' => $h['val'],
                    'catatan_validator' => $h['cat_val'],
                    'catatan_kader' => $h['cat_kader'],
                ]);
            }
        }

        // -------------------------------------------------------------
        // 6. JADWAL POSYANDU REALISTIS (5 JADWAL)
        // -------------------------------------------------------------
        $jadwalData = [
            [
                'posyandu_id' => $posyandu1->id,
                'judul' => 'Layanan Penimbangan & Imunisasi Balita Agustus 2026',
                'lokasi' => 'Balai Pertemuan Warga Gampong Lampulo',
                'tanggal' => $now->copy()->addDays(4)->format('Y-m-d'),
                'waktu_mulai' => '08:30',
                'waktu_selesai' => '11:30',
                'catatan' => 'Membawa buku KIA & kartu BPJS anak. Tersedia PMT Bubur Kacang Hijau + Telur Puyuh.',
            ],
            [
                'posyandu_id' => $posyandu2->id,
                'judul' => 'Pemberian Vitamin A & Obat Cacing Balita',
                'lokasi' => 'Kompleks Rukun Warga Peunayong',
                'tanggal' => $now->copy()->addDays(10)->format('Y-m-d'),
                'waktu_mulai' => '09:00',
                'waktu_selesai' => '12:00',
                'catatan' => 'Bulan kapsul Vitamin A (Biru untuk 6-11 bulan, Merah untuk 12-59 bulan).',
            ],
            [
                'posyandu_id' => $posyandu3->id,
                'judul' => 'Konseling Gizi Balita & PMT Berkelanjutan',
                'lokasi' => 'Balai Desa Bandar Baru',
                'tanggal' => $now->copy()->addDays(18)->format('Y-m-d'),
                'waktu_mulai' => '08:30',
                'waktu_selesai' => '11:30',
                'catatan' => 'Didampingi oleh Ahli Gizi Puskesmas Kuta Alam untuk balita berat badan kurang.',
            ],
            [
                'posyandu_id' => $posyandu1->id,
                'judul' => 'Sweeping Penimbangan Balita Rentan Stunting',
                'lokasi' => 'Wilayah RT 03 & 04 Gampong Lampulo',
                'tanggal' => $now->copy()->addDays(25)->format('Y-m-d'),
                'waktu_mulai' => '09:00',
                'waktu_selesai' => '12:00',
                'catatan' => 'Kunjungan rumah bagi balita yang absen pada hari H Posyandu.',
            ],
            [
                'posyandu_id' => $posyandu1->id,
                'judul' => 'Penimbangan Rutin & Imunisasi Balita Juli 2026',
                'lokasi' => 'Balai Pertemuan Warga Gampong Lampulo',
                'tanggal' => $now->copy()->subDays(28)->format('Y-m-d'),
                'waktu_mulai' => '08:30',
                'waktu_selesai' => '11:30',
                'catatan' => 'Kegiatan selesai dilaksanakan. Kehadiran 94% dari total sasaran balita.',
            ],
        ];

        foreach ($jadwalData as $jd) {
            Jadwal::create($jd);
        }
    }
}
