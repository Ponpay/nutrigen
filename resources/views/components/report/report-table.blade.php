@props(['reports'])

<div class="w-full">
    <div class="px-5 lg:px-6 py-4 border-b border-slate-200 bg-slate-50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="font-bold text-slate-800">Rekapitulasi Bulanan per Posyandu</h3>
                <p class="text-xs text-slate-500 mt-0.5">Detail cakupan sasaran dan prevalensi status gizi</p>
            </div>
            <!-- Backend Note: Tombol export mini bisa di sini jika diperlukan, tapi UI utamanya ada di Tab Export -->
        </div>
        
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider">
                        <th class="px-4 py-3 font-bold">Nama Posyandu</th>
                        <th class="px-4 py-3 font-bold text-center">Sasaran</th>
                        <th class="px-4 py-3 font-bold text-center">Diukur</th>
                        <th class="px-4 py-3 font-bold text-center text-emerald-600">Normal</th>
                        <th class="px-4 py-3 font-bold text-center text-rose-600">Berisiko</th>
                        <th class="px-4 py-3 font-bold text-right">% Cakupan</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($reports as $row)
                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3.5 font-bold text-slate-800">{{ $row['nama_posyandu'] }}</td>
                            <td class="px-4 py-3.5 text-center font-medium text-slate-600">{{ number_format($row['sasaran']) }}</td>
                            <td class="px-4 py-3.5 text-center font-bold text-teal-600">{{ number_format($row['diukur']) }}</td>
                            <td class="px-4 py-3.5 text-center font-bold text-emerald-600 bg-emerald-50/30">{{ number_format($row['normal']) }}</td>
                            <td class="px-4 py-3.5 text-center font-bold text-rose-600 bg-rose-50/30">{{ number_format($row['berisiko']) }}</td>
                            <td class="px-4 py-3.5 text-right font-bold text-slate-700">
                                <div class="flex items-center justify-end gap-2">
                                    <div class="w-16 h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                        @php
                                            $pct = floatval(str_replace('%', '', $row['persentase_hadir']));
                                            $color = $pct >= 90 ? 'bg-emerald-500' : ($pct >= 75 ? 'bg-amber-500' : 'bg-rose-500');
                                        @endphp
                                        <div class="h-full {{ $color }}" style="width: {{ $pct }}%;"></div>
                                    </div>
                                    <span class="w-12">{{ $row['persentase_hadir'] }}</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">
                                Belum ada data laporan untuk bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
