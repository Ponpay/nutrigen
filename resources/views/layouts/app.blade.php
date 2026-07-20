<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Drawer (Mobile) / Permanent (Desktop) -->
        <x-sidebar />

        <!-- Main Wrapper -->
        <div class="flex flex-col flex-1 w-full min-w-0 overflow-hidden">
            <x-navbar />

            <!-- Main Content Area -->
            <!-- pt-16 to offset fixed navbar, pb-16 to offset mobile footer -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden pt-4 lg:pt-0 pb-16 lg:pb-0 w-full relative">
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
