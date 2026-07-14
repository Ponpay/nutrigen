@props(['distribution'])

<div class="px-5 lg:px-6 mt-6 pb-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Donut Chart Mock -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col h-full">
            <h3 class="font-bold text-slate-800">Distribusi Status Gizi (BB/U)</h3>
            <p class="text-xs text-slate-500 mt-0.5 mb-6">Persentase proporsi seluruh balita di wilayah kerja</p>
            
            <div class="flex-1 flex flex-col sm:flex-row items-center justify-center gap-8">
                <!-- Mock SVG Donut -->
                <div class="relative w-48 h-48 shrink-0">
                    <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                        <!-- Normal (78%) -->
                        <path class="text-emerald-500" stroke-dasharray="78, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                        <!-- Wasting/Kurang (12%) -->
                        <path class="text-amber-500" stroke-dasharray="12, 100" stroke-dashoffset="-78" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                        <!-- Stunting/Sangat Kurang (8%) -->
                        <path class="text-rose-500" stroke-dasharray="8, 100" stroke-dashoffset="-90" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                        <!-- Risiko Lebih (2%) -->
                        <path class="text-blue-500" stroke-dasharray="2, 100" stroke-dashoffset="-98" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                    </svg>
                    <!-- Inner Text -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-extrabold text-slate-800">78%</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Normal</span>
                    </div>
                </div>

                <!-- Legend -->
                <div class="flex flex-col gap-3 w-full sm:w-auto">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                            <span class="text-sm font-medium text-slate-700">Normal</span>
                        </div>
                        <span class="text-sm font-bold text-slate-800">{{ $distribution['normal'] ?? 0 }}%</span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                            <span class="text-sm font-medium text-slate-700">Gizi Kurang</span>
                        </div>
                        <span class="text-sm font-bold text-slate-800">{{ $distribution['wasting'] ?? 0 }}%</span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                            <span class="text-sm font-medium text-slate-700">Gizi Buruk</span>
                        </div>
                        <span class="text-sm font-bold text-slate-800">{{ $distribution['stunting'] ?? 0 }}%</span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                            <span class="text-sm font-medium text-slate-700">Risiko Lebih</span>
                        </div>
                        <span class="text-sm font-bold text-slate-800">{{ $distribution['underweight'] ?? 0 }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bar Chart Mock -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col h-full">
            <h3 class="font-bold text-slate-800">Kasus Berisiko per Posyandu</h3>
            <p class="text-xs text-slate-500 mt-0.5 mb-6">Konsentrasi gizi kurang/buruk di setiap wilayah (Top 5)</p>
            
            <div class="flex-1 flex flex-col justify-end gap-4">
                
                <!-- Bar 1 -->
                <div class="flex items-end gap-3 h-8">
                    <div class="w-24 text-xs font-medium text-slate-600 truncate text-right shrink-0">Melati 1</div>
                    <div class="flex-1 h-full bg-slate-100 rounded-r-lg overflow-hidden relative">
                        <div class="absolute inset-y-0 left-0 bg-rose-500 rounded-r-lg" style="width: 85%;"></div>
                    </div>
                    <div class="w-8 text-xs font-bold text-slate-800 text-left shrink-0">15</div>
                </div>

                <!-- Bar 2 -->
                <div class="flex items-end gap-3 h-8">
                    <div class="w-24 text-xs font-medium text-slate-600 truncate text-right shrink-0">Mawar 2</div>
                    <div class="flex-1 h-full bg-slate-100 rounded-r-lg overflow-hidden relative">
                        <div class="absolute inset-y-0 left-0 bg-rose-500 rounded-r-lg" style="width: 65%;"></div>
                    </div>
                    <div class="w-8 text-xs font-bold text-slate-800 text-left shrink-0">11</div>
                </div>

                <!-- Bar 3 -->
                <div class="flex items-end gap-3 h-8">
                    <div class="w-24 text-xs font-medium text-slate-600 truncate text-right shrink-0">Kenanga 3</div>
                    <div class="flex-1 h-full bg-slate-100 rounded-r-lg overflow-hidden relative">
                        <div class="absolute inset-y-0 left-0 bg-rose-500 rounded-r-lg" style="width: 45%;"></div>
                    </div>
                    <div class="w-8 text-xs font-bold text-slate-800 text-left shrink-0">8</div>
                </div>

                <!-- Bar 4 -->
                <div class="flex items-end gap-3 h-8">
                    <div class="w-24 text-xs font-medium text-slate-600 truncate text-right shrink-0">Dahlia 1</div>
                    <div class="flex-1 h-full bg-slate-100 rounded-r-lg overflow-hidden relative">
                        <div class="absolute inset-y-0 left-0 bg-rose-500 rounded-r-lg" style="width: 20%;"></div>
                    </div>
                    <div class="w-8 text-xs font-bold text-slate-800 text-left shrink-0">3</div>
                </div>

                <!-- Bar 5 -->
                <div class="flex items-end gap-3 h-8">
                    <div class="w-24 text-xs font-medium text-slate-600 truncate text-right shrink-0">Anggrek 2</div>
                    <div class="flex-1 h-full bg-slate-100 rounded-r-lg overflow-hidden relative">
                        <div class="absolute inset-y-0 left-0 bg-rose-500 rounded-r-lg" style="width: 10%;"></div>
                    </div>
                    <div class="w-8 text-xs font-bold text-slate-800 text-left shrink-0">1</div>
                </div>

            </div>
        </div>

    </div>
</div>
