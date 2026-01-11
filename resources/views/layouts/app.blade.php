<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ResumeAI') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
        
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="h-full antialiased text-slate-800" x-data="{ sidebarOpen: false }">
    
    <x-banner />

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
             class="fixed inset-0 z-40 bg-slate-900/50 md:hidden backdrop-blur-sm" x-cloak></div>

        @include('layouts.partials.sidebar')

        <div class="flex-1 flex flex-col min-h-screen relative overflow-hidden bg-slate-50/50">
            
            @include('layouts.partials.header')

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if (session()->has('message') || session()->has('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                         class="mb-6 bg-white border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500 mt-0.5"></i>
                        <div>
                            <h3 class="text-sm font-medium text-emerald-800">Success</h3>
                            <p class="text-sm text-emerald-600 mt-1">{{ session('message') ?? session('success') }}</p>
                        </div>
                        <button @click="show = false" class="ml-auto text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-4 h-4"></i></button>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    
    <script>
        function initIcons() { lucide.createIcons(); }
        document.addEventListener("DOMContentLoaded", initIcons);
        document.addEventListener("livewire:navigated", initIcons);
    </script>
</body>
</html>