@props(['trends'])

<div class="px-5 lg:px-6 mt-6 pb-10">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h3 class="font-bold text-slate-800">Tren Status Gizi (6 Bulan Terakhir)</h3>
                <p class="text-xs text-slate-500 mt-0.5">Pergerakan persentase balita gizi normal vs berisiko dari waktu ke waktu</p>
            </div>
            
            <div class="flex items-center gap-2 text-xs font-bold bg-slate-100 p-1 rounded-lg">
                <button class="px-3 py-1.5 bg-white text-slate-800 rounded-md shadow-sm">6 Bulan</button>
                <button class="px-3 py-1.5 text-slate-500 hover:text-slate-800 transition-colors">12 Bulan</button>
            </div>
        </div>

        <!-- Line Chart Mock SVG -->
        <div class="w-full h-64 relative">
            
            <!-- Grid Lines -->
            <div class="absolute inset-0 flex flex-col justify-between">
                <div class="w-full border-t border-slate-100 flex-1"></div>
                <div class="w-full border-t border-slate-100 flex-1"></div>
                <div class="w-full border-t border-slate-100 flex-1"></div>
                <div class="w-full border-t border-slate-100 flex-1"></div>
                <div class="w-full border-t border-slate-200"></div>
            </div>
            
            <!-- Y-Axis Labels -->
            <div class="absolute inset-y-0 -left-6 flex flex-col justify-between items-end text-[10px] text-slate-400 font-medium pb-5">
                <span>100%</span>
                <span>75%</span>
                <span>50%</span>
                <span>25%</span>
                <span>0%</span>
            </div>

            <!-- X-Axis Labels -->
            <div class="absolute inset-x-0 -bottom-6 flex justify-between px-6 text-[10px] text-slate-500 font-bold uppercase tracking-wider">
                @foreach($trends as $trend)
                    <span>{{ $trend['bulan'] }}</span>
                @endforeach
            </div>

            <!-- Trend Lines (SVG) -->
            <svg class="absolute inset-0 w-full h-full" preserveAspectRatio="none">
                <!-- Normal Line (Green) -->
                <!-- Mock coordinates for the trend: points represent (x,y) percentages -->
                <!-- E.g. Jan(0, 20), Feb(20, 18), Mar(40, 15), Apr(60, 10), May(80, 12), Jun(100, 5) - where 0 is top and 100 is bottom -->
                <polyline 
                    points="0,20 20,18 40,15 60,10 80,12 100,5" 
                    fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    vector-effect="non-scaling-stroke"
                />
                
                <!-- Berisiko Line (Red) -->
                <polyline 
                    points="0,80 20,82 40,85 60,90 80,88 100,95" 
                    fill="none" stroke="#f43f5e" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    vector-effect="non-scaling-stroke"
                />
            </svg>
            
            <!-- Data Points & Tooltips (Mock) -->
            <!-- We'll just place a few dots for aesthetics to simulate hover points -->
            <div class="absolute inset-0 flex justify-between items-stretch">
                <!-- Data Point Columns -->
                @foreach([20, 18, 15, 10, 12, 5] as $index => $normalY)
                    <div class="flex-1 relative group cursor-pointer h-full border-x border-transparent hover:bg-slate-50/50 transition-colors">
                        <!-- Dot Normal -->
                        <div class="absolute w-3 h-3 bg-white border-2 border-emerald-500 rounded-full top-[{{ $normalY }}%] left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 shadow-sm transition-transform group-hover:scale-150"></div>
                        
                        <!-- Dot Berisiko -->
                        @php $berisikoY = 100 - $normalY; @endphp
                        <div class="absolute w-3 h-3 bg-white border-2 border-rose-500 rounded-full top-[{{ $berisikoY }}%] left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 shadow-sm transition-transform group-hover:scale-150"></div>
                        
                        <!-- Tooltip -->
                        <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-2 py-1 rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-20 pointer-events-none whitespace-nowrap">
                            <span class="font-bold text-emerald-400">Normal: {{ 100 - $normalY }}%</span><br>
                            <span class="font-bold text-rose-400">Berisiko: {{ $normalY }}%</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Conclusion Insight -->
        <div class="mt-12 bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-4 items-start">
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-800">Insight & Analisis</h4>
                <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                    Terjadi **peningkatan balita berstatus normal** sebesar <span class="font-bold text-emerald-600">+15%</span> dalam 6 bulan terakhir, menandakan bahwa intervensi PMT (Pemberian Makanan Tambahan) di 3 Posyandu sasaran menunjukkan hasil yang positif.
                </p>
            </div>
        </div>

    </div>
</div>
