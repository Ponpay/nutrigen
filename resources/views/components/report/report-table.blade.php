@props(['reports'])

<div class="w-full h-full flex flex-col">
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col justify-center bg-white shrink-0">
        <h3 class="font-extrabold text-slate-800 text-[15px]">Rekapitulasi Bulanan per Posyandu</h3>
        <p class="text-[12px] text-slate-500 mt-1">Detail cakupan sasaran dan prevalensi status gizi</p>
    </div>
        
    <div class="overflow-x-auto hide-scrollbar flex-1 bg-white">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
                <tr class="border-b border-slate-100 text-[10px] text-slate-400 uppercase tracking-widest font-extrabold">
                    <th class="px-6 py-5">Nama Posyandu</th>
                    <th class="px-6 py-5 text-center">Sasaran</th>
                    <th class="px-6 py-5 text-center">Diukur</th>
                    <th class="px-6 py-5 text-center text-emerald-500">Normal</th>
                    <th class="px-6 py-5 text-center text-rose-500">Berisiko</th>
                    <th class="px-6 py-5 text-right">% Cakupan</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($reports as $row)
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-extrabold text-slate-800 text-[13px] block">{{ $row['nama_posyandu'] }}</span>
                            <!-- Assuming we don't have desa variable here since controller doesn't send it, omitting dummy data -->
                        </td>
                        <td class="px-6 py-4 text-center font-medium text-slate-600 text-[13px]">{{ number_format($row['sasaran']) }}</td>
                        <td class="px-6 py-4 text-center font-extrabold text-slate-700 text-[13px]">{{ number_format($row['diukur']) }}</td>
                        <td class="px-6 py-4 text-center font-extrabold text-emerald-600 text-[13px]">{{ number_format($row['normal']) }}</td>
                        <td class="px-6 py-4 text-center font-extrabold text-rose-600 text-[13px]">{{ number_format($row['berisiko']) }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    @php
                                        $pct = floatval(str_replace('%', '', $row['persentase_hadir']));
                                        $color = $pct >= 90 ? 'bg-emerald-500' : ($pct >= 75 ? 'bg-amber-500' : 'bg-rose-500');
                                    @endphp
                                    <div class="h-full {{ $color }} rounded-full" style="width: {{ $pct }}%;"></div>
                                </div>
                                <span class="w-9 text-right font-extrabold text-slate-600 text-[12px]">{{ $row['persentase_hadir'] }}</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 text-[13px]">
                            Belum ada data laporan untuk bulan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 bg-white border-t border-slate-100 text-center shrink-0">
        <a href="#" class="text-[12px] font-bold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors">
            Lihat Semua Posyandu 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
</div>
