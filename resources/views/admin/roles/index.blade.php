<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <span class="text-slate-500">Management</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-indigo-600">Roles & Permissions</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">System Roles</h1>
            </div>

            <a href="{{ route('roles.create') }}" class="group flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <i data-lucide="plus-circle" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                <span>Create Role</span>
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
            
            <div class="p-6">
                <table id="roles-table" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 rounded-l-xl">#</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Role Name</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Display Label</th>
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

    <style>
        /* 1. Remove Default DataTables Borders */
        table.dataTable.no-footer {
            border-bottom: none !important;
        }
        
        /* 2. Style Search Input */
        .dataTables_filter {
            margin-bottom: 1.5rem;
        }
        .dataTables_filter input {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem; /* rounded-xl */
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            font-size: 0.875rem;
            outline: none;
            width: 260px;
            color: #475569;
            background-color: #f8fafc;
            /* SVG Icon Background */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='%2394a3b8' class='w-6 h-6'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 0.75rem center;
            background-size: 1rem;
            transition: all 0.2s;
        }
        .dataTables_filter input:focus {
            background-color: #fff;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        /* 3. Style Table Rows */
        table.dataTable tbody tr {
            background-color: transparent !important;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.2s;
        }
        table.dataTable tbody tr:hover {
            background-color: #f8fafc !important; /* Light gray on hover */
        }
        table.dataTable tbody td {
            padding: 1.25rem 1.5rem !important; /* More breathing room */
            vertical-align: middle;
        }

        /* 4. Pagination Buttons (Pills) */
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0.25rem;
            margin-top: 1.5rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            color: #64748b !important;
            background: transparent !important;
            border: 1px solid transparent !important;
            cursor: pointer;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f5f9 !important;
            color: #0f172a !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important; /* Indigo 600 */
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
            border: 1px solid #4f46e5 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* 5. Info Text */
        .dataTables_info {
            padding-top: 1.75rem !important;
            color: #94a3b8;
            font-size: 0.875rem;
        }
        
        /* 6. Length Select (10, 25, 50) */
        .dataTables_length select {
            border-radius: 0.5rem;
            border-color: #e2e8f0;
            color: #64748b;
            font-size: 0.875rem;
            padding-right: 2rem;
        }
        .dataTables_length select:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 0;
        }
    </style>

    <script type="module">
        $(document).ready(function() {
            var table = $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.data') }}",
                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                        className: 'font-mono text-slate-400 text-xs pl-6' 
                    },
                    { 
                        data: 'name', 
                        name: 'name',
                        className: 'font-bold text-slate-700'
                    },
                    { 
                        data: 'label', 
                        name: 'label',
                        render: function(data) {
                            return `<span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm">${data}</span>`;
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
                    searchPlaceholder: "Search roles...",
                    paginate: {
                        next: '<i data-lucide="chevron-right" class="w-4 h-4"></i>',
                        previous: '<i data-lucide="chevron-left" class="w-4 h-4"></i>'
                    },
                    processing: '<div class="flex items-center gap-2 text-indigo-600 font-bold"><i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i> Loading...</div>'
                },
                // Custom DOM Layout using Flexbox for spacing
                dom: '<"flex flex-col sm:flex-row justify-between items-center mb-6 gap-4"f>rt<"flex flex-col sm:flex-row justify-between items-center mt-6 gap-4"ip>',
                
                // IMPORTANT: Re-initialize icons every time the table redraws
                drawCallback: function() {
                    lucide.createIcons();
                }
            });
        });
    </script>
</x-app-layout>