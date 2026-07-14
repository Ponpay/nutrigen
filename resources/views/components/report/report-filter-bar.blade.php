@props(['filters'])

<form action="{{ route('puskesmas.laporan') }}" method="GET" class="bg-white p-4 lg:px-8 lg:py-5 border-b border-slate-200 flex flex-col md:flex-row gap-4 items-center shrink-0 shadow-sm z-10 relative">
    
    <div class="flex items-center gap-2 text-sm font-bold text-slate-700 md:mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-teal-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
        </svg>
        Filter Data
    </div>

    <!-- Bulan -->
    <div class="w-full md:w-auto flex-1">
        <select name="bulan" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg p-2.5 focus:ring-teal-500 focus:border-teal-500" onchange="this.form.submit()">
            @php
                $months = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
            @endphp
            @foreach($months as $num => $name)
                <option value="{{ $num }}" {{ $filters['bulan'] === $num ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tahun -->
    <div class="w-full md:w-auto flex-1">
        <select name="tahun" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg p-2.5 focus:ring-teal-500 focus:border-teal-500" onchange="this.form.submit()">
            <option value="2026" {{ $filters['tahun'] == '2026' ? 'selected' : '' }}>2026</option>
            <option value="2025" {{ $filters['tahun'] == '2025' ? 'selected' : '' }}>2025</option>
        </select>
    </div>

    <!-- Posyandu -->
    <div class="w-full md:w-auto flex-[2]">
        <select name="posyandu_id" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg p-2.5 focus:ring-teal-500 focus:border-teal-500" onchange="this.form.submit()">
            <option value="semua" {{ $filters['posyandu_id'] === 'semua' ? 'selected' : '' }}>Semua Posyandu di Kecamatan</option>
            <option value="1" {{ $filters['posyandu_id'] == '1' ? 'selected' : '' }}>Posyandu Melati 1</option>
            <option value="2" {{ $filters['posyandu_id'] == '2' ? 'selected' : '' }}>Posyandu Mawar 2</option>
            <option value="3" {{ $filters['posyandu_id'] == '3' ? 'selected' : '' }}>Posyandu Kenanga 3</option>
        </select>
    </div>

</form>
