@extends('layouts.puskesmas')
@section('page-title', 'Laporan Evaluasi Gizi')
@section('page-mode', 'app')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasLaporanController@index
    Expected Variables: $stats, $distribution, $trends, $reports, $filters
--}}

<div class="flex-1 overflow-y-auto overflow-x-hidden w-full bg-slate-50">
    <!-- Main Layout Canvas -->
    <div class="flex flex-col w-full max-w-7xl mx-auto px-5 lg:px-8 pt-4 pb-10">
    
    <x-page-header 
        breadcrumbs="Portal Puskesmas • Analytics"
        title="Laporan Evaluasi Gizi" 
        subtitle="Analisis komprehensif cakupan sasaran dan prevalensi masalah gizi tingkat regional." 
        class="mb-4"
    />

    <!-- Global Filter Bar -->
    <div class="mb-4">
        <x-report.report-filter-bar :filters="$filters" :posyandus="$posyandus" />
    </div>

    <!-- Analytics Navigation -->
    <div class="bg-white border border-slate-200 px-2 lg:px-6 relative shadow-sm mb-4 rounded-xl">
        <x-report.tab-navigation />
    </div>

    <!-- Analytics Workspace -->
    <div class="flex flex-col gap-6">
        
        <!-- TAB: REKAP -->
        <div id="tab-rekap" class="report-tab-content block mt-0">
            <!-- KPI Summary Cards (No outer border wrapper in reference design) -->
            <div class="mb-6">
                <x-report.report-summary-card :stats="$stats" />
            </div>
            
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <div class="xl:col-span-8 bg-white border border-slate-200 rounded-[1.25rem] shadow-sm overflow-hidden flex flex-col h-full">
                    <x-report.report-table :reports="$reports" />
                </div>
                <div class="xl:col-span-4 bg-white border border-slate-200 rounded-[1.25rem] shadow-sm flex flex-col h-full">
                    <x-report.distribution-chart :distribution="$distribution" />
                </div>
            </div>
        </div>

        <!-- TAB: GRAFIK -->
        <div id="tab-grafik" class="report-tab-content hidden mt-2">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-10 shadow-sm flex items-center justify-center min-h-[400px] text-slate-400">
                <p>Grafik analisis tambahan belum tersedia.</p>
            </div>
        </div>

        <!-- TAB: TREND -->
        <div id="tab-trend" class="report-tab-content hidden mt-2">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-10 shadow-sm">
                <x-report.trend-chart :trends="$trends" />
            </div>
        </div>

        <!-- TAB: EXPORT -->
        <div id="tab-export" class="report-tab-content hidden mt-2">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-10 shadow-sm">
                <x-report.export-panel />
            </div>
        </div>

    </div>
    </div>
</div>

<!-- Tab Switching Script -->
<script>
    function switchReportTab(tabName) {
        // Hide all contents
        const contents = document.querySelectorAll('.report-tab-content');
        contents.forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });

        // Reset all buttons styling
        const buttons = document.querySelectorAll('.report-tab-btn');
        buttons.forEach(btn => {
            btn.className = 'report-tab-btn flex items-center gap-2 px-5 py-3.5 text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-slate-50 whitespace-nowrap transition-colors border-b-2 border-transparent';
        });

        // Show active content
        const activeContent = document.getElementById('tab-' + tabName);
        if(activeContent) {
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');
        }

        // Highlight active button
        const activeBtn = document.getElementById('btn-tab-' + tabName);
        if(activeBtn) {
            activeBtn.className = 'report-tab-btn flex items-center gap-2 px-5 py-3.5 text-sm font-bold whitespace-nowrap transition-colors text-mint-700 border-b-2 border-mint-600 bg-mint-50/50';
        }
    }
</script>

@endsection
