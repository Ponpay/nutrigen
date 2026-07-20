<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | NutriGen</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%2310B981%22/><text x=%2250%22 y=%2272%22 font-size=%2265%22 font-family=%22Arial%22 font-weight=%22bold%22 fill=%22white%22 text-anchor=%22middle%22>N</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-5px) scale(1.02); }
        }
        @keyframes waveShift {
            0%, 100% { transform: translateX(99%) scaleY(1); }
            50% { transform: translateX(99%) scaleY(1.02) translateY(5px); }
        }
        @keyframes waveShiftMobile {
            0%, 100% { transform: translateY(99%) scaleX(1); }
            50% { transform: translateY(99%) scaleX(1.02) translateX(5px); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 20px 50px rgba(16,185,129,0.1); }
            50% { box-shadow: 0 20px 50px rgba(16,185,129,0.3); }
        }

        .animate-card { animation: fadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-logo { animation: float 4s ease-in-out infinite; }
        .animate-waves-desktop { animation: waveShift 6s ease-in-out infinite; }
        .animate-waves-mobile { animation: waveShiftMobile 6s ease-in-out infinite; }
        .animate-text { animation: floatSlow 5s ease-in-out infinite; }
        
        /* Subtle entrance delays for form elements */
        .stagger-1 { animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards; opacity: 0; }
        .stagger-2 { animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards; opacity: 0; }
        .stagger-3 { animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards; opacity: 0; }
        .stagger-4 { animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards; opacity: 0; }
    </style>
</head>
<body class="antialiased min-h-screen bg-[#F4F7FB] relative selection:bg-emerald-500 selection:text-white flex items-center justify-center p-4 sm:p-8">
    <x-flash-messages />

    {{-- Main Container --}}
    <div class="w-full max-w-5xl bg-white rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-visible flex flex-col lg:flex-row relative z-10 animate-card">
        
        {{-- Left Side: Branding (NutriGen Emerald) --}}
        <div class="relative bg-gradient-to-br from-emerald-600 to-cyan-600 text-white p-6 sm:p-10 lg:p-14 lg:w-5/12 flex flex-col items-center justify-center text-center rounded-t-[2rem] lg:rounded-l-[2rem] lg:rounded-tr-none z-20 overflow-hidden lg:overflow-visible">
            
            {{-- Cloud / Wavy Divider for Desktop (Right Edge) --}}
            <svg viewBox="0 0 100 800" preserveAspectRatio="none" class="absolute top-0 right-0 h-full w-[12%] translate-x-[99%] hidden lg:block text-emerald-600 pointer-events-none z-20 animate-waves-desktop">
                <!-- Layer 1 -->
                <path d="M0,0 C60,60 60,120 0,180 C80,260 80,340 0,420 C50,480 50,540 0,600 C90,680 90,760 0,800 L0,0 Z" fill="currentColor" opacity="0.2"/>
                <!-- Layer 2 -->
                <path d="M0,0 C40,70 40,110 0,170 C60,250 60,320 0,400 C40,470 40,520 0,580 C70,670 70,750 0,800 L0,0 Z" fill="currentColor" opacity="0.5"/>
                <!-- Layer 3 -->
                <path d="M0,0 C20,80 20,100 0,160 C40,240 40,300 0,380 C20,460 20,500 0,560 C50,660 50,740 0,800 L0,0 Z" fill="currentColor"/>
            </svg>

            {{-- Cloud / Wavy Divider for Mobile (Bottom Edge) --}}
            <svg viewBox="0 0 800 100" preserveAspectRatio="none" class="absolute bottom-0 left-0 w-full h-8 translate-y-[99%] lg:hidden text-cyan-600 pointer-events-none z-20 animate-waves-mobile">
                <!-- Layer 1 -->
                <path d="M0,0 C60,60 120,60 180,0 C260,80 340,80 420,0 C480,50 540,50 600,0 C680,90 760,90 800,0 L0,0 Z" fill="currentColor" opacity="0.2"/>
                <!-- Layer 2 -->
                <path d="M0,0 C70,40 110,40 170,0 C250,60 320,60 400,0 C470,40 520,40 580,0 C670,70 750,70 800,0 L0,0 Z" fill="currentColor" opacity="0.5"/>
                <!-- Layer 3 -->
                <path d="M0,0 C80,20 100,20 160,0 C240,40 300,40 380,0 C460,20 500,20 560,0 C660,50 740,50 800,0 L0,0 Z" fill="currentColor"/>
            </svg>

            {{-- Inner Content --}}
            <div class="relative z-30 flex flex-col items-center">
                <h2 class="text-sm lg:text-xl font-bold mb-3 lg:mb-8 opacity-90 animate-text">Welcome to</h2>
                
                <div class="w-24 h-24 lg:w-32 lg:h-32 bg-white rounded-full flex items-center justify-center mb-3 lg:mb-8 animate-logo shadow-xl lg:shadow-2xl p-4 lg:p-6">
                    <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen Logo" class="w-full h-full object-contain">
                </div>
                
                <h3 class="text-xl lg:text-3xl font-extrabold mb-1 lg:mb-4 animate-text" style="animation-delay: 0.2s;">NutriGen</h3>
                
                <p class="hidden lg:block text-emerald-50 text-sm leading-relaxed max-w-xs font-medium animate-text" style="animation-delay: 0.4s;">
                    Sistem informasi terintegrasi untuk Posyandu dan Puskesmas. Mencegah stunting dengan data akurat dan standar WHO 2006.
                </p>

                <div class="hidden lg:flex mt-12 items-center gap-4 text-xs font-semibold text-emerald-100 uppercase tracking-widest animate-text" style="animation-delay: 0.6s;">
                    <span>Akurat</span>
                    <span class="w-1 h-1 bg-emerald-200 rounded-full"></span>
                    <span>Aman</span>
                </div>
            </div>
        </div>

        {{-- Right Side: Form Container --}}
        <div class="bg-white p-6 sm:p-10 lg:p-14 lg:w-7/12 flex flex-col justify-center rounded-b-[2rem] lg:rounded-r-[2rem] lg:rounded-bl-none relative z-0 mt-6 lg:mt-0">
            <div class="w-full max-w-md mx-auto">
                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>
