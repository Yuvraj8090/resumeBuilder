<x-app-layout>
    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <a href="{{ route('users.index') }}" class="hover:underline">Users</a>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-slate-500">Create</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Register New User</h1>
            </div>
            
            <a href="{{ route('users.index') }}" class="flex items-center gap-2 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-700 px-4 py-2 rounded-xl text-sm font-medium transition-all shadow-sm">
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
                            <i data-lucide="user-plus" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2">User Registration</h3>
                        <p class="text-indigo-100 text-sm leading-relaxed">
                            Create a new account for an administrator, editor, or standard user. They will receive access based on the role you select.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Security Note</h4>
                    <ul class="space-y-4">
                        <li class="flex gap-3 text-sm text-slate-600">
                            <i data-lucide="lock" class="w-5 h-5 text-indigo-500 flex-shrink-0"></i>
                            <span>Passwords must be at least 8 characters long.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    
                    <form action="{{ route('users.store') }}" method="POST" class="p-8">
                        @csrf

                        <div class="mb-8 border-b border-slate-50 pb-6">
                            <h2 class="text-lg font-bold text-slate-800">Account Details</h2>
                            <p class="text-sm text-slate-500">All fields are required unless marked optional.</p>
                        </div>

                        <div class="space-y-6">
                            
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                        <i data-lucide="user" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe"
                                            style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all">
  </div>
                                @error('name') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                        <i data-lucide="mail" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="john@example.com"
                                            style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all">
          </div>
                                @error('email') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="role_id" class="block text-sm font-semibold text-slate-700 mb-2">Assign Role</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                        <i data-lucide="shield" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <select name="role_id" id="role_id" 
                                            style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all">
      <option value="" disabled selected>Select a role...</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                                        <i data-lucide="chevron-down" class="h-4 w-4 text-slate-400"></i>
                                    </div>
                                </div>
                                @error('role_id') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                                    <div class="relative mt-2 rounded-xl shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                            <i data-lucide="key" class="h-5 w-5 text-slate-400"></i>
                                        </div>
                                        <input type="password" name="password" id="password"
                                                style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all">
         </div>
                                    @error('password') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Confirm Password</label>
                                    <div class="relative mt-2 rounded-xl shadow-sm">
                                        <div  class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <i data-lucide="check-circle" class="h-5 w-5 text-slate-400"></i>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-10 pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                            <a href="{{ route('users.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm px-4 py-2 transition-colors">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40 transition-all transform active:scale-95 flex items-center gap-2">
                                <i data-lucide="user-plus" class="w-4 h-4"></i>
                                Create User
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script> document.addEventListener("DOMContentLoaded", function() { lucide.createIcons(); }); </script>
  
</x-app-layout>