<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <a href="{{ route('resumes.index') }}" class="hover:underline">Resumes</a>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-slate-500">Design</span>
                </div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Choose Your Look</h1>
                <p class="text-slate-500 mt-2">Select a template to instantly apply it to your resume.</p>
            </div>
            
            <a href="{{ route('resumes.index') }}" class="flex items-center gap-2 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-700 px-4 py-2 rounded-xl text-sm font-medium transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($templates as $template)
                <div class="group relative bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden hover:-translate-y-1 transition-all duration-300">
                    
                    <div class="aspect-[3/4] bg-slate-100 relative overflow-hidden">
                        @if($template->thumbnail)
                            <img src="{{ $template->thumbnail }}" alt="{{ $template->name }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <i data-lucide="layout-template" class="w-12 h-12 mb-2 opacity-50"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">No Preview</span>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-indigo-900/0 group-hover:bg-indigo-900/40 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <form action="{{ route('resumes.updateTemplate', $resume->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="template_id" value="{{ $template->id }}">
                                <button type="submit" class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-bold shadow-lg transform scale-90 group-hover:scale-100 transition-all flex items-center gap-2">
                                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                                    Apply Template
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-5 border-t border-slate-50">
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-slate-800">{{ $template->name }}</h3>
                            @if($template->is_premium)
                                <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2 py-1 rounded-md flex items-center gap-1">
                                    <i data-lucide="crown" class="w-3 h-3"></i> Pro
                                </span>
                            @else
                                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-1 rounded-md">Free</span>
                            @endif
                        </div>
                    </div>
                    
                    @if($resume->template_id == $template->id)
                        <div class="absolute top-4 right-4 bg-indigo-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1.5 z-10">
                            <i data-lucide="check" class="w-3 h-3"></i> Active
                        </div>
                        <div class="absolute inset-0 border-4 border-indigo-600 rounded-2xl pointer-events-none"></div>
                    @endif

                </div>
            @endforeach
        </div>

    </div>
    <script> document.addEventListener("DOMContentLoaded", function() { lucide.createIcons(); }); </script>
</x-app-layout>