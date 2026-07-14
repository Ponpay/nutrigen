@extends('layouts.puskesmas')
@section('page-title', 'Laporan Evaluasi Gizi')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasLaporanController@index
    Expected Variables: $stats, $distribution, $trends, $reports, $filters
--}}
@php
    $filters = [
        'bulan' => request('bulan', date('m')),
        'tahun' => request('tahun', date('Y')),
        'posyandu_id' => request('posyandu_id', 'semua')
    ];

    // DUMMY DATA FOR DEMO PURPOSES
    $stats = [
        'total_balita' => 1250,
        'normal' => 980,
        'berisiko' => 270,
        'pending_validasi' => 45,
        'sudah_validasi' => 1205
    ];

    $reports = [
        [
            'nama_posyandu' => 'Posyandu Melati 1',
            'sasaran' => 120,
            'diukur' => 110,
            'normal' => 100,
            'berisiko' => 10,
            'persentase_hadir' => '91.6%'
        ],
        [
            'nama_posyandu' => 'Posyandu Mawar 2',
            'sasaran' => 85,
            'diukur' => 80,
            'normal' => 70,
            'berisiko' => 10,
            'persentase_hadir' => '94.1%'
        ],
        [
            'nama_posyandu' => 'Posyandu Kenanga 3',
            'sasaran' => 150,
            'diukur' => 140,
            'normal' => 125,
            'berisiko' => 15,
            'persentase_hadir' => '93.3%'
        ],
        [
            'nama_posyandu' => 'Posyandu Dahlia 1',
            'sasaran' => 90,
            'diukur' => 85,
            'normal' => 70,
            'berisiko' => 15,
            'persentase_hadir' => '94.4%'
        ],
        [
            'nama_posyandu' => 'Posyandu Anggrek 2',
            'sasaran' => 110,
            'diukur' => 60,
            'normal' => 50,
            'berisiko' => 10,
            'persentase_hadir' => '54.5%'
        ]
    ];

    $distribution = [
        'normal' => 78,
        'wasting' => 12,
        'stunting' => 8,
        'underweight' => 2
    ];

    $trends = [
        ['bulan' => 'Feb'],
        ['bulan' => 'Mar'],
        ['bulan' => 'Apr'],
        ['bulan' => 'Mei'],
        ['bulan' => 'Jun'],
        ['bulan' => 'Jul'],
    ];
@endphp

<!-- Main Layout Canvas is bg-slate-50 -->
<div class="flex flex-col gap-8 w-full max-w-7xl mx-auto pb-10">
    
    <x-page-header 
        breadcrumbs="Portal Puskesmas • Analytics"
        title="Laporan Evaluasi Gizi" 
        subtitle="Analisis komprehensif cakupan sasaran dan prevalensi masalah gizi tingkat regional." 
    />

    <!-- Global Filter Bar -->
    <x-report.report-filter-bar :filters="$filters" />

    <!-- Analytics Navigation -->
    <div class="bg-white border-y border-slate-200 px-2 lg:px-6 sticky top-0 z-20 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]">
        <x-report.tab-navigation />
    </div>

    <!-- Analytics Workspace -->
    <div class="flex flex-col gap-6">
        
        <!-- TAB: REKAP -->
        <div id="tab-rekap" class="report-tab-content block space-y-8 mt-2">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-10 shadow-sm">
                <x-report.report-summary-card :stats="$stats" />
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <x-report.report-table :reports="$reports" />
            </div>
        </div>

        <!-- TAB: GRAFIK -->
        <div id="tab-grafik" class="report-tab-content hidden mt-2">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-10 shadow-sm">
                <x-report.distribution-chart :distribution="$distribution" />
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
            activeBtn.className = 'report-tab-btn flex items-center gap-2 px-5 py-3.5 text-sm font-bold whitespace-nowrap transition-colors text-teal-700 border-b-2 border-teal-600 bg-teal-50/50';
        }
    }
</script>

@endsection
