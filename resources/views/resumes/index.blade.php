<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <span class="text-slate-500">Workspace</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-indigo-600">My Resumes</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Resume Library</h1>
            </div>

            <a href="{{ route('resumes.create') }}" class="group flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <i data-lucide="file-plus-2" class="w-5 h-5 transition-transform group-hover:-translate-y-1"></i>
                <span>Create Resume</span>
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
            
            <div class="p-6">
                <table id="resumes-table" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 rounded-l-xl">#</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Resume Title</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Template</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Created At</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 text-right rounded-r-xl">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-600">
                        </tbody>
                </table>
            </div>

        </div>
    </div>

   

    <script type="module">
        $(document).ready(function() {
            var table = $('#resumes-table').DataTable({
                processing: true,
                serverSide: true, // Critical for speed with large datasets
                ajax: "{{ route('resumes.data') }}",
                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                        className: 'font-mono text-slate-400 text-xs pl-6' 
                    },
                    { 
                        data: 'title', 
                        name: 'title', // Matches Controller
                        className: 'font-bold text-slate-800 text-base',
                        render: function(data) {
                            // Optional: Add a document icon before the title
                            return `<div class="flex items-center gap-2"><i data-lucide="file-text" class="w-4 h-4 text-indigo-500"></i> ${data}</div>`;
                        }
                    },
                    { 
                        data: 'template_style', 
                        name: 'template_style', // Matches Controller
                        render: function(data) {
                            // Capitalize first letter
                            const display = data ? data.charAt(0).toUpperCase() + data.slice(1) : 'Standard';
                            // Badge styling
                            return `<span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">${display}</span>`;
                        }
                    },
                    { 
                        data: 'created_at', 
                        name: 'created_at',
                        className: 'text-slate-400 text-xs'
                    },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        className: 'text-right pr-6'
                    },
                ],
                // Language settings to swap text for Icons in pagination
                language: {
                    search: "", 
                    searchPlaceholder: "Search resumes...",
                    paginate: {
                        next: '<i data-lucide="chevron-right" class="w-4 h-4"></i>',
                        previous: '<i data-lucide="chevron-left" class="w-4 h-4"></i>'
                    },
                    processing: '<div class="flex items-center gap-2 text-indigo-600 font-bold"><i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i> Loading...</div>'
                },
                // Custom DOM Layout
                dom: '<"flex flex-col sm:flex-row justify-between items-center mb-6 gap-4"f>rt<"flex flex-col sm:flex-row justify-between items-center mt-6 gap-4"ip>',
                
                // IMPORTANT: Re-initialize icons every time the table redraws
                drawCallback: function() {
                    lucide.createIcons();
                }
            });
        });
    </script>
</x-app-layout>