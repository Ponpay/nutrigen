@props(['history'])

<div class="bg-white p-4 lg:p-5 rounded-lg border border-slate-200 w-full mt-4">
    <h3 class="text-[12px] font-bold text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Riwayat Pengukuran Sebelumnya
    </h3>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tanggal</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Usia</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">BB (kg)</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">TB (cm)</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">BB/U</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">TB/U</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">IMT/U</th>
                    <th class="py-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $h)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="py-2.5 text-[11px] font-bold text-slate-800">{{ $h['date'] }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ $h['age'] }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ number_format((float)$h['bb'], 1) }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ number_format((float)$h['tb'], 1) }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ number_format((float)$h['bbu'], 2) }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600 {{ ((float)$h['tbu'] < -2) ? 'text-rose-600 font-bold' : '' }}">{{ number_format((float)$h['tbu'], 2) }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ $h['imtu'] ? number_format((float)$h['imtu'], 2) : '-' }}</td>
                        <td class="py-2.5 text-[11px] font-bold {{ in_array(strtolower($h['status']), ['stunting', 'pendek', 'risiko', 'kurang']) ? 'text-rose-600' : 'text-emerald-600' }}">
                            {{ $h['status'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-4 text-center text-[11px] text-slate-400">Tidak ada riwayat pengukuran sebelumnya.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
