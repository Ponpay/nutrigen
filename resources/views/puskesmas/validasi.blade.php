@extends('layouts.puskesmas')
@section('page-title', 'Antrean Validasi')
@section('page-mode', 'app')
@section('content')

    {{-- Backend Contract:
    Controller: PuskesmasValidasiController@index
    Expected Variables: $children, $filters
--}}
    @php
        $filters = [
            'tab' => request('tab', 'pending'),
            'posyandu_id' => request('posyandu_id', ''),
        ];

        $c_pending = $stats['pending'] ?? 0;
        $c_anomali = $stats['anomali'] ?? 0;
        $c_berisiko = $stats['berisiko'] ?? 0;
        $c_selesai = 12; // Dummy for now since DB logic isn't there
    @endphp

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed top-10 right-5 z-50 flex flex-col gap-2"></div>

    <div class="flex flex-col flex-1 overflow-hidden bg-slate-50/50">

        <!-- TOP SECTION KPI CARDS (Full Width) -->
        <div class="px-6 py-4 border-b border-slate-200 shrink-0 bg-white">
            <!-- Title area -->
            <div class="mb-4">
                <h1 class="text-xl font-bold tracking-tight text-slate-800">Antrean Validasi</h1>
                <p class="text-xs text-slate-500 mt-1">Validasi pengukuran yang dilakukan oleh kader posyandu</p>
            </div>

            <!-- 3. KPI CARDS (3 Grid) -->
            <div class="flex flex-col lg:flex-row gap-4 w-full">

                @php
                    $kpis = [
                        [
                            'id' => 'pending',
                            'label' => 'Menunggu Validasi',
                            'count' => $c_pending,
                            'color' => 'sky',
                            'bg' => 'bg-sky-50',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />',
                        ],
                        [
                            'id' => 'anomali',
                            'label' => 'Risiko Stunting',
                            'count' => $c_anomali,
                            'color' => 'amber',
                            'bg' => 'bg-amber-50',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
                        ],
                        [
                            'id' => 'berisiko',
                            'label' => 'Stunting',
                            'count' => $c_berisiko,
                            'color' => 'rose',
                            'bg' => 'bg-rose-50',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
                        ],
                    ];
                @endphp

                @foreach ($kpis as $kpi)
                    <a href="?tab={{ $kpi['id'] }}"
                        class="flex-1 {{ $kpi['bg'] }} rounded-xl p-3 flex items-center gap-3 transition-all border border-transparent hover:border-{{ $kpi['color'] }}-200">
                        <div
                            class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-{{ $kpi['color'] }}-500 shrink-0 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">{!! $kpi['icon'] !!}</svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-bold text-{{ $kpi['color'] }}-600">{{ $kpi['label'] }}</p>
                            <p
                                class="text-2xl font-black text-slate-800 leading-none mt-1 tracking-tight flex items-end gap-1">
                                <span id="count-{{ $kpi['id'] }}">{{ $kpi['count'] }}</span>
                                <span
                                    class="text-[10px] font-medium text-slate-500 mb-0.5 font-normal tracking-normal">data</span>
                            </p>
                        </div>
                    </a>
                @endforeach

                <!-- Posyandu Filter -->
                <form action="{{ route('puskesmas.validasi') }}" method="GET"
                    class="w-full lg:w-56 bg-white border border-slate-200 rounded-xl p-3 shadow-sm shrink-0 flex flex-col justify-center">
                    <input type="hidden" name="tab" value="{{ $filters['tab'] }}">
                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5">Posyandu</label>
                    <select name="posyandu_id"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-lg px-2 py-1.5 focus:ring-sky-500 focus:border-sky-500 outline-none transition-colors"
                        onchange="this.form.submit()">
                        <option value="">Semua Posyandu</option>
                        @foreach ($posyandus as $p)
                            <option value="{{ $p['nama'] }}"
                                {{ $filters['posyandu_id'] == $p['nama'] ? 'selected' : '' }}>{{ $p['nama'] }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <!-- Full-viewport Split View: Clinical Workspace -->
        <div class="flex flex-col lg:flex-row flex-1 overflow-hidden p-4 lg:p-5 gap-4 lg:gap-5 bg-slate-50/50">

            <!-- LEFT PANEL: Antrean Queue -->
            <div
                class="w-full lg:w-[35%] flex flex-col bg-white rounded-2xl border border-slate-200 shrink-0 overflow-hidden relative z-10 shadow-sm">

                <!-- TABS ROW INSIDE LEFT PANEL -->
                <div
                    class="px-4 bg-white border-b border-slate-100 flex overflow-x-auto hide-scrollbar shrink-0 pt-3 flex-nowrap">
                    @php
                        $tabs = [
                            ['id' => 'pending', 'label' => 'Semua', 'count' => $c_pending],
                            ['id' => 'normal', 'label' => 'Normal', 'count' => 6], // Placeholder from mockup
                            ['id' => 'anomali', 'label' => 'Risiko', 'count' => $c_anomali],
                            ['id' => 'berisiko', 'label' => 'Stunting', 'count' => $c_berisiko],
                        ];
                    @endphp
                    @foreach ($tabs as $t)
                        <a href="?tab={{ $t['id'] }}"
                            class="px-3 pb-2.5 text-[11px] font-bold flex items-center gap-1.5 whitespace-nowrap {{ $filters['tab'] === $t['id'] ? 'text-[#00A9C0] border-b-2 border-[#00A9C0]' : 'text-slate-500 hover:text-slate-700 border-b-2 border-transparent' }}">
                            {{ $t['label'] }} <span
                                class="text-[10px] {{ $filters['tab'] === $t['id'] ? 'text-[#00A9C0]' : 'text-slate-400' }}">({{ $t['count'] }})</span>
                        </a>
                    @endforeach
                </div>

                <!-- List Antrean (Scrollable) -->
                <div id="queueListContainer" class="flex-1 overflow-y-auto flex flex-col hide-scrollbar">
                    @forelse($children as $index => $child)
                        <div id="card-{{ $child['id'] }}"
                            class="queue-card-wrapper transition-all duration-300 origin-top">
                            <x-validation.queue-card :child="$child" :isActive="$index === 0" />
                        </div>
                    @empty
                        <div id="emptyStateQueue"
                            class="flex flex-col items-center justify-center h-48 text-slate-400 gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12 opacity-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium">Semua antrean telah divalidasi.</span>
                        </div>
                    @endforelse

                    <div id="emptyState"
                        class="hidden flex-col items-center justify-center h-48 text-slate-400 gap-3 px-4 text-center">
                        <div
                            class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-700">Antrean Bersih</span>
                        <span class="text-[10px] text-slate-500">Semua data telah tervalidasi.</span>
                    </div>
                </div>
            </div><!-- end left panel -->

            <!-- Mobile Drawer Overlay Background -->
            <div id="drawerOverlay"
                class="fixed inset-0 bg-slate-900/40 z-30 hidden opacity-0 transition-opacity duration-300 lg:hidden"></div>

            <!-- RIGHT PANEL: Validation Workspace — bg-white, pure work surface with shadow separation -->
            <div id="workspaceDrawer"
                class="fixed inset-x-0 bottom-0 z-40 h-[90vh] bg-white rounded-t-3xl transform translate-y-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col lg:relative lg:inset-auto lg:h-full lg:translate-y-0 lg:rounded-none lg:flex-1 lg:z-auto lg:shadow-none border-t border-slate-200 lg:border-t-0">

                <!-- Mobile Drawer Handle -->
                <div id="drawerHandle"
                    class="w-full flex items-center justify-between px-5 py-3.5 bg-white rounded-t-3xl border-b border-slate-100 lg:hidden shrink-0 cursor-pointer active:bg-slate-50 transition-colors">
                    <span
                        class="text-[11px] font-bold text-slate-400 uppercase tracking-widest w-16 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        Kembali
                    </span>
                    <div class="w-12 h-1.5 bg-slate-200 rounded-full"></div>
                    <div class="w-16 flex justify-end">
                        <div class="bg-slate-100 p-1.5 rounded-full text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>

                @if (count($children) > 0)
                    <div id="workspacesContainer" class="flex-1 flex flex-col overflow-hidden relative bg-white">
                        @foreach ($children as $index => $child)
                            <!-- WORKSPACE PANEL (1 per anak) -->
                            <div id="workspace-panel-{{ $child['id'] }}"
                                class="workspace-panel flex-1 flex flex-col h-full absolute inset-0 {{ $index === 0 ? '' : 'hidden' }} overflow-y-auto hide-scrollbar">

                                <x-validation.workspace-header :child="$child" />

                                <!-- Flow Content Container: Unified group with clear typography and spacing -->
                                <div class="p-4 lg:p-5 flex flex-col gap-6 w-full flex-1">

                                    <!-- Clinical Data Flow -->
                                    <div class="flex flex-col gap-3">
                                        <h3 class="text-sm font-bold tracking-tight text-slate-800">Data Pengukuran</h3>
                                        <div class="w-full">
                                            <x-validation.zscore-grid :zscores="$child['zscores']" />
                                        </div>
                                    </div>

                                    <!-- Context & History Flow -->
                                    <div class="grid grid-cols-1 xl:grid-cols-[1fr_350px] gap-6 items-start mt-4">
                                        <div class="flex flex-col gap-3">
                                            {{-- Catatan Kader (Jika ada) --}}
                                            @if (!empty($child['catatan_kader']))
                                                <div
                                                    class="p-3.5 bg-teal-50/80 border border-teal-200/80 rounded-2xl text-teal-950 flex items-start gap-3 shadow-xs">
                                                    <div
                                                        class="w-7 h-7 rounded-xl bg-teal-100/80 text-teal-700 flex items-center justify-center shrink-0 mt-0.5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="text-[11px] font-bold text-teal-800 uppercase tracking-wider block mb-0.5">Catatan
                                                            dari Kader ({{ $child['kader'] }}):</span>
                                                        <p class="text-xs font-semibold text-teal-900 leading-relaxed">
                                                            "{{ $child['catatan_kader'] }}"</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <h3 class="text-sm font-bold tracking-tight text-slate-800">Riwayat Pengukuran
                                                (Terakhir)</h3>
                                            <x-validation.timeline :history="$child['history']" :measurement-id="$child['id']" />
                                        </div>

                                        <!-- Catatan Validator -->
                                        <div class="flex flex-col gap-3">
                                            <h3 class="text-sm font-bold tracking-tight text-slate-800">Catatan Validator
                                            </h3>
                                            <div class="relative">
                                                <textarea id="catatan_validator_{{ $child['id'] }}"
                                                    class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl px-4 py-3 pb-8 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all placeholder-slate-400 resize-none outline-none shadow-sm h-32"
                                                    rows="4" placeholder="Tulis catatan hasil validasi..."></textarea>
                                                <span class="absolute right-3 bottom-3 text-[10px] text-slate-400">0 / 200
                                                    karakter</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Grafik KMS Accordion -->
                                    <div class="mt-2 w-full">
                                        <button type="button" onclick="toggleChart('{{ $child['id'] }}')"
                                            class="w-full bg-white border border-slate-200 rounded-lg p-3 flex items-center justify-between text-cyan-600 font-bold text-sm shadow-sm hover:bg-slate-50 transition-colors">
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                                </svg>
                                                Lihat Grafik KMS
                                            </div>
                                            <svg id="chart-icon-{{ $child['id'] }}" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                                stroke="currentColor" class="w-4 h-4 text-cyan-600 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <div id="chart-container-{{ $child['id'] }}"
                                            class="hidden w-full bg-white border border-slate-200 border-t-0 rounded-b-lg p-4 transition-all">
                                            <div class="flex justify-between items-center mb-4">
                                                <h4 class="text-xs font-bold tracking-tight text-slate-700">Pilih
                                                    Indikator:</h4>
                                                <select id="chart-metric-{{ $child['id'] }}"
                                                    onchange="updateChartMetric('{{ $child['id'] }}')"
                                                    class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-lg px-2 py-1.5 focus:ring-cyan-500 focus:border-cyan-500 outline-none transition-colors">
                                                    <option value="tb">Tinggi Badan (cm)</option>
                                                    <option value="bb">Berat Badan (kg)</option>
                                                    <option value="tbu">Z-Score TB/U</option>
                                                    <option value="bbu">Z-Score BB/U</option>
                                                </select>
                                            </div>
                                            <div class="w-full h-64">
                                                <canvas id="kms-chart-{{ $child['id'] }}"></canvas>
                                            </div>
                                            <script>
                                                window['chartData_{{ $child['id'] }}'] = {!! json_encode($child['chartData']) !!};
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sticky Actions -->
                                <x-validation.actions :childId="$child['id']" />

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center text-slate-400 p-8 bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-16 h-16 opacity-30 mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-medium text-center">Tidak ada antrean validasi.</p>
                    </div>
                @endif

                <!-- Empty Workspace State -->
                <div id="emptyWorkspaceState"
                    class="hidden flex-1 flex flex-col items-center justify-center p-8 bg-slate-50 absolute inset-0 z-10">
                    <div
                        class="w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center mb-6 shadow-sm border-4 border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" class="w-10 h-10 text-emerald-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-800 mb-2">Hebat! Antrean telah bersih.</h2>
                    <p class="text-sm font-medium text-slate-500 text-center max-w-sm leading-relaxed">
                        Anda telah menuntaskan seluruh antrean validasi pengukuran hari ini. Pekerjaan luar biasa! Waktunya
                        istirahat atau meninjau laporan.
                    </p>
                </div>
            </div><!-- end right panel -->

        </div><!-- end split view -->
    </div><!-- end main flex col -->

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="fixed inset-0 z-40 hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <!-- Modal Panel -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-teal-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-slate-900" id="modal-title">Validasi
                                    Data Pengukuran</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Data pengukuran ini akan disetujui dan Portal Ibu
                                        akan menerima pemberitahuan otomatis. Sistem juga akan membuat Secure Signed URL
                                        untuk akses Portal Ibu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" onclick="window.triggerApprove()"
                            class="inline-flex w-full justify-center rounded-xl bg-teal-600 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 sm:ml-3 sm:w-auto">Ya,
                            Validasi Data</button>
                        <button type="button" onclick="window.closeConfirmModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2.5 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-40 hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <!-- Modal Panel -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-6 pb-6 pt-8 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-teal-100 mb-5">
                            <svg class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold tracking-tight leading-6 text-slate-900 mb-2">Validasi Berhasil!</h3>
                        <p class="text-sm text-slate-500 mb-6">Data telah disetujui. Berikut adalah Secure Signed URL untuk
                            Portal Ibu.</p>

                        <div class="flex items-center gap-2 mb-6">
                            <input type="text" id="signedUrlInput" readonly
                                class="block w-full rounded-xl border-0 py-2.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-teal-600 sm:text-sm sm:leading-6 bg-slate-50 outline-none">
                            <button type="button" onclick="window.copySignedUrl()"
                                class="shrink-0 rounded-xl bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50"
                                title="Copy Link">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex flex-col gap-3">
                            <button type="button" onclick="window.openPortalIbu()"
                                class="inline-flex w-full justify-center rounded-xl bg-teal-600 px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-500">
                                Buka Portal Ibu
                            </button>
                            <button type="button" onclick="window.shareWhatsApp()"
                                class="inline-flex w-full justify-center items-center gap-2 rounded-xl bg-[#25D366] px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                Bagikan via WhatsApp
                            </button>
                            <button type="button" onclick="window.closeSuccessModal()"
                                class="inline-flex w-full justify-center rounded-xl bg-white px-3 py-3 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 mt-1">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div id="rejectConfirmModal" class="fixed inset-0 z-40 hidden">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-rose-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-slate-900" id="modal-title">Tolak Data
                                    Pengukuran</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500 mb-3">Data pengukuran ini akan ditolak dan tidak akan
                                        diteruskan ke Portal Ibu sampai dilakukan pengukuran ulang atau diperbaiki oleh
                                        Kader.</p>

                                    <div>
                                        <label for="catatan_validator"
                                            class="block text-sm font-semibold text-slate-700 mb-1">Catatan
                                            Validator</label>
                                        <textarea id="catatan_validator" rows="3"
                                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 text-sm p-3 border outline-none bg-slate-50 transition-colors"
                                            placeholder="Tuliskan alasan penolakan atau instruksi perbaikan untuk Kader..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" onclick="window.triggerReject()"
                            class="inline-flex w-full justify-center rounded-xl bg-rose-600 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 sm:ml-3 sm:w-auto">Ya,
                            Tolak Data</button>
                        <button type="button" onclick="window.closeRejectConfirmModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2.5 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Success Modal -->
    <div id="rejectSuccessModal" class="fixed inset-0 z-40 hidden">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-6 pb-6 pt-8 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 mb-5">
                            <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold tracking-tight leading-6 text-slate-900 mb-2">Data Ditolak</h3>
                        <p class="text-sm text-slate-500 mb-6">Data telah berhasil dikembalikan untuk diperbaiki oleh
                            kader. Portal Ibu tidak dapat mengakses data ini.</p>

                        <div class="flex flex-col gap-3">
                            <button type="button" onclick="window.closeRejectSuccessModal()"
                                class="inline-flex w-full justify-center rounded-xl bg-slate-800 px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-slate-700">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            window.kmsCharts = {};

            function toggleChart(id) {
                const container = document.getElementById('chart-container-' + id);
                const icon = document.getElementById('chart-icon-' + id);

                if (container.classList.contains('hidden')) {
                    container.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                    renderChart(id);
                } else {
                    container.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }

            function renderChart(id) {
                if (window.kmsCharts[id]) return; // already rendered

                const dataObj = window['chartData_' + id];
                if (!dataObj) return;

                const ctx = document.getElementById('kms-chart-' + id).getContext('2d');

                window.kmsCharts[id] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dataObj.labels,
                        datasets: [{
                            label: 'Tinggi Badan (cm)',
                            data: dataObj.tb,
                            borderColor: '#00A9C0',
                            backgroundColor: '#00A9C0',
                            borderWidth: 2,
                            tension: 0.3,
                            pointRadius: 4,
                            pointBackgroundColor: '#fff',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                title: {
                                    display: true,
                                    text: 'Tinggi Badan (cm)'
                                },
                                grid: {
                                    color: '#f1f5f9'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            function updateChartMetric(id) {
                const metric = document.getElementById('chart-metric-' + id).value;
                const chart = window.kmsCharts[id];
                const dataObj = window['chartData_' + id];

                if (!chart || !dataObj) return;

                let labelText = '';
                let dataset = [];

                switch (metric) {
                    case 'tb':
                        labelText = 'Tinggi Badan (cm)';
                        dataset = dataObj.tb;
                        break;
                    case 'bb':
                        labelText = 'Berat Badan (kg)';
                        dataset = dataObj.bb;
                        break;
                    case 'tbu':
                        labelText = 'Z-Score TB/U';
                        dataset = dataObj.tbu;
                        break;
                    case 'bbu':
                        labelText = 'Z-Score BB/U';
                        dataset = dataObj.bbu;
                        break;
                }

                chart.data.datasets[0].label = labelText;
                chart.data.datasets[0].data = dataset;

                if (chart.options.scales && chart.options.scales.y && chart.options.scales.y.title) {
                    chart.options.scales.y.title.text = labelText;
                }

                chart.update();
            }

            document.addEventListener('DOMContentLoaded', () => {
                const drawer = document.getElementById('workspaceDrawer');
                const overlay = document.getElementById('drawerOverlay');
                const handle = document.getElementById('drawerHandle');
                let isProcessing = false;

                function openDrawer() {
                    if (window.innerWidth >= 1024) return;
                    drawer.classList.remove('translate-y-full');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                    document.body.style.overflow = 'hidden';
                }

                function closeDrawer() {
                    if (window.innerWidth >= 1024) return;
                    drawer.classList.add('translate-y-full');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                    document.body.style.overflow = '';
                }

                if (overlay) overlay.addEventListener('click', closeDrawer);
                if (handle) handle.addEventListener('click', closeDrawer);

                function showToast(message, type = 'success') {
                    const container = document.getElementById('toastContainer');
                    const toast = document.createElement('div');
                    const bgColor = type === 'success' ? 'bg-teal-600' : 'bg-rose-600';
                    const icon = type === 'success' ?
                        `<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />` :
                        `<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />`;

                    toast.className =
                        `transform transition-all duration-300 translate-x-full opacity-0 ${bgColor} text-white px-4 py-3 rounded-xl shadow-sm border border-slate-200/60 flex items-center gap-3 w-max max-w-xs`;
                    toast.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 shrink-0">${icon}</svg><span class="text-sm font-bold">${message}</span>`;

                    container.appendChild(toast);
                    requestAnimationFrame(() => toast.classList.remove('translate-x-full', 'opacity-0'));
                    setTimeout(() => {
                        toast.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => toast.remove(), 300);
                    }, 3000);
                }

                function selectValidation(id) {
                    if (isProcessing) return;

                    const activeClasses = ['border-sky-300', 'border-l-sky-500', 'bg-sky-50/60', 'shadow-sm', 'z-10',
                        'rounded-sm'
                    ];
                    const inactiveClasses = ['border-transparent', 'border-b-slate-100', 'bg-white',
                        'hover:bg-slate-50', 'hover:border-slate-200', 'hover:shadow-sm', 'border-l-transparent'
                    ];

                    document.querySelectorAll('.validation-card-btn').forEach(btn => {
                        // Remove all possible active and old classes
                        btn.classList.remove(...activeClasses, 'ring-2', 'ring-teal-600', 'opacity-75',
                            'opacity-100');
                        btn.classList.add(...inactiveClasses);
                    });

                    const targetBtn = document.querySelector(`.validation-card-btn[data-validation-id="${id}"]`);
                    if (targetBtn) {
                        targetBtn.classList.remove(...inactiveClasses);
                        targetBtn.classList.add(...activeClasses);
                    }

                    document.querySelectorAll('.workspace-panel').forEach(panel => {
                        panel.classList.add('hidden');
                    });

                    const targetPanel = document.getElementById(`workspace-panel-${id}`);
                    if (targetPanel) {
                        targetPanel.classList.remove('hidden');
                    }

                    openDrawer();
                }

                const queueContainer = document.getElementById('queueListContainer');
                if (queueContainer) {
                    queueContainer.addEventListener('click', (e) => {
                        const btn = e.target.closest('.validation-card-btn');
                        if (btn) selectValidation(btn.dataset.validationId);
                    });
                }

                document.addEventListener('click', (e) => {
                    const btnApprove = e.target.closest('.btn-approve');
                    const btnReject = e.target.closest('.btn-reject');

                    if (btnApprove) window.showConfirmModal(btnApprove.dataset.id, btnApprove);
                    if (btnReject) window.showRejectConfirmModal(btnReject.dataset.id, btnReject);
                });

                window.pendingApproveId = null;
                window.pendingApproveBtn = null;

                window.showConfirmModal = function(id, btnEl) {
                    window.pendingApproveId = id;
                    window.pendingApproveBtn = btnEl;
                    document.getElementById('confirmModal').classList.remove('hidden');
                }

                window.closeConfirmModal = function() {
                    window.pendingApproveId = null;
                    window.pendingApproveBtn = null;
                    document.getElementById('confirmModal').classList.add('hidden');
                }

                window.triggerApprove = function() {
                    if (window.pendingApproveId && window.pendingApproveBtn) {
                        document.getElementById('confirmModal').classList.add('hidden');
                        processValidation(window.pendingApproveId, 'approve', window.pendingApproveBtn);
                    }
                }

                window.showRejectConfirmModal = function(id, btnEl) {
                    window.pendingApproveId = id;
                    window.pendingApproveBtn = btnEl;
                    document.getElementById('rejectConfirmModal').classList.remove('hidden');
                }

                window.closeRejectConfirmModal = function() {
                    window.pendingApproveId = null;
                    window.pendingApproveBtn = null;
                    document.getElementById('rejectConfirmModal').classList.add('hidden');
                }

                window.triggerReject = function() {
                    if (window.pendingApproveId && window.pendingApproveBtn) {
                        document.getElementById('rejectConfirmModal').classList.add('hidden');
                        processValidation(window.pendingApproveId, 'reject', window.pendingApproveBtn);
                    }
                }

                window.showSuccessModal = function(url) {
                    document.getElementById('signedUrlInput').value = url;
                    document.getElementById('successModal').classList.remove('hidden');
                }

                window.closeSuccessModal = function() {
                    document.getElementById('successModal').classList.add('hidden');
                }

                window.showRejectSuccessModal = function() {
                    document.getElementById('rejectSuccessModal').classList.remove('hidden');
                }

                window.closeRejectSuccessModal = function() {
                    document.getElementById('rejectSuccessModal').classList.add('hidden');
                }

                window.copySignedUrl = function() {
                    const input = document.getElementById('signedUrlInput');
                    input.select();
                    input.setSelectionRange(0, 99999);
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(input.value).then(() => {
                            showToast('Link disalin ke clipboard!', 'success');
                        }).catch(err => {
                            document.execCommand("copy");
                            showToast('Link disalin!', 'success');
                        });
                    } else {
                        document.execCommand("copy");
                        showToast('Link disalin!', 'success');
                    }
                }

                window.openPortalIbu = function() {
                    const url = document.getElementById('signedUrlInput').value;
                    window.open(url, '_blank');
                }

                window.shareWhatsApp = function() {
                    const url = document.getElementById('signedUrlInput').value;
                    const msg =
                        "Halo Ibu! Data pemantauan anak Anda telah tervalidasi. Berikut adalah tautan aman untuk mengakses rekam medis anak Anda di Portal Ibu:\n\n" +
                        url;
                    window.open('https://wa.me/?text=' + encodeURIComponent(msg), '_blank');
                }

                async function processValidation(id, action, btnEl) {
                    if (isProcessing) return;
                    isProcessing = true;

                    if (action === 'approve') {
                        btnEl.querySelector('.icon-approve').classList.add('hidden');
                        btnEl.querySelector('.spinner-approve').classList.remove('hidden');
                        btnEl.querySelector('.text-approve').innerText = 'Saving...';
                        btnEl.classList.add('opacity-80', 'cursor-not-allowed');
                    } else {
                        btnEl.classList.add('opacity-50', 'cursor-not-allowed');
                        btnEl.innerHTML = '<span>Processing...</span>';
                    }

                    try {
                        // If action is reject, we might want to call a reject endpoint, but for MVP let's assume it removes it from view or hits approve.
                        // The requirement is mostly about approve.
                        if (action === 'approve') {
                            const catatan = document.getElementById('catatan_validator_' + id)?.value || '';
                            const response = await fetch(`/puskesmas/validasi/${id}/approve`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    catatan_validator: catatan
                                })
                            });

                            if (!response.ok) {
                                let errorMessage = `HTTP Error ${response.status}`;
                                try {
                                    const errJson = await response.json();
                                    errorMessage = errJson.message || errorMessage;
                                } catch (e) {
                                    // If not JSON, try to get text, limit to 50 chars for toast
                                    const errorText = await response.text();
                                    if (errorText) errorMessage += `: ${errorText.substring(0, 50)}`;
                                }
                                throw new Error(errorMessage);
                            }

                            const data = await response.json();
                            if (!data.success) throw new Error(data.message || 'Validation failed');

                            // Update stats
                            updateStatsUI(data.stats);

                            window.showSuccessModal(data.signed_url);
                        } else {
                            const catatan = document.getElementById('catatan_validator_' + id)?.value || '';
                            const response = await fetch(`/puskesmas/validasi/${id}/reject`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    catatan_validator: catatan
                                })
                            });

                            if (!response.ok) throw new Error('Gagal menolak data.');
                            const data = await response.json();
                            if (!data.success) throw new Error(data.message || 'Validation failed');

                            // Update stats
                            updateStatsUI(data.stats);

                            // Reset textarea
                            const txt = document.getElementById('catatan_validator_' + id);
                            if (txt) txt.value = '';

                            window.showRejectSuccessModal();
                        }

                        // Cleanup UI
                        const cardEl = document.getElementById(`card-${id}`);
                        if (cardEl) {
                            cardEl.style.height = cardEl.offsetHeight + 'px';
                            cardEl.style.transform = 'translateY(-10px)';
                            cardEl.style.opacity = '0';
                            cardEl.style.marginBottom = '-' + cardEl.offsetHeight + 'px';
                            setTimeout(() => cardEl.remove(), 300);
                        }

                        const panelEl = document.getElementById(`workspace-panel-${id}`);
                        if (panelEl) panelEl.remove();

                        setTimeout(() => {
                            const remainingCards = document.querySelectorAll('.validation-card-btn');
                            if (remainingCards.length > 0) {
                                selectValidation(remainingCards[0].dataset.validationId);
                            } else {
                                const wsEmpty = document.getElementById('emptyWorkspaceState');
                                if (wsEmpty) wsEmpty.classList.remove('hidden');
                                const queueEmpty = document.getElementById('emptyState');
                                if (queueEmpty) {
                                    queueEmpty.classList.remove('hidden');
                                    queueEmpty.classList.add('flex');
                                }
                                closeDrawer();
                            }
                            isProcessing = false;
                        }, 350);

                    } catch (error) {
                        console.error(error);
                        showToast(`Error: ${error.message}`, 'error');

                        // Revert UI
                        if (action === 'approve') {
                            btnEl.querySelector('.icon-approve').classList.remove('hidden');
                            btnEl.querySelector('.spinner-approve').classList.add('hidden');
                            btnEl.querySelector('.text-approve').innerText = 'Approve Data';
                            btnEl.classList.remove('opacity-80', 'cursor-not-allowed');
                        } else {
                            btnEl.classList.remove('opacity-50', 'cursor-not-allowed');
                            btnEl.innerHTML = '<span>Tolak</span>';
                        }
                        isProcessing = false;
                    }
                }

                function updateStatsUI(stats) {
                    if (!stats) return;
                    const elPending = document.getElementById('count-pending');
                    const elAnomali = document.getElementById('count-anomali');
                    const elBerisiko = document.getElementById('count-berisiko');

                    if (elPending) elPending.innerText = stats.pending;
                    if (elAnomali) elAnomali.innerText = stats.anomali;
                    if (elBerisiko) elBerisiko.innerText = stats.berisiko;
                }

                // Initialize first active card style
                const firstCard = document.querySelector('.validation-card-btn');
                if (firstCard) {
                    selectValidation(firstCard.dataset.validationId);
                }
            });
        </script>
    @endpush
@endsection
