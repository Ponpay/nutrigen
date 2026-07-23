<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'Beranda') — Portal Puskesmas NutriGen</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900 antialiased font-sans overflow-x-hidden">
    
    <!-- App Shell: Sidebar + Content area fill full viewport -->
    <div class="flex h-screen overflow-hidden">
        
        <!-- Surface 1: Sidebar -->
        <x-puskesmas-sidebar />

        <!-- Main Column -->
        <div x-data="{ scrolled: false }" class="flex flex-col flex-1 w-full min-w-0 overflow-hidden relative lg:ml-72">
            <!-- Surface 1: Topbar -->
            <x-navbar />

            <!--
                Main Content Area.
                Two modes controlled by the view via @section('page-mode'):
                  - 'app'    → full-height, no padding (split-view pages: validasi, balita, posyandu)
                  - 'scroll' → padded, scrollable (dashboard, laporan, pengaturan)
                Default mode: 'scroll'
            -->
            @if(View::hasSection('page-mode') && View::getSection('page-mode') === 'app')
                {{-- APP MODE: Full-height, edge-to-edge, no outer wrapper --}}
                <main class="flex-1 overflow-hidden -mt-[76px] pt-[76px] pb-6 lg:pb-0 w-full relative flex flex-col">
                    @yield('content')
                </main>
            @else
                {{-- SCROLL MODE: Padded, scrollable container --}}
                <main @scroll.passive="scrolled = ($event.target.scrollTop > 10)" class="flex-1 overflow-y-auto overflow-x-hidden -mt-[76px] pt-[76px] pb-6 lg:pb-0 w-full relative bg-slate-50">
                    <div class="max-w-7xl mx-auto w-full px-5 py-6 lg:px-8 lg:py-8">
                        @yield('content')
                    </div>
                </main>
            @endif

        </div>
        
    </div>

    <x-flash-messages />
    @stack('modals')
    @stack('scripts')
</body>
</html>
