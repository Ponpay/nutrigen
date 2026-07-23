@props(['history'])

<div class="w-full">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="py-2 text-[11px] font-medium text-slate-500 whitespace-nowrap">Tanggal</th>
                    <th class="py-2 text-[11px] font-medium text-slate-500">BB (kg)</th>
                    <th class="py-2 text-[11px] font-medium text-slate-500">TB (cm)</th>
                    <th class="py-2 text-[11px] font-medium text-slate-500">TB/U</th>
                    <th class="py-2 text-[11px] font-medium text-slate-500">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $h)
                    <tr>
                        <td class="py-2.5 text-[11px] text-slate-800">{{ $h['date'] }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ number_format((float)$h['bb'], 1) }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ number_format((float)$h['tb'], 1) }}</td>
                        <td class="py-2.5 text-[11px] text-slate-600">{{ number_format((float)$h['tbu'], 2) }}</td>
                        <td class="py-2.5 text-[11px] font-medium {{ in_array(strtolower($h['status']), ['stunting', 'pendek', 'risiko', 'kurang']) ? 'text-rose-500' : 'text-emerald-500' }}">
                            {{ $h['status'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-[11px] text-slate-400">Belum ada riwayat pengukuran sebelumnya.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <a href="#" class="text-xs font-bold text-cyan-600 hover:text-cyan-700">Lihat riwayat lengkap &rarr;</a>
    </div>
</div>
