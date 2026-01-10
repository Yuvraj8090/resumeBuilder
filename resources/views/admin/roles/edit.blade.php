<x-app-layout>
    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <a href="{{ route('roles.index') }}" class="hover:underline">Roles</a>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-slate-500">Edit Role</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Edit Role: {{ $role->label }}</h1>
            </div>
            
            <a href="{{ route('roles.index') }}" class="flex items-center gap-2 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-700 px-4 py-2 rounded-xl text-sm font-medium transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to List
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-indigo-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i data-lucide="shield-alert" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Role Permissions</h3>
                        <p class="text-indigo-100 text-sm leading-relaxed">
                            Updating a role affects all users currently assigned to it. Ensure the role name is unique and the label is descriptive.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Meta Data</h4>
                    <ul class="space-y-4">
                        <li class="flex justify-between text-sm">
                            <span class="text-slate-500">Created At</span>
                            <span class="font-medium text-slate-700">{{ $role->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-slate-500">Last Updated</span>
                            <span class="font-medium text-slate-700">{{ $role->updated_at->diffForHumans() }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="p-8">
                        @csrf
                        @method('PUT')

                        <div class="mb-8 border-b border-slate-50 pb-6">
                            <h2 class="text-lg font-bold text-slate-800">Role Details</h2>
                            <p class="text-sm text-slate-500">Update the basic information for this role.</p>
                        </div>

                        <div class="space-y-6">
                            
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Internal Name (Slug)</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <i data-lucide="database" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="name" id="name" 
                                           value="{{ old('name', $role->name) }}"
                                           style="padding-left: 2.75rem;" 
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm bg-slate-50"
                                           {{ $role->name === 'super_admin' ? 'readonly' : '' }}>
                                </div>

                                @if($role->name === 'super_admin')
                                    <p class="mt-2 text-xs text-amber-600 flex items-center gap-1 font-medium">
                                        <i data-lucide="lock" class="w-3 h-3"></i> System role cannot be renamed.
                                    </p>
                                @else
                                    <p class="mt-2 text-xs text-slate-400">Used in code (e.g., 'project_manager'). Must be unique.</p>
                                @endif
                            </div>

                            <div>
                                <label for="label" class="block text-sm font-semibold text-slate-700 mb-2">Display Label</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <i data-lucide="tag" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="label" id="label" 
                                           value="{{ old('label', $role->label) }}"
                                           style="padding-left: 2.75rem;" 
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300">
                                </div>
                                <p class="mt-2 text-xs text-slate-400">Visible to users (e.g., 'Project Manager').</p>
                            </div>

                        </div>

                        <div class="mt-10 pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                            <a href="{{ route('roles.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm px-4 py-2 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40 transition-all transform active:scale-95 flex items-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
</x-app-layout>