<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Login ke Akun Anda</h1>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="group stagger-1">
            <label for="email" class="block text-xs font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-emerald-600">Email Petugas / NIP</label>
            <div class="relative">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="block w-full px-5 py-4 bg-[#F4F7FB] border-transparent {{ $errors->has('email') ? 'border-red-400 focus:border-red-500 focus:ring-red-500/20' : 'focus:bg-white focus:border-emerald-500 focus:ring-emerald-500/20' }} rounded-2xl text-slate-900 text-sm font-semibold focus:ring-4 transition-all duration-300 ease-out hover:bg-[#EDF2F7] outline-none placeholder:text-slate-400 placeholder:font-medium" 
                    placeholder="Masukkan email atau NIP Anda">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-bold text-xs" />
        </div>

        <!-- Password -->
        <div class="group stagger-2">
            <label for="password" class="block text-xs font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-emerald-600">Kata Sandi</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="block w-full px-5 py-4 bg-[#F4F7FB] border-transparent {{ $errors->has('password') ? 'border-red-400 focus:border-red-500 focus:ring-red-500/20' : 'focus:bg-white focus:border-emerald-500 focus:ring-emerald-500/20' }} rounded-2xl text-slate-900 text-sm font-semibold focus:ring-4 transition-all duration-300 ease-out hover:bg-[#EDF2F7] outline-none placeholder:text-slate-400 placeholder:font-medium" 
                    placeholder="Masukkan kata sandi">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-bold text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="pt-1 pb-2 stagger-3">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div class="relative flex items-center justify-center">
                    <input id="remember_me" type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border-2 border-slate-300 bg-white hover:border-emerald-500 checked:border-emerald-500 checked:bg-emerald-500 focus:outline-none focus:ring-4 focus:ring-offset-0 focus:ring-emerald-500/20 transition-all">
                    <svg class="absolute w-3 h-3 opacity-0 peer-checked:opacity-100 text-white pointer-events-none transition-opacity" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <span class="ms-3 text-xs font-semibold text-slate-500 group-hover:text-slate-900 transition-colors select-none">Saya setuju dengan Syarat dan Ketentuan</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2 stagger-4">
            <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-500 hover:to-cyan-500 text-white font-bold py-4 px-4 rounded-2xl shadow-[0_8px_20px_rgba(16,185,129,0.25)] hover:shadow-[0_12px_25px_rgba(16,185,129,0.35)] hover:-translate-y-0.5 transition-all duration-300 text-sm flex justify-center items-center active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-emerald-500/30">
                Lanjutkan Masuk
            </button>
        </div>
    </form>

    <!-- Social Login Placeholder (Matches Reference Image) -->
    <div class="mt-8 pt-8 border-t border-slate-100 relative stagger-4" style="animation-delay: 0.5s;">
        <div class="absolute inset-x-0 -top-2.5 flex justify-center">
            <span class="bg-white px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Login Untuk Ibu</span>
        </div>
        <div class="flex flex-col items-center gap-4">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-green-50 text-green-500 flex items-center justify-center hover:bg-green-100 cursor-pointer transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-50 text-slate-500 flex items-center justify-center hover:bg-slate-100 cursor-pointer transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <p class="text-xs font-semibold text-slate-400">
                Ibu Balita masuk melalui <span class="text-emerald-600">Magic Link WhatsApp</span>.
            </p>
        </div>
    </div>
    
    @if($errors->has('email') || $errors->has('password'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(window.NutriAlert) window.NutriAlert.error('Login Gagal', 'Kredensial yang Anda masukkan salah. Silakan coba lagi.');
        });
    </script>
    @endif
</x-guest-layout>
