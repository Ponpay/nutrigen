@props([
    'childName',
    'age',
    'lastWeight' => null,
    'lastHeight' => null,
    'lastDate'   => null,
])

{{--
|--------------------------------------------------------------------------
| x-measurement-modal
|--------------------------------------------------------------------------
| Props expected from parent (profil-balita.blade.php):
|   - childName (string)  — displayed in the header and result state
|   - age       (string)  — displayed in the header context banner
|   - lastWeight (float|null) — previous measurement for delta warning
|   - lastHeight (float|null) — displayed in the context banner
|   - lastDate   (string|null) — displayed in the context banner
|
| Backend Integration:
|   Replace submitMeasurementApi() with a real fetch() POST to:
|   POST /api/measurements  or  POST /balita/{id}/measurements
|
|   Expected request body:
|     tanggal  (date)    — measurement date
|     berat    (float)   — weight in kg
|     tinggi   (float)   — height in cm
|     lingkar  (float)   — head circumference in cm (nullable)
|     catatan  (text)    — notes (nullable)
|
|   Expected response JSON:
|     { success: true, status_name: string, status_color: string }
--}}

<!-- Full-Screen Modal Overlay (Hidden by default) -->
<div id="measurementModal" class="fixed inset-0 z-[100] bg-slate-50 flex flex-col hidden overflow-hidden opacity-0 transition-opacity duration-300">
    
    <!-- Header Context -->
    <div class="bg-white px-4 py-3 border-b border-slate-200 sticky top-0 z-10 shadow-sm flex flex-col">
        <div class="flex items-center justify-between mb-3">
            <button onclick="closeMeasurementModal()" class="flex items-center gap-1.5 text-slate-500 hover:text-slate-800 focus:outline-none transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span class="text-sm font-bold">Tutup</span>
            </button>
            <h2 class="text-sm font-black text-slate-900 tracking-tight">Input Pengukuran</h2>
            <!-- Spacer to balance the 'Tutup' button width -->
            <div class="w-16"></div>
        </div>
        
        <!-- Child Context Banner -->
        <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col gap-1">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-slate-400">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
                <span class="text-[13px] font-extrabold text-slate-800">{{ $childName }} <span class="font-medium text-slate-500 ml-1">({{ $age }})</span></span>
            </div>
            @if($lastWeight && $lastDate)
            <div class="flex items-center gap-2 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-teal-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                    Pengukuran Lalu: <span class="text-teal-600">{{ $lastWeight }}kg | {{ $lastHeight }}cm</span> ({{ $lastDate }})
                </span>
            </div>
            @endif
        </div>
    </div>

    <!-- Scrollable Content Area -->
    <div class="flex-1 overflow-y-auto w-full relative">
        <div class="max-w-xl mx-auto w-full flex flex-col h-full">

            <!-- ========================================== -->
            <!-- STATE 1: INPUT FORM                        -->
            <!-- ========================================== -->
            <div id="modal-input-state" class="flex flex-col p-5 pb-32">
                {{--
                    Backend: Replace onsubmit with a real form action when wiring the API.
                    Form data keys: tanggal, berat, tinggi, lingkar, catatan
                --}}
                <form id="measurementForm" onsubmit="event.preventDefault(); handleFormSubmit();" class="flex flex-col gap-5">

                    <!-- Tanggal Pengukuran -->
                    <div class="flex flex-col gap-1.5">
                        <label for="tanggal" class="text-xs font-extrabold text-slate-500 uppercase tracking-wider ml-1">
                            Tanggal Pengukuran
                        </label>
                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            required
                            value="{{ date('Y-m-d') }}"
                            class="w-full bg-white border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 font-bold focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all shadow-sm">
                    </div>

                    <!-- Berat Badan -->
                    <div class="flex flex-col gap-1.5">
                        <label for="berat" class="text-xs font-extrabold text-slate-500 uppercase tracking-wider ml-1 flex items-center gap-1">
                            Berat Badan (KG) <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="number"
                            step="0.1"
                            id="berat"
                            name="berat"
                            required
                            placeholder="Contoh: 12.5"
                            oninput="validateWeight(this.value)"
                            class="w-full bg-white border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 font-black text-lg focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300 placeholder:font-medium">
                        
                        <!-- Inline Validation Warning -->
                        <div id="weight-warning" class="hidden mt-1.5 bg-amber-50 border border-amber-200/60 rounded-xl p-3 flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-amber-500 shrink-0 mt-0.5">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[11px] font-bold text-amber-700 leading-tight">Perhatian: Berat turun signifikan. Pastikan angka timbangan sudah benar.</span>
                        </div>
                    </div>

                    <!-- Tinggi Badan -->
                    <div class="flex flex-col gap-1.5">
                        <label for="tinggi" class="text-xs font-extrabold text-slate-500 uppercase tracking-wider ml-1 flex items-center gap-1">
                            Tinggi Badan (CM) <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="number"
                            step="0.1"
                            id="tinggi"
                            name="tinggi"
                            required
                            placeholder="Contoh: 87.2"
                            class="w-full bg-white border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 font-black text-lg focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300 placeholder:font-medium">
                    </div>

                    <!-- Lingkar Kepala (Opsional) -->
                    <div class="flex flex-col gap-1.5">
                        <label for="lingkar" class="text-xs font-extrabold text-slate-500 uppercase tracking-wider ml-1">
                            Lingkar Kepala (CM) <span class="text-slate-400 font-medium normal-case ml-1">- Opsional</span>
                        </label>
                        <input
                            type="number"
                            step="0.1"
                            id="lingkar"
                            name="lingkar"
                            placeholder="Opsional"
                            class="w-full bg-white border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 font-black text-lg focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300 placeholder:font-medium">
                    </div>

                    <!-- Catatan (Opsional) -->
                    <div class="flex flex-col gap-1.5">
                        <label for="catatan" class="text-xs font-extrabold text-slate-500 uppercase tracking-wider ml-1">
                            Catatan <span class="text-slate-400 font-medium normal-case ml-1">- Opsional</span>
                        </label>
                        <textarea
                            id="catatan"
                            name="catatan"
                            rows="2"
                            placeholder="Anak sedang demam, dll..."
                            class="w-full bg-white border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300 resize-none"></textarea>
                    </div>
                </form>

                <!-- Fixed CTA inside the Input State -->
                <div class="fixed bottom-0 left-0 right-0 p-5 bg-white border-t border-slate-100 shadow-[0_-8px_20px_-8px_rgba(0,0,0,0.05)] lg:max-w-xl lg:mx-auto lg:border-l lg:border-r">
                    <button type="submit" form="measurementForm" id="btn-submit" class="w-full flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white py-4 rounded-2xl font-black text-[13px] shadow-[0_8px_20px_-6px_rgba(13,148,136,0.4)] transition-all focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed">
                        <span id="btn-text">SIMPAN PENGUKURAN</span>
                        <svg id="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                        <!-- Spinner (Hidden by default) -->
                        <svg id="btn-spinner" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- STATE 2: RESULT & DIAGNOSIS                -->
            <!-- ========================================== -->
            {{--
                Backend: Populate status_name and diagnosis text from Z-Score calculation.
                Inject via: Elements.diagnosisLabel.textContent = response.status_name;
            --}}
            <div id="modal-result-state" class="hidden flex-col items-center justify-center p-6 mt-10 h-full max-w-sm mx-auto">
                
                <div class="w-20 h-20 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mb-6 shadow-[0_0_40px_-5px_rgba(13,148,136,0.4)] animate-bounce-short">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-slate-900 mb-2 tracking-tight text-center">Data Tersimpan!</h2>
                <p class="text-sm font-medium text-slate-500 text-center mb-10 leading-relaxed">
                    Pengukuran pertumbuhan <span class="font-bold text-slate-700">{{ $childName }}</span> telah berhasil disimpan ke sistem.
                </p>

                <!-- WHO Result Card -->
                <div class="bg-white border border-slate-100 rounded-[1.25rem] p-6 shadow-[0_4px_20px_-8px_rgba(0,0,0,0.05)] w-full flex flex-col items-center gap-3">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Diagnosa WHO</span>
                    
                    <div class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl border border-emerald-100/50 flex items-center gap-2 mt-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm"></div>
                        {{-- Backend: replace this static label with the API response value --}}
                        <span id="diagnosis-label" class="text-xs font-black uppercase tracking-wider">Gizi Baik (Normal)</span>
                    </div>

                    {{-- Backend: replace this static text with the API response narrative --}}
                    <p id="diagnosis-text" class="text-[13px] text-slate-600 font-medium text-center mt-3">
                        Anak tumbuh selaras. Berat badan naik sesuai kurva pertumbuhan WHO. Lanjutkan pola makan saat ini.
                    </p>
                </div>

                <div class="mt-auto pt-12 w-full">
                    <button onclick="closeMeasurementModal(true)" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 py-4 rounded-2xl font-black text-[13px] transition-colors focus:outline-none">
                        KEMBALI KE PROFIL BALITA
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // ──────────────────────────────────────────────────────────────────────────
    // Measurement Modal — Frontend Logic Layer
    // ──────────────────────────────────────────────────────────────────────────
    // Backend Integration Checklist:
    //   1. Replace submitMeasurementApi() with a real fetch() POST call.
    //   2. Inject response.status_name into #diagnosis-label.
    //   3. Inject response.diagnosis_text into #diagnosis-text.
    //   4. The form field names (tanggal, berat, tinggi, lingkar, catatan)
    //      map directly to the expected Request class fields.
    // ──────────────────────────────────────────────────────────────────────────

    // 1. Core State Accessors
    const Elements = {
        modal:        document.getElementById('measurementModal'),
        inputState:   document.getElementById('modal-input-state'),
        resultState:  document.getElementById('modal-result-state'),
        diagnosisLabel: document.getElementById('diagnosis-label'),
        diagnosisText:  document.getElementById('diagnosis-text'),
        btnText:      document.getElementById('btn-text'),
        btnIcon:      document.getElementById('btn-icon'),
        btnSpinner:   document.getElementById('btn-spinner'),
        btnSubmit:    document.getElementById('btn-submit'),
        warningBox:   document.getElementById('weight-warning'),
    };

    const previousWeight = {{ $lastWeight ?? 0 }};

    // 2. UI Transitions
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
            Elements.btnText.textContent = 'MENGHITUNG...';
            Elements.btnIcon.classList.add('hidden');
            Elements.btnSpinner.classList.remove('hidden');
        } else {
            Elements.btnSubmit.disabled = false;
            Elements.btnText.textContent = 'SIMPAN PENGUKURAN';
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

    // 3. Validation Logic
    function validateWeight(currentWeightStr) {
        if (!previousWeight || !currentWeightStr) return;
        const currentWeight = parseFloat(currentWeightStr);
        if (previousWeight - currentWeight > 0.5) {
            Elements.warningBox.classList.remove('hidden');
        } else {
            Elements.warningBox.classList.add('hidden');
        }
    }

    // 4. API Simulation Layer
    // ─────────────────────────────────────────────────────────────────
    // Backend: Replace this entire function with a real fetch() call:
    //
    // async function submitMeasurementApi(data) {
    //     const response = await fetch('/api/measurements', {
    //         method: 'POST',
    //         headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
    //         body: JSON.stringify(data)
    //     });
    //     return response.json();
    // }
    // ─────────────────────────────────────────────────────────────────
    async function submitMeasurementApi(data) {
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve({ success: true, status_name: 'Gizi Baik (Normal)', diagnosis_text: 'Anak tumbuh selaras.' });
            }, 1500);
        });
    }

    // 5. Main Submit Handler
    async function handleFormSubmit() {
        const formData = {
            tanggal: document.getElementById('tanggal').value,
            berat:   document.getElementById('berat').value,
            tinggi:  document.getElementById('tinggi').value,
            lingkar: document.getElementById('lingkar').value,
            catatan: document.getElementById('catatan').value,
        };

        setLoadingState(true);

        try {
            const response = await submitMeasurementApi(formData);
            if (response.success) {
                // Backend: inject real diagnosis result here
                if (Elements.diagnosisLabel) Elements.diagnosisLabel.textContent = response.status_name;
                if (Elements.diagnosisText)  Elements.diagnosisText.textContent  = response.diagnosis_text;
                transitionToResult();
            } else {
                throw new Error('API returned failure');
            }
        } catch (error) {
            alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
        } finally {
            setLoadingState(false);
        }
    }
</script>
