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
        
        /* Glass Effect */
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Sidebar Link Styles */
        .nav-item-active {
            background: linear-gradient(to right, rgba(79, 70, 229, 0.08), transparent);
            border-left: 3px solid #4f46e5;
            color: #4f46e5;
        }
        .nav-item-inactive {
            border-left: 3px solid transparent;
            color: #64748b;
        }
        .nav-item-inactive:hover {
            background-color: #f8fafc;
            color: #334155;
        }
    </style>
</head>
<body class="h-full antialiased text-slate-800" x-data="{ sidebarOpen: false }">
    
    <x-banner />

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
             class="fixed inset-0 z-40 bg-slate-900/50 md:hidden backdrop-blur-sm"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto md:flex md:flex-col shadow-2xl md:shadow-none">
            
            <div class="flex items-center justify-center h-16 border-b border-slate-100 bg-white/50">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-xl text-slate-900 tracking-tight">
                    <div class="p-1.5 bg-indigo-600 rounded-lg text-white shadow-md shadow-indigo-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
                    </div>
                    <span>Resume<span class="text-indigo-600">AI</span></span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
                
                <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-2">Overview</p>
                
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item-inactive' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-r-md transition-all duration-200">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
                    Dashboard
                </a>

                <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Management</p>

                <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'nav-item-active' : 'nav-item-inactive' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-r-md transition-all duration-200">
                    <i data-lucide="shield-check" class="w-5 h-5 mr-3 {{ request()->routeIs('roles.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
                    Roles & Permissions
                </a>

                <a href="#" class="nav-item-inactive group flex items-center px-3 py-2.5 text-sm font-medium rounded-r-md transition-all duration-200">
                    <i data-lucide="users" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-slate-500"></i>
                    Users
                </a>

                <a href="#" class="nav-item-inactive group flex items-center px-3 py-2.5 text-sm font-medium rounded-r-md transition-all duration-200">
                    <i data-lucide="file-text" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-slate-500"></i>
                    Templates
                </a>
                
                <a href="#" class="nav-item-inactive group flex items-center px-3 py-2.5 text-sm font-medium rounded-r-md transition-all duration-200">
                    <i data-lucide="credit-card" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-slate-500"></i>
                    Billing
                </a>
            </nav>

            <div class="border-t border-slate-100 p-4 bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img class="h-9 w-9 rounded-full object-cover border border-white shadow-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-emerald-500"></span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-700 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">Admin</p>
                    </div>
                    <a href="{{ route('profile.show') }}" class="text-slate-400 hover:text-indigo-600 transition p-1 hover:bg-slate-100 rounded-md">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen relative overflow-hidden bg-slate-50/50">
            
            <header class="glass-header sticky top-0 z-30 h-16 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-md text-slate-500 hover:bg-slate-100 hover:text-indigo-600 transition">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    <div class="hidden md:flex items-center text-sm">
                        <span class="font-semibold text-slate-400">Admin</span>
                        @if (isset($header))
                            <i data-lucide="chevron-right" class="w-4 h-4 mx-2 text-slate-300"></i>
                            <span class="font-semibold text-slate-800">{{ $header }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-5">
                    
                    <div class="hidden sm:block relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" placeholder="Search..." class="pl-9 pr-4 py-1.5 text-sm bg-slate-100 border-none rounded-full w-48 focus:ring-2 focus:ring-indigo-500/20 text-slate-600 placeholder:text-slate-400 transition-all focus:w-64">
                    </div>

                    <button class="relative p-2 text-slate-400 hover:text-indigo-600 transition rounded-full hover:bg-indigo-50">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                    </button>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                            <span class="hidden md:block text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1 z-50 origin-top-right">
                            
                            <div class="px-4 py-2 border-b border-slate-50">
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold">Account</p>
                            </div>

                            <a href="{{ route('profile.show') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition">
                                <i data-lucide="user" class="w-4 h-4"></i> Profile
                            </a>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a href="{{ route('api-tokens.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition">
                                    <i data-lucide="key" class="w-4 h-4"></i> API Tokens
                                </a>
                            @endif

                            <div class="border-t border-slate-50 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 font-medium transition">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                
                @if (session()->has('message') || session()->has('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                         class="mb-6 bg-white border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
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
        function initIcons() {
            lucide.createIcons();
        }
        
        document.addEventListener("DOMContentLoaded", initIcons);
        
        // Ensure icons re-render when Livewire updates the DOM
        document.addEventListener("livewire:navigated", initIcons);
        document.addEventListener("livewire:update", initIcons);
    </script>
</body>
</html>