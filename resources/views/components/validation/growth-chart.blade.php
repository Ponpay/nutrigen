<div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-slate-400">
                <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
            </svg>
            Grafik Pertumbuhan KMS
        </h3>
        <select class="text-xs border-slate-200 rounded text-slate-600 bg-slate-50 px-2 py-1 focus:ring-teal-500">
            <option>BB/U</option>
            <option selected>TB/U</option>
            <option>BB/TB</option>
        </select>
    </div>
    
    <div class="relative h-64 w-full bg-slate-50 border border-slate-100 rounded-xl overflow-hidden flex items-center justify-center">
        <!-- SVG Dummy Curve -->
        <svg class="w-full h-full text-slate-200" viewBox="0 0 600 200" preserveAspectRatio="none">
            <!-- Zones -->
            <path d="M0,70 Q150,65 300,55 T600,40 L600,200 L0,200 Z" fill="#f0fdf4" />
            <path d="M0,130 Q150,125 300,115 T600,95 L600,200 L0,200 Z" fill="#fffbeb" />
            <path d="M0,170 Q150,165 300,155 T600,140 L600,200 L0,200 Z" fill="#fff1f2" />
            <!-- Grid Lines -->
            <line x1="0" y1="70" x2="600" y2="70" stroke="currentColor" stroke-dasharray="4" stroke-width="1" />
            <line x1="0" y1="130" x2="600" y2="130" stroke="currentColor" stroke-dasharray="4" stroke-width="1" />
            <!-- Plot Line -->
            <path d="M0,110 Q150,105 300,120 T600,180" fill="none" stroke="#0ea5e9" stroke-width="3" />
            <!-- Points -->
            <circle cx="300" cy="120" r="4" fill="#0ea5e9" stroke="#fff" stroke-width="2" />
            <circle cx="600" cy="180" r="6" fill="#0ea5e9" stroke="#fff" stroke-width="2" class="animate-pulse" />
        </svg>
        <!-- Y Axis Labels -->
        <div class="absolute left-2 top-0 bottom-0 py-4 flex flex-col justify-between text-[10px] text-slate-400 font-medium">
            <span>+2 SD</span>
            <span>0 SD</span>
            <span>-2 SD</span>
            <span>-3 SD</span>
        </div>
    </div>
</div>
