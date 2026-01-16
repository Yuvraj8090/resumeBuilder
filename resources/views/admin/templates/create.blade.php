<x-app-layout>
    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <a href="{{ route('admin.templates.index') }}" class="hover:underline">Templates</a>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-slate-500">Create</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Register New Design</h1>
            </div>
            
            <a href="{{ route('admin.templates.index') }}" class="flex items-center gap-2 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-700 px-4 py-2 rounded-xl text-sm font-medium transition-all shadow-sm">
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
                            <i data-lucide="layout-template" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2">New Template</h3>
                        <p class="text-indigo-100 text-sm leading-relaxed">
                            Add the HTML structure for your resume builder. Make sure to use Blade syntax for dynamic variables.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Blade Variables</h4>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li class="flex gap-2">
                            <code class="bg-slate-100 px-1.5 py-0.5 rounded text-indigo-600 text-xs font-mono">@{{ $resume->full_name }}</code>
                        </li>
                        <li class="flex gap-2">
                            <code class="bg-slate-100 px-1.5 py-0.5 rounded text-indigo-600 text-xs font-mono">@{{ $resume->email }}</code>
                        </li>
                        <li class="flex gap-2">
    <code class="bg-slate-100 px-1.5 py-0.5 rounded text-indigo-600 text-xs font-mono">@@foreach($resume->skills as $skill)</code>
</li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    
                    <form action="{{ route('admin.templates.store') }}" method="POST" class="p-8">
                        @csrf

                        <div class="mb-8 border-b border-slate-50 pb-6">
                            <h2 class="text-lg font-bold text-slate-800">Design Details</h2>
                            <p class="text-sm text-slate-500">Configure how this template appears to users.</p>
                        </div>

                        <div class="space-y-6">
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Template Name</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                        <i data-lucide="type" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Corporate Blue"
                                           style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm transition-all">
                                </div>
                                @error('name') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Thumbnail URL</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                        <i data-lucide="image" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="thumbnail" value="{{ old('thumbnail') }}" placeholder="https://..."
                                           style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm transition-all">
                                </div>
                            </div>

                            <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <input type="checkbox" name="is_premium" id="is_premium" value="1" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                                <label for="is_premium" class="text-sm font-medium text-slate-700 cursor-pointer select-none">
                                    Mark as <span class="text-indigo-600 font-bold">Premium Template</span> (Paid users only)
                                </label>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">HTML Blade Code</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <textarea name="html_code" rows="15" 
                                              class="block w-full rounded-xl border-slate-200 p-4 font-mono text-xs text-slate-600 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-600 focus:border-transparent shadow-inner transition-all"
                                              placeholder="<div class='resume'>...</div>">{{ old('html_code') }}</textarea>
                                </div>
                                @error('html_code') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        <div class="mt-10 pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                            <a href="{{ route('admin.templates.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm px-4 py-2 transition-colors">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40 transition-all transform active:scale-95 flex items-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                Save Template
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script> document.addEventListener("DOMContentLoaded", function() { lucide.createIcons(); }); </script>
</x-app-layout>