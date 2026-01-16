<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto md:flex md:flex-col shadow-2xl md:shadow-none">
    
    <div class="flex items-center justify-center h-16 border-b border-slate-100 bg-white/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-xl text-slate-900 tracking-tight">
            <div class="p-1.5 bg-indigo-600 rounded-lg text-white shadow-md shadow-indigo-500/30">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
            </div>
            <span>Resume<span class="text-indigo-600">AI</span></span>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
        
        <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-2">Overview</p>
        
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="layout-dashboard">
            Dashboard
        </x-nav-link>

        <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Workspace</p>

        <x-nav-link href="{{ route('resumes.index') }}" :active="request()->routeIs('resumes.*')" icon="file-text">
            Resumes
        </x-nav-link>

        <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Management</p>

        <x-nav-link href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')" icon="shield-check">
            Roles & Permissions
        </x-nav-link>

        <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')" icon="users">
            Users
        </x-nav-link>
    </nav>

    <div class="border-t border-slate-100 p-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="relative">
                <img class="h-9 w-9 rounded-full object-cover border border-white shadow-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-emerald-500"></span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-700 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500 truncate">Online</p>
            </div>
            <a href="{{ route('profile.show') }}" class="text-slate-400 hover:text-indigo-600 transition p-1 hover:bg-slate-100 rounded-md">
                <i data-lucide="settings" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</aside>