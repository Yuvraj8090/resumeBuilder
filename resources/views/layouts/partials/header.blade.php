<header class="glass-header sticky top-0 z-30 h-16 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
    
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-md text-slate-500 hover:bg-slate-100 hover:text-indigo-600 transition">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <div class="hidden md:flex items-center text-sm">
            <span class="font-semibold text-slate-400">App</span>
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
                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1 z-50 origin-top-right" x-cloak>
                
                <div class="px-4 py-2 border-b border-slate-50">
                    <p class="text-xs text-slate-400 uppercase tracking-wider font-bold">Account</p>
                </div>

                <a href="{{ route('profile.show') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition">
                    <i data-lucide="user" class="w-4 h-4"></i> Profile
                </a>

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