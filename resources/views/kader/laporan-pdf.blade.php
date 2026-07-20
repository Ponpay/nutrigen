<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan_Bulanan_{{ str_replace(' ', '_', $periode) }}.pdf</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }
        .summary-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .summary-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .stats-grid {
            display: table;
            width: 100%;
        }
        .stats-col {
            display: table-cell;
            width: 25%;
            text-align: center;
            border-right: 1px solid #eee;
        }
        .stats-col:last-child {
            border-right: none;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            display: block;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 14px;
        }
        .signature-line {
            margin-top: 60px;
            border-bottom: 1px solid #333;
            width: 200px;
            display: inline-block;
        }
        .print-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #0d9488;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            max-width: 200px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn no-print">Cetak ke PDF</button>

    <div class="header">
        <h1>LAPORAN PENGUKURAN POSYANDU</h1>
        <p><strong>Posyandu:</strong> {{ $posyanduAktif }} &nbsp;|&nbsp; <strong>Periode:</strong> {{ $periode }}</p>
    </div>

    <div class="summary-box">
        <div class="summary-title">Ringkasan Statistik Gizi</div>
        <div class="stats-grid">
            <div class="stats-col">
                <span class="stat-value">{{ $totalBalita }}</span>
                <span class="stat-label">Total Balita</span>
            </div>
            <div class="stats-col">
                <span class="stat-value" style="color: #0d9488;">{{ $sudahDiukur }}</span>
                <span class="stat-label">Sudah Diukur</span>
            </div>
            <div class="stats-col">
                <span class="stat-value" style="color: #d97706;">{{ $perluPerhatian }}</span>
                <span class="stat-label">Perlu Perhatian</span>
            </div>
            <div class="stats-col">
                <span class="stat-value" style="color: #e11d48;">{{ $berisiko }}</span>
                <span class="stat-label">Berisiko Tinggi</span>
            </div>
        </div>
    </div>

    <p style="font-size: 14px;"><strong>Cakupan Pengukuran Bulan Ini:</strong> {{ $persentase }}% ({{ $sudahDiukur }} dari {{ $totalBalita }} balita telah terukur).</p>

    <div class="summary-title" style="margin-top: 30px;">Daftar Balita Terukur ({{ $periode }})</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Balita</th>
                <th width="15%">NIK</th>
                <th width="10%">L/P</th>
                <th width="15%">Tgl Ukur</th>
                <th width="10%">BB (kg)</th>
                <th width="10%">TB (cm)</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($balitas as $index => $balita)
                @php 
                    $latest = $balita->pengukurans->first(); 
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $balita->nama }}</td>
                    <td>{{ $balita->nik }}</td>
                    <td style="text-align: center;">{{ $balita->jenis_kelamin }}</td>
                    <td>{{ $latest ? \Carbon\Carbon::parse($latest->tanggal_ukur)->format('d/m/Y') : '-' }}</td>
                    <td style="text-align: center;">{{ $latest ? $latest->berat_badan : '-' }}</td>
                    <td style="text-align: center;">{{ $latest ? $latest->tinggi_badan : '-' }}</td>
                    <td><strong>{{ $latest ? $latest->status_gizi : '-' }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Belum ada balita yang diukur pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
        <br><br><br>
        <div class="signature-line"></div>
        <p><strong>{{ $kaderName }}</strong><br>Kader Posyandu</p>
    </div>

    <script>
        // Auto trigger print dialog when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
