<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">

    {{-- page-title is defined per-view via @section('page-title', '...') --}}
    <title>@yield('page-title', 'Beranda') — NutriGen</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased font-sans overflow-x-hidden">
    
    <!-- Responsive App Container -->
    <div class="flex h-[100dvh] overflow-hidden">
        
        <!-- Sidebar Drawer (Mobile) / Permanent (Desktop) -->
        <x-sidebar />

        <!-- Main Wrapper -->
        <div x-data="{ scrolled: false }" class="flex flex-col flex-1 w-full min-w-0 overflow-hidden relative">
            <x-navbar />

            <!-- Main Content Area -->
            <!-- -mt-[76px] pt-[76px] allows content to scroll under the navbar -->
            <main @scroll.passive="scrolled = ($event.target.scrollTop > 10)" class="flex-1 overflow-y-auto overflow-x-hidden -mt-[76px] pt-[76px] pb-[80px] lg:pb-0 w-full relative">
                <div class="w-full">
                    @yield('content')
                </div>
            </main>

            <!-- Bottom Navigation (Mobile Only) -->
            <x-footer />
        </div>
        
    </div>

    <x-flash-messages />
    @stack('modals')
    @stack('scripts')
</body>
</html>
