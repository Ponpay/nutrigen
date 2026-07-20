@props([
    'childName',
    'age',
    'lastWeight' => null,
    'lastHeight' => null,
    'lastDate'   => null,
])

{{--
|--------------------------------------------------------------------------
| x-measurement-modal (Premium Startup Polish)
|--------------------------------------------------------------------------
| Backend bindings — NEVER MODIFY:
|   Props   : childName, age, lastWeight, lastHeight, lastDate
|   Form    : action="{{ route('pengukuran.store') }}" method="POST"
|   Hidden  : name="balita_id"  value="{{ $balitaId }}"
|   Fields  : name="berat_badan" id="berat"    → oninput="validateWeight(this.value)"
|             name="tinggi_badan" id="tinggi"
|             name="lingkar_kepala" id="lingkar"
|             name="tanggal_ukur"  id="tanggal"  value="{{ old('tanggal_ukur', now()->format('Y-m-d')) }}"
|             name="catatan"       id="catatan"
|   JS IDs  : measurementModal, modal-input-state, modal-result-state
|             btn-submit, btn-text, btn-icon, btn-spinner
|             diagnosis-label, diagnosis-text, weight-warning
|   JS fns  : openMeasurementModal(), closeMeasurementModal(isSuccess?)
|             resetModalState(), setLoadingState(), transitionToResult()
|             validateWeight(v), previousWeight = {{ $lastWeight ?? 0 }}
--}}

<div id="measurementModal" class="fixed inset-0 z-[100] hidden opacity-0 transition-opacity duration-300">

    {{-- ── BACKDROP ────────────────────────────────────────────────────── --}}
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeMeasurementModal()"></div>

    {{-- ── POSITIONING WRAPPER ─────────────────────────────────────────── --}}
    <div class="absolute inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4 md:p-6 pointer-events-none">

        {{-- ── UNIFIED MODAL SURFACE ───────────────────────────────────── --}}
        {{-- Increased to max-w-3xl for optimal desktop 2-column breathing room --}}
        <div class="w-full max-w-3xl bg-white rounded-t-[28px] sm:rounded-3xl shadow-2xl flex flex-col max-h-[96vh] sm:max-h-[90vh] overflow-hidden pointer-events-auto">

            {{-- ════════════════════════════════════════════════════════════
                 STATE 1: INPUT FORM
            ═══════════════════════════════════════════════════════════════ --}}
            <div id="modal-input-state" class="flex flex-col flex-1 min-h-0">

                {{-- ── Header & Context (One continuous flow, no borders) ── --}}
                <div class="flex-shrink-0 px-6 pt-6 pb-2 sm:px-10 sm:pt-10 sm:pb-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">Input Pengukuran</h2>
                            <p class="text-sm text-slate-500 mt-1">Catat data pertumbuhan bulanan untuk dipantau oleh sistem.</p>
                        </div>
                        {{-- onclick="closeMeasurementModal()" PRESERVED --}}
                        <button type="button" onclick="closeMeasurementModal()" class="p-2 -mr-2 -mt-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Child Context Section --}}
                    <div class="mt-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 shadow-sm ring-1 ring-emerald-100/50">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2.5">
                                <h3 class="text-lg font-bold text-slate-800 truncate">{{ $childName }}</h3>
                                <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">{{ $age }}</span>
                            </div>
                            @if($lastWeight && $lastDate)
                            <div class="text-sm text-slate-400 mt-1 truncate">
                                Terakhir diukur: <span class="font-medium text-slate-600">{{ $lastWeight }}kg, {{ $lastHeight }}cm</span> pada {{ $lastDate }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ── Scrollable Form Area ── --}}
                <div class="flex-1 overflow-y-auto px-6 sm:px-10 pb-6 sm:pb-2">
                    <form id="measurementForm" action="{{ route('pengukuran.store') }}" method="POST" onsubmit="setTimeout(() => setLoadingState(true), 10);">
                        @csrf
                        <input type="hidden" name="balita_id" value="{{ $balitaId }}">

                        {{-- Beautiful, spacious 2-column grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 mt-2">

                            {{-- ── Berat Badan ── --}}
                            <div class="flex flex-col gap-2">
                                <label for="berat" class="text-sm font-semibold text-slate-700">
                                    Berat Badan <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative flex items-center group">
                                    <input
                                        type="number" step="any"
                                        id="berat" name="berat_badan"
                                        value="{{ old('berat_badan') }}" required
                                        placeholder="0.0"
                                        oninput="validateWeight(this.value)"
                                        class="w-full h-14 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl pl-4 pr-12 text-xl font-semibold text-slate-800 placeholder:text-slate-300 transition-all outline-none">
                                    <span class="absolute right-4 text-sm font-semibold text-slate-400 group-focus-within:text-emerald-500 transition-colors pointer-events-none">kg</span>
                                </div>
                                @error('berat_badan')
                                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                                @enderror

                                <div id="weight-warning" class="hidden mt-2 bg-amber-50 border border-amber-200/60 rounded-xl p-3 flex items-start gap-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-xs font-medium text-amber-700 leading-relaxed">Perhatian: Berat turun signifikan. Pastikan angka timbangan sudah benar.</span>
                                </div>
                            </div>

                            {{-- ── Tinggi Badan ── --}}
                            <div class="flex flex-col gap-2">
                                <label for="tinggi" class="text-sm font-semibold text-slate-700">
                                    Tinggi Badan <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative flex items-center group">
                                    <input
                                        type="number" step="any"
                                        id="tinggi" name="tinggi_badan"
                                        value="{{ old('tinggi_badan') }}" required
                                        placeholder="0.0"
                                        class="w-full h-14 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl pl-4 pr-12 text-xl font-semibold text-slate-800 placeholder:text-slate-300 transition-all outline-none">
                                    <span class="absolute right-4 text-sm font-semibold text-slate-400 group-focus-within:text-emerald-500 transition-colors pointer-events-none">cm</span>
                                </div>
                                @error('tinggi_badan')
                                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- ── Lingkar Kepala ── --}}
                            <div class="flex flex-col gap-2">
                                <label for="lingkar" class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                    Lingkar Kepala
                                    <span class="text-[10px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                                </label>
                                <div class="relative flex items-center group">
                                    <input
                                        type="number" step="any"
                                        id="lingkar" name="lingkar_kepala"
                                        value="{{ old('lingkar_kepala') }}"
                                        placeholder="0.0"
                                        class="w-full h-14 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl pl-4 pr-12 text-xl font-semibold text-slate-800 placeholder:text-slate-300 transition-all outline-none">
                                    <span class="absolute right-4 text-sm font-semibold text-slate-400 group-focus-within:text-emerald-500 transition-colors pointer-events-none">cm</span>
                                </div>
                                @error('lingkar_kepala')
                                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- ── Tanggal Pengukuran ── --}}
                            <div class="flex flex-col gap-2">
                                <label for="tanggal" class="text-sm font-semibold text-slate-700">
                                    Tanggal Pengukuran <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    id="tanggal" name="tanggal_ukur"
                                    value="{{ old('tanggal_ukur', now()->format('Y-m-d')) }}" required
                                    class="w-full h-14 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-sm font-medium text-slate-800 transition-all outline-none">
                                @error('tanggal_ukur')
                                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- ── Catatan ── --}}
                            <div class="flex flex-col gap-2 sm:col-span-2">
                                <label for="catatan" class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                    Catatan
                                    <span class="text-[10px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                                </label>
                                <textarea
                                    id="catatan" name="catatan"
                                    rows="2"
                                    placeholder="Tambahkan catatan khusus..."
                                    class="w-full bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 py-3.5 text-sm text-slate-800 placeholder:text-slate-400 transition-all outline-none resize-none"
                                >{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>{{-- end grid --}}
                    </form>
                </div>

                {{-- ── CTA Footer ── --}}
                {{-- Completely integrated on desktop. Sticky with subtle shadow on mobile. --}}
                <div class="flex-shrink-0 bg-white sticky bottom-0 border-t border-slate-100 sm:border-t-0 p-6 sm:px-10 sm:pt-6 sm:pb-10 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 sm:gap-4 rounded-b-[28px] sm:rounded-b-3xl">
                    <button type="button" onclick="closeMeasurementModal()" class="w-full sm:w-auto px-6 h-12 text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-colors focus:outline-none">
                        Batal
                    </button>
                    <button
                        type="submit" form="measurementForm" id="btn-submit"
                        class="w-full sm:w-auto px-8 h-12 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white rounded-xl font-semibold text-sm shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-4 focus:ring-emerald-500/20 disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span id="btn-text">Simpan Pengukuran</span>
                        <svg id="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                        <svg id="btn-spinner" class="animate-spin h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>

            </div>{{-- end #modal-input-state --}}

            {{-- ════════════════════════════════════════════════════════════
                 STATE 2: RESULT & DIAGNOSIS
            ═══════════════════════════════════════════════════════════════ --}}
            <div id="modal-result-state" class="hidden flex-col items-center justify-center text-center p-8 sm:p-12">
                <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-6 ring-8 ring-emerald-50/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-slate-800 mb-2 tracking-tight">Data Tersimpan</h2>
                <p class="text-sm text-slate-500 mb-10 max-w-sm mx-auto leading-relaxed">
                    Pengukuran <span class="font-semibold text-slate-700">{{ $childName }}</span> berhasil dicatat ke sistem.
                </p>

                <div class="bg-slate-50/50 ring-1 ring-inset ring-slate-100 rounded-2xl p-6 w-full max-w-sm flex flex-col items-center gap-4">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Diagnosa WHO</p>

                    <div class="bg-white shadow-sm ring-1 ring-inset ring-emerald-100 text-emerald-700 px-4 py-2 rounded-xl flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span id="diagnosis-label" class="text-sm font-semibold tracking-wide">Gizi Baik (Normal)</span>
                    </div>

                    <p id="diagnosis-text" class="text-sm text-slate-600 font-medium text-center leading-relaxed">
                        Anak tumbuh selaras. Berat badan naik sesuai kurva pertumbuhan WHO. Lanjutkan pola makan saat ini.
                    </p>
                </div>

                <button type="button" onclick="closeMeasurementModal(true)"
                    class="mt-10 w-full max-w-sm h-12 flex items-center justify-center bg-white shadow-sm ring-1 ring-inset ring-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-slate-100">
                    Kembali ke Profil
                </button>
            </div>{{-- end #modal-result-state --}}

        </div>{{-- end unified modal surface --}}

    </div>
</div>

<script>
    // ──────────────────────────────────────────────────────────────────────────
    // Measurement Modal — Frontend Logic Layer
    // ALL LOGIC AND IDs PRESERVED — DO NOT MODIFY
    // ──────────────────────────────────────────────────────────────────────────

    const Elements = {
        modal:          document.getElementById('measurementModal'),
        inputState:     document.getElementById('modal-input-state'),
        resultState:    document.getElementById('modal-result-state'),
        diagnosisLabel: document.getElementById('diagnosis-label'),
        diagnosisText:  document.getElementById('diagnosis-text'),
        btnText:        document.getElementById('btn-text'),
        btnIcon:        document.getElementById('btn-icon'),
        btnSpinner:     document.getElementById('btn-spinner'),
        btnSubmit:      document.getElementById('btn-submit'),
        warningBox:     document.getElementById('weight-warning'),
    };

    const previousWeight = {{ $lastWeight ?? 0 }};

    function openMeasurementModal() {
        Elements.modal.classList.remove('hidden');
        setTimeout(() => Elements.modal.classList.remove('opacity-0'), 10);
        document.body.style.overflow = 'hidden';
    }

    function closeMeasurementModal(isSuccess = false) {
        Elements.modal.classList.add('opacity-0');
        setTimeout(() => {
            Elements.modal.classList.add('hidden');
            document.body.style.overflow = '';
            if (isSuccess) {
                window.location.reload();
            } else {
                resetModalState();
            }
        }, 300);
    }

    function resetModalState() {
        Elements.inputState.classList.remove('hidden');
        Elements.resultState.classList.add('hidden');
        Elements.warningBox.classList.add('hidden');
        document.getElementById('measurementForm').reset();
    }

    function setLoadingState(isLoading) {
        if (isLoading) {
            Elements.btnSubmit.disabled = true;
            Elements.btnText.textContent = 'Menghitung...';
            Elements.btnIcon.classList.add('hidden');
            Elements.btnSpinner.classList.remove('hidden');
        } else {
            Elements.btnSubmit.disabled = false;
            Elements.btnText.textContent = 'Simpan Pengukuran';
            Elements.btnIcon.classList.remove('hidden');
            Elements.btnSpinner.classList.add('hidden');
        }
    }

    function transitionToResult() {
        Elements.inputState.classList.add('hidden');
        Elements.resultState.classList.remove('hidden');
        Elements.resultState.style.opacity = 0;
        setTimeout(() => {
            Elements.resultState.style.transition = 'opacity 0.5s ease';
            Elements.resultState.style.opacity = 1;
        }, 50);
    }

    function validateWeight(currentWeightStr) {
        if (!previousWeight || !currentWeightStr) return;
        const currentWeight = parseFloat(currentWeightStr);
        if (previousWeight - currentWeight > 0.5) {
            Elements.warningBox.classList.remove('hidden');
        } else {
            Elements.warningBox.classList.add('hidden');
        }
    }
</script>
